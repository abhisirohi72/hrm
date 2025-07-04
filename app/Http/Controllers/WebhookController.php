<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Setting;
use App\Models\WhatsAppFlow;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        Log::info('Webhook received:', $request->all());

        // Optionally validate signature here
        $this->getLastMessage($request);
        return response()->json(['status' => 'success']);
    }

    private function getLastMessage($request)
    {
        try {
            $setting_details = Setting::where("id", 1)->first();

            $params = array(
                'token' => $setting_details->whats_app_token,
                'page' => '1',
                'limit' => '1',
                'status' => 'sent',
            );
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.ultramsg.com/instance$setting_details->whats_app_instance/messages?" . http_build_query($params),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/x-www-form-urlencoded"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $responseArray = json_decode($response, true); // ← decode to array
                if (($responseArray['messages'][0]['body'] == "hi") || ($responseArray['messages'][0]['body'] == "Hi")) {
                    //check reply for this
                    $reply =    WhatsAppFlow::where("searching_words", $responseArray['messages'][0]['body'])->first();
                    $this->sentReply($responseArray['messages'][0]['to'], $reply);
                }
            }
        } catch (\Throwable $th) {
            Log::info('Webhook received:', $th->getMessage());
        }
    }

    private function sentReply($number, $reply)
    {
        try {
            $setting_details = Setting::where("id", 1)->first();

            $params = array(
                'token' => $setting_details->whats_app_token,
                'to' => $number,
                'body' => $reply ?? ''
            );
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.ultramsg.com/instance$setting_details->whats_app_instance/messages/chat",
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
                echo "cURL Error #:" . $err;
            } else {
                echo $response;
            }
        } catch (\Throwable $th) {
            Log::info('Webhook received:', $th->getMessage());
        }
    }
}
