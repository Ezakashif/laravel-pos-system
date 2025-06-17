<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FBRService
{
    public function send(array $payload, string $token)
    {
        return Http::withToken($token)
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ])
            ->post(config('fbr.api_url'), $payload);
    }
}
