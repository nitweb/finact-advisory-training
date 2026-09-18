<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class BkashService
{
    protected string $baseUrl;
    protected string $appKey;
    protected string $appSecret;
    protected string $username;
    protected string $password;

    public function __construct()
    {
        $this->baseUrl   = config('bkash.base_url');
        $this->appKey    = config('bkash.app_key');
        $this->appSecret = config('bkash.app_secret');
        $this->username  = config('bkash.username');
        $this->password  = config('bkash.password');
    }

    protected function grantToken(): ?string
    {
        if ($cached = Cache::get('bkash_id_token')) {
            return $cached;
        }

        $response = Http::withHeaders([
            'username'     => $this->username,
            'password'     => $this->password,
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
        ])->post($this->baseUrl . '/tokenized/checkout/token/grant', [
            'app_key'    => $this->appKey,
            'app_secret' => $this->appSecret,
        ]);

        if ($response->failed()) {
            Log::error('Bkash Grant Token Failed: ' . $response->body());
            return null;
        }

        $data = $response->json();

        if (isset($data['id_token'])) {
            // bKash sandbox tokens are valid ~1 hour; cache slightly less
            Cache::put('bkash_id_token', $data['id_token'], now()->addMinutes(55));
            return $data['id_token'];
        }

        Log::error('Bkash Grant Token Response Invalid: ' . json_encode($data));
        return null;
    }

    protected function headers(): ?array
    {
        $token = $this->grantToken();

        if (!$token) {
            return null;
        }

        return [
            'Authorization' => $token,
            'X-App-Key'     => $this->appKey,
            'Content-Type'  => 'application/json',
            'Accept'        => 'application/json',
        ];
    }

    public function createPayment(string $invoice, float $amount, string $callbackURL): ?array
    {
        $headers = $this->headers();

        if (!$headers) {
            return null;
        }

        $response = Http::withHeaders($headers)->post($this->baseUrl . '/tokenized/checkout/create', [
            'mode'                => '0011',
            'payerReference'      => $invoice,
            'callbackURL'         => $callbackURL,
            'amount'              => number_format($amount, 2, '.', ''),
            'currency'            => 'BDT',
            'intent'              => 'sale',
            'merchantInvoiceNumber' => $invoice,
        ]);

        if ($response->failed()) {
            Log::error('Bkash Create Payment Failed: ' . $response->body());
            return null;
        }

        return $response->json();
    }

    public function executePayment(string $paymentID): ?array
    {
        $headers = $this->headers();

        if (!$headers) {
            return null;
        }

        $response = Http::withHeaders($headers)->post($this->baseUrl . '/tokenized/checkout/execute', [
            'paymentID' => $paymentID,
        ]);

        if ($response->failed()) {
            Log::error('Bkash Execute Payment Failed: ' . $response->body());
            return null;
        }

        return $response->json();
    }

    public function queryPayment(string $paymentID): ?array
    {
        $headers = $this->headers();

        if (!$headers) {
            return null;
        }

        $response = Http::withHeaders($headers)->post($this->baseUrl . '/tokenized/checkout/payment/status', [
            'paymentID' => $paymentID,
        ]);

        if ($response->failed()) {
            Log::error('Bkash Query Payment Failed: ' . $response->body());
            return null;
        }

        return $response->json();
    }
}
