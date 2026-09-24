<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsService
{
    private Client $client;
    private ?string $apiKey;
    private ?string $senderId;
    private string $baseUrl;

    public function __construct()
    {
        $this->client   = new Client();
        $this->apiKey   = env('SMS_API_KEY');
        $this->senderId = env('SMS_SENDER_ID');
        $this->baseUrl  = 'https://msg.mram.com.bd/smsapi';
    }

    /**
     * Check if SMS service is configured
     *
     * @return bool
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiKey) && ! empty($this->senderId);
    }

    /**
     * Send SMS to a number or multiple numbers
     *
     * @param string $number
     * @param string $message
     * @return string|bool
     */
    public function sendSms(string $number, string $message)
    {
        if (! $this->isConfigured()) {
            Log::error('SMS configuration missing: API Key or Sender ID not set.');
            return redirect()->back()->with([
                'message'    => 'SMS configuration is missing. Please set SMS_API_KEY and SMS_SENDER_ID in .env file.',
                'alert-type' => 'error',
            ]);
        }

        try {
            $response = Http::get($this->baseUrl, [
                'api_key'  => $this->apiKey,
                'type'     => 'text',
                'contacts' => $number,
                'senderid' => $this->senderId,
                'msg'      => $message,
            ]);

            Log::info('SMS API Response', ['response' => $response->body()]);
            return $response->body();
        } catch (\Exception $e) {
            Log::error('Error sending SMS: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Check SMS balance
     *
     * @return float
     */
    public function checkSMSBalance(): float
    {
        $apiUrl = "https://msg.mram.com.bd/miscapi/{$this->apiKey}/getBalance";

        try {
            $response = file_get_contents($apiUrl);
            preg_match('/\d+(\.\d+)?/', $response, $matches);
            $balance = $matches[0] ?? 0;
            return (float) $balance;
        } catch (\Exception $e) {
            Log::error('Error checking SMS balance: ' . $e->getMessage());
            return 0.0;
        }
    }
}
