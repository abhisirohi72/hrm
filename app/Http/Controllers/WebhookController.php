<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Setting;
use App\Models\WhatsAppFlow;
use App\Services\ConvertIntoWhatsapp;
use Illuminate\Support\Facades\DB;

class WebhookController extends Controller
{
    protected $convertIntoWhatsapp;

    public function __construct(ConvertIntoWhatsapp $convertIntoWhatsapp)
    {
        $this->convertIntoWhatsapp = $convertIntoWhatsapp;
    }

    public function handle(Request $request)
    {
        Log::info('Event run:');
        // Get raw POST data (like php://input)
        $data = $request->getContent();

        // Decode JSON to array
        $event = json_decode($data, true);

        if ($event) {
            // Log to a custom file (like log.txt)
            $logData = json_encode($event) . "\n";
            file_put_contents(storage_path('logs/webhook-log.txt'), $logData, FILE_APPEND | LOCK_EX);

            // Optionally call another function (your existing logic)
            $this->getLastMessage($event);

            // Log in Laravel log as well (optional)
            Log::info('Webhook event:', $event);
        } else {
            Log::warning('Webhook received with invalid JSON.', ['raw' => $data]);
        }

        return response()->json(['status' => 'success']);
    }

    private function getLastMessage($request)
    {
        Log::info("last msg call");
        Log::info($request['data']['body']);
        Log::info("number=" . $request['data']['to']);
        Log::info("end");
        try {
            $setting_details = Setting::where("id", 1)->first();

            // if (($request['data']['body'] == "hi") || ($request['data']['body'] == "Hi")) {
            //     //check reply for this
            //     // $reply =    WhatsAppFlow::where("searching_words", $request['data']['body'])->first();
                
            // }
            $reply =    WhatsAppFlow::where("searching_words", $request['data']['body']);
            Log::info("SQL:", [
                'query' => $reply->toSql(),
                'bindings' => $reply->getBindings()
            ]);
            $reply = $reply->first();
            if($reply){
                $this->sentReply($request['data']['from'], $reply->reply);
            }
        } catch (\Throwable $th) {
            Log::info('Webhook received:', $th->getMessage());
        }
    }

    public function sentReply($number, $reply)
    {
        Log::info("reply=" . $reply);
        // exit;
        try {
            $setting_details = Setting::where("id", 1)->first();

            $params = array(
                'token' => $setting_details->whats_app_token,
                'to' => $number,
                'body' => $this->convertIntoWhatsapp->convertQuillHtmlToWhatsappFormat($reply) ?? ''
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
