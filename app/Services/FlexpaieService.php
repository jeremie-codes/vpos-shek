<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FlexpaieService
{
    const BASE_URL_PHONE = "https://backend.flexpay.cd/api/rest/v1/paymentService";
    const BASE_URL_CARD = "https://cardpayment.flexpay.cd/v1.1/pay";
    const BASE_URL_CHECK = "https://apicheck.flexpaie.com/api/rest/v1/check/";

    const SUCCESS = 0;

    private function generateRandomCode(int $length = 6): string
    {
        return str_pad((string) random_int(0, 999999), $length, '0', STR_PAD_LEFT);
    }

    public function mobilePayment($amount, $phone, $currency, $callbackUrl): array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.flexpay.token'),
            'Content-Type' => 'application/json',
        ])->post(self::BASE_URL_PHONE, [
            'merchant' => 'CIRRUS',
            'type' => "1",
            'reference' => $this->generateRandomCode(6),
            'phone' => $phone,
            'amount' => $amount,
            'currency' => $currency,
            'callbackUrl' => $callbackUrl,
        ]);

        return $response->json();
    }

    public function cardPayment($amount, $currency, $callbackUrl, $approveUrl, $cancelUrl, $declineUrl): array
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post(self::BASE_URL_CARD, [
            'authorization' => 'Bearer ' . config('services.flexpay.key'),
            'merchant' => 'CIRRUS',
            'reference' => $this->generateRandomCode(6),
            'amount' => $amount,
            'currency' => $currency,
            'description' => "Paiement et recharge de la FlexCard",
            'callback_url' => $callbackUrl,
            'approve_url' => $approveUrl,
            'cancel_url' => $cancelUrl,
            'decline_url' => $declineUrl,
        ]);

        return $response->json();
    }

    public function getPaymentStatus(string $ordernumber): array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.flexpay.key'),
        ])->get(self::BASE_URL_CHECK . $ordernumber);

        return $response->json();
    }
}
