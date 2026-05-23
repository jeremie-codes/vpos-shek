<?php

namespace App\Http\Controllers;

use App\Services\FlexpaieService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{

    public function purchage(Request $request, FlexpaieService $flex)
    {
        try {
            $method   = $request->input('payment_method'); // 1 = mobile, 2 = card
            $phone    = $request->input('phone');
            $amount    = $request->input('amount');
            $currency    = $request->input('currency');

            // Générer un code unique transaction
            $transactionCode = 'TRX-' . strtoupper(uniqid());

            /*
            |--------------------------------------------------------------------------
            | MOBILE PAYMENT
            |--------------------------------------------------------------------------
            */
            if ($method == "1") {

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

                    /*\App\Models\Transaction::create([
                        'code' => $transactionCode,
                        'amount' => $amount,
                        'currency' => $currency,
                        'phone' => $phone,
                        'payment_method' => 'mobile',
                        'order_number' => $result['orderNumber'],
                        'bundle_id' => $bundle->id,
                        'status' => 'pending'
                    ]);*/

                    return response()->json([
                        'status' => true,
                        'message' => 'Paiement envoyé sur votre téléphone',
                        'orderNumber' => $result['orderNumber']
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
            if ($method == "2") {

                $result = $flex->cardPayment(
                    $amount,
                    $currency,
                    route('payment.callback', ['code' => $transactionCode]),
                    route('payment.success'),
                    route('payment.cancel', ['code' => $transactionCode]),
                    route('payment.decline', ['code' => $transactionCode]),
                );

                if (($result['code'] ?? null) == "0") {

                    /*\App\Models\Transaction::create([
                        'code' => $transactionCode,
                        'amount' => $amount,
                        'currency' => $currency,
                        'phone' => null,
                        'payment_method' => 'card',
                        'order_number' => $result['orderNumber'],
                        'bundle_id' => $bundle->id,
                        'status' => 'pending'
                    ]);*/

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

                Log::error('Check payment pending: ' . json_encode($response));
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
                /*$localTransaction = Transaction::where('order_number', $orderNumber)->first();

                if ($localTransaction && $localTransaction->status !== 'success') {

                    $localTransaction->update([
                        'status' => 'success'
                    ]);

                    // Créditer les SMS
                    Subscription::create([
                        'merchant_id' => $localTransaction->bundle->id,
                        'bundle_id' => $localTransaction->bundle_id,
                        'available_sms' => $localTransaction->bundle->number_sms,
                    ]);
                }

                */

                Log::error('Check payment success: ' . json_encode($response));

                return response()->json([
                    'status' => 'success',
                    'code' => $transaction['status']
                ]);
            }
            else if ($transaction['status'] === "1" || $transaction['status'] === "4") {

                // mettre à jour ta base
                /*$localTransaction = Transaction::where('order_number', $orderNumber)->first();

                if ($localTransaction && $localTransaction->status !== 'success') {

                    $localTransaction->update([
                        'status' => 'success'
                    ]);

                    // Créditer les SMS
                    Subscription::create([
                        'merchant_id' => $localTransaction->bundle->id,
                        'bundle_id' => $localTransaction->bundle_id,
                        'available_sms' => $localTransaction->bundle->number_sms,
                    ]);
                }

                */

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

    public function success()
    {
        return redirect()
            ->route('dashboard')->with('success', 'La transaction est effectuée.');
    }

    public function callback(Request $request, $userId, $code)
    {
        try {
            // Exemple: récupérer order_number envoyé par FlexPay dans
            $content = json_decode($request->getContent(), true);

            /*$transaction = Transaction::where('order_number', $code)->first();

            if ($transaction) {

                // Mettre à jour la transaction
                if (isset($content['status']) && $content['status'] === "0") {
                    $transaction->status = 'success';
                    $transaction->save();

                    // Créditer les SMS
                    Subscription::create([
                        'merchant_id' => $transaction->bundle->id,
                        'bundle_id' => $transaction->bundle_id,
                        'available_sms' => $transaction->bundle->number_sms,
                    ]);
                } else {
                    $transaction->status = 'failed';
                    $transaction->save();
                }
            }*/

            Log::error('Callback received: ' . $code . ' - ' . json_encode($request->all()));
        } catch (\Throwable $e) {
            Log::error('Callback error: ' . $e->getMessage());
        }
    }

    public function cancel()
    {
        return redirect()
            ->route('dashboard')->with('error', 'La transaction a été annulée.');
    }

    public function decline()
    {
        return redirect()
            ->route('dashboard')->with('error', 'La transaction a échoué.');
    }

}
