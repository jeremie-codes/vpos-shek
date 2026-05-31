<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FlexpaieService
{
    const BASE_URL = "https://corporateapi.flexpay.cd/api/rest/v1/paymentService";
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
        ])->post(self::BASE_URL, [
            'merchant' => 'SHEKINAH_TABERNACLE',
            'type' => "1",
            'reference' => $this->generateRandomCode(6),
            'phone' => $phone,
            'amount' => $amount,
            'currency' => $currency,
            'callback_url' => $callbackUrl,
        ]);

        return $response->json();
    }

    public function cardPayment($amount, $currency, $callbackUrl, $approveUrl, $cancelUrl, $declineUrl): array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.flexpay.token'),
            'Content-Type' => 'application/json',
        ])->post(self::BASE_URL, [
            'merchant' => 'SHEKINAH_TABERNACLE',
            'reference' => $this->generateRandomCode(6),
            'amount' => $amount,
            'currency' => $currency,
            'type' => "2",
            'description' => "Paiement vpos de Shekinah Tabernacle",
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
            'Authorization' => 'Bearer ' . config('services.flexpay.token'),
        ])->get(self::BASE_URL_CHECK . $ordernumber);

        return $response->json();
    }
}
