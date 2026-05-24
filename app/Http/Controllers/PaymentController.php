<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Services\FlexpaieService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{

    public function purchase(Request $request, FlexpaieService $flex)
    {
        try {
            $method       = $request->input('payment_method'); // mobile ou card
            $phone        = $request->input('phone');
            $amount       = $request->input('amount');
            $currency     = $request->input('currency');
            $firstname    = $request->input('firstname');
            $lastname     = $request->input('lastname');
            $email        = $request->input('email');
            $org          = $request->input('org');
            $country      = $request->input('country');
            $city         = $request->input('city');

            // On récupère le statut anonyme envoyé par le front-end
            $isAnonymous  = $request->input('is_anonymous', false);

            // Générer un code unique transaction
            $transactionCode = 'TRX-' . strtoupper(uniqid());

            /*
            |--------------------------------------------------------------------------
            | RECHERCHE OU CRÉATION DE L'UTILISATEUR (Adapté aux cas Anonymes)
            |--------------------------------------------------------------------------
            */
            if ($isAnonymous) {
                if ($method == "mobile") {
                    // Cas Mobile Money Anonyme : Recherche/Création par numéro de téléphone unique
                    // On utilise un faux email basé sur le numéro pour satisfaire la contrainte d'unicité
                    $user = User::firstOrCreate(
                        ['email' => 'anonymous_' . $phone . '@system.local'],
                        [
                            'firstname'  => 'Anonyme',
                            'lastname'   => null,
                            'org'        => null,
							'phone'        => $phone,
                            'country_id' => null,
                            'city'       => null,
                        ]
                    );
                } else {
                    // Cas Carte Bancaire Anonyme : Un seul et unique compte système global pour TOUTES les cartes anonymes
                    $user = User::firstOrCreate(
                        ['email' => 'global_anonymous_card@system.local'],
                        [
                            'firstname'  => 'Anonyme',
                            'lastname'   => null,
                            'org'        => null,
                            'country_id' => null,
                            'city'       => null,
                        ]
                    );
                }
            } else {
                // Logique classique si le don N'EST PAS anonyme
                $user = User::firstOrCreate(
                    ['email' => $email],
                    [
                        'firstname'  => $firstname,
                        'lastname'   => $lastname,
                        'org'        => $org,
                        'country_id' => $country,
						'phone' => $phone ?? null,
                        'city'       => $city,
                    ]
                );
            }

            /*
            |--------------------------------------------------------------------------
            | MOBILE PAYMENT
            |--------------------------------------------------------------------------
            */
            if ($method == "mobile") {

                if (!$phone) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Numéro requis'
                    ]);
                }

                $result = $flex->mobilePayment(
                    $amount,
                    '243' . $phone,
                    $currency,
                    route('payment.callback', ['code' => $transactionCode])
                );

                if (($result['code'] ?? null) == "0") {

                    Transaction::create([
                        'user_id'        => $user->id,
                        'code'           => $transactionCode,
                        'amount'         => $amount,
                        'currency'       => $currency,
                        'phone'          => $phone,
                        'payment_method' => 'mobile',
                        'order_number'   => $result['orderNumber'],
                        'status'         => 'pending',
                    ]);

                    return response()->json([
                        'status' => true,
                        'message' => 'Paiement envoyé sur votre téléphone',
                        'orderNumber' => $result['orderNumber'],
                    ]);
                }

                return response()->json([
                    'status' => false,
                    'message' => $result['message'] ?? 'Echec paiement mobile'
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | CARD PAYMENT
            |--------------------------------------------------------------------------
            */
            if ($method == "card") {

                $result = $flex->cardPayment(
                    $amount,
                    $currency,
                    route('payment.callback', ['code' => $transactionCode]),
                    route('payment.success', ['code' => $transactionCode]),
                    route('payment.cancel', ['code' => $transactionCode]),
                    route('payment.decline', ['code' => $transactionCode]),
                );

                if (($result['code'] ?? null) == "0") {

                    Transaction::create([
                        'user_id'        => $user->id,
                        'code'           => $transactionCode,
                        'amount'         => $amount,
                        'currency'       => $currency,
                        'phone'          => null, // Pas de numéro enregistré pour le paiement par carte anonyme
                        'payment_method' => 'card',
                        'order_number'   => $result['orderNumber'],
                        'status'         => 'pending',
                    ]);

                    return response()->json([
                        'status' => true,
                        'redirect' => true,
                        'url' => $result['url']
                    ]);
                }

                return response()->json([
                    'status' => false,
                    'message' => $result['message'] ?? 'Echec paiement carte'
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Méthode invalide'
            ]);
        } catch (\Throwable $e) {

            Log::error('Erreur paiement: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Erreur serveur'
            ]);
        }
    }

    public function check($orderNumber, FlexpaieService $flex)
    {
        try {

            $response = $flex->getPaymentStatus($orderNumber);

            // Aucune transaction
            if (($response['code'] ?? null) != "0" || empty($response['transaction'])) {

                Log::error('Check payment not found: ' . json_encode($response));

                return response()->json([
                    'status' => 'not_found'
                ]);
            }

            $transaction = $response['transaction'];

            /*
            |--------------------------------------------------------------------------
            | Mapping des statuts FlexPay
            |--------------------------------------------------------------------------
            | 0 = SUCCESS
            | autres = en attente ou échec
            */
            if ($transaction['status'] === "0") {

                // mettre à jour ta base
                $localTransaction = Transaction::where('order_number', $orderNumber)->first();

                if ($localTransaction && $localTransaction->status !== 'success') {

                    $localTransaction->update([
                        'status' => 'success'
                    ]);
                }

                Log::error('Check payment success: ' . json_encode($response));

                return response()->json([
                    'status' => 'success',
                    'code' => $transaction['status']
                ]);
            } else if ($transaction['status'] === "1" || $transaction['status'] === "4") {

                // mettre à jour ta base
                $localTransaction = Transaction::where('order_number', $orderNumber)->first();

                if ($localTransaction && $localTransaction->status !== 'success') {

                    $localTransaction->update([
                        'status' => 'failed'
                    ]);
                }

                Log::error('Check payment success: ' . json_encode($response));

                return response()->json([
                    'status' => 'failed',
                    'code' => $transaction['status']
                ]);
            }

            Log::error('Check payment pending: ' . json_encode($response));

            // ⏳ Toujours en attente
            return response()->json([
                'status' => 'pending',
                'code' => $transaction['status']
            ]);
        } catch (\Throwable $e) {

            Log::error('Check payment error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error'
            ]);
        }
    }

    public function callback(Request $request, $userId, $code)
    {
        try {
            // Exemple: récupérer order_number envoyé par FlexPay dans
            $content = json_decode($request->getContent(), true);

            $transaction = Transaction::where('order_number', $code)->first();

            if ($transaction) {

                // Mettre à jour la transaction
                if (isset($content['status']) && $content['status'] === "0") {
                    $transaction->status = 'success';
                    $transaction->save();
                } else {
                    $transaction->status = 'failed';
                    $transaction->save();
                }
            }

            Log::error('Callback received: ' . $code . ' - ' . json_encode($request->all()));
        } catch (\Throwable $e) {
            Log::error('Callback error: ' . $e->getMessage());
        }
    }

    public function success($code)
    {
        $transaction = Transaction::where('code', $code)->first();

        if($transaction && $transaction->status == 'pending') {
            $transaction->update(['status' => 'success']);
            return view('success');
        }

        return view('finished');

    }

    public function cancel($code)
    {
        $transaction = Transaction::where('code', $code)->first();

        if($transaction && $transaction->status == 'pending') {
            $transaction->update(['status' => 'failed']);
            return view('cancel');
        }

        return view('finished');

    }

    public function decline($code)
    {
        $transaction = Transaction::where('code', $code)->first();

        if($transaction && $transaction->status == 'pending') {
            $transaction->update(['status' => 'failed']);
            return view('decline');
        }

        return view('finished');

    }
}
