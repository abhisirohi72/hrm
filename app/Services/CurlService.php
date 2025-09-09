<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CurlService
{
    function sendPost($url, $params)
    {
        try {
            Log::error('Request failed', [$url]);
            Log::error('Request failed',[$params]);
            $response = Http::asForm()
                ->withOptions([
                    'verify' => false // disables SSL verification (for HTTP or self-signed certs)
                ])
                ->timeout(10)
                ->post($url, $params);

            if ($response->successful()) {
                Log::error('Request success', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return $response->json();
            } else {
                Log::error('Request failed', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                Log::error('Request failed', ['body' => $response->body()]);
                return ['error' => 'Request failed'];
            }
        } catch (\Exception $e) {
            Log::error('CurlService Exception', ['message' => $e->getMessage()]);
            return ['error' => $e->getMessage()];
        }
    }

    public function callCurl($params, $url)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query($params),
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return $err;
        } else {
            return $response;
        }
    }
}
