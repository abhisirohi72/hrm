<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\WhatsappChat;
use Illuminate\Http\Request;
use App\Services\CurlService;
use Illuminate\Support\Facades\Validator;

class WhatsappController extends Controller
{
    protected $curlService;
    protected $setting;

    public function __construct(CurlService $curlService)
    {
        $this->curlService = $curlService;
        $this->setting = Setting::first();
    }
    public function viewWhatsAppChat(Request $request)
    {
        $main_title = "Admin-Whatsapp-Chat-View";

        $title =    "Whatsapp Chat View";

        $details = WhatsappChat::where('type', 'chat')->get();

        return view('whatsapp.chat.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details
        ]);
    }

    public function addWhatsAppChat(Request $request)
    {
        $main_title = "Admin-Add-Whats App Chat";

        $title =    "Add Whats App Chat";

        return view('whatsapp.chat.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
        ]);
    }

    public function saveWhatsAppChat(Request $request)
    {
        return $this->addUpdateWhatsAppChat($request, "add", $this->curlService);
    }

    public function addUpdateWhatsAppChat($request, $cond, $curlService)
    {
        $request->validate([
            'to'    => 'required',
            "msg"   =>  "required",
        ]);

        if ($request->input("edit_id") == "") {
            //send messages
            $url = "https://api.ultramsg.com/instance" . $this->setting->whats_app_instance . "/messages/chat";
            $params = [
                'token' => $this->setting->whats_app_token,
                'to'    => $request->to,
                'body'  => $request->msg
            ];

            $result = $curlService->callCurl($params, $url);
            $convert_result = json_decode($result, true);
            if ($convert_result && $convert_result['sent'] == true) {
                $insert = WhatsappChat::create([
                    'user_id'   =>  session('user'),
                    'token'     =>  $this->setting->whats_app_token,
                    'to'        =>  $request->to,
                    'msg'       =>  $request->main_msg,
                    'response'  =>  $result,
                ]);
                if ($insert) {
                    return redirect()->back()->with('success', 'Successfully Inserted!!!');
                } else {
                    return redirect()->back()->with('error', 'There is some issue in inserted!!!');
                }
            } else {
                return redirect()->back()->with('error', 'There is some issue in sending for Whats App!!!');
            }
        }
    }

    public function viewWhatsAppImage(Request $request)
    {
        $main_title = "Admin-Whatsapp-Image-View";

        $title =    "Whatsapp Image View";

        $details = WhatsappChat::where('type', 'image')->get();

        return view('whatsapp.image.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details
        ]);
    }

    public function addWhatsAppImage(Request $request)
    {
        $main_title = "Admin-Add-Whats App Image";

        $title =    "Add Whats App Image";

        return view('whatsapp.image.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
        ]);
    }

    public function saveWhatsAppImage(Request $request)
    {
        return $this->addUpdateWhatsAppImage($request, "add", $this->curlService);
    }

    public function addUpdateWhatsAppImage($request, $cond, $curlService)
    {
        $request->validate([
            'to'    =>  'required',
            'image' =>  'required',
            "msg"   =>  "required",
        ]);

        if ($request->input("edit_id") == "") {
            //send messages
            $url = "https://api.ultramsg.com/instance" . $this->setting->whats_app_instance . "/messages/image";
            $params = [
                'token'     => $this->setting->whats_app_token,
                'to'        => $request->to,
                'image'     => $request->image,
                'caption'   => $request->msg
            ];

            $result = $curlService->callCurl($params, $url);
            $convert_result = json_decode($result, true);
            if ($convert_result && $convert_result['sent'] == true) {
                $insert = WhatsappChat::create([
                    'user_id'   =>  session('user'),
                    'token'     =>  $this->setting->whats_app_token,
                    'to'        =>  $request->to,
                    'msg'       =>  $request->main_msg,
                    'image'     =>  $request->image,
                    'type'      =>  'image',
                    'response'  =>  $result,
                ]);
                if ($insert) {
                    return redirect()->back()->with('success', 'Successfully Inserted!!!');
                } else {
                    return redirect()->back()->with('error', 'There is some issue in inserted!!!');
                }
            } else {
                return redirect()->back()->with('error', 'There is some issue in sending for Whats App!!!');
            }
        }
    }

    public function viewWhatsAppSticker(Request $request)
    {
        $main_title = "Admin-Whatsapp-Sticker-View";

        $title =    "Whatsapp Sticker View";

        $details = WhatsappChat::where('type', 'sticker')->get();

        return view('whatsapp.sticker.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details
        ]);
    }

    public function addWhatsAppSticker(Request $request)
    {
        $main_title = "Admin-Add-Whats App Sticker";

        $title =    "Add Whats App Sticker";

        return view('whatsapp.sticker.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
        ]);
    }

    public function saveWhatsAppSticker(Request $request)
    {
        return $this->addUpdateWhatsAppSticker($request, "add", $this->curlService);
    }

    public function addUpdateWhatsAppSticker($request, $cond, $curlService)
    {
        $request->validate([
            'to'        =>  'required',
            'sticker'   =>  'required'
        ]);

        if ($request->input("edit_id") == "") {
            //send messages
            $url = "https://api.ultramsg.com/instance" . $this->setting->whats_app_instance . "/messages/sticker";
            $params = [
                'token'     => $this->setting->whats_app_token,
                'to'        => $request->to,
                'sticker'   => $request->sticker,
            ];

            $result = $curlService->callCurl($params, $url);
            $convert_result = json_decode($result, true);
            if ($convert_result && $convert_result['sent'] == true) {
                $insert = WhatsappChat::create([
                    'user_id'   =>  session('user'),
                    'token'     =>  $this->setting->whats_app_token,
                    'to'        =>  $request->to,
                    'msg'       =>  'N/A',
                    'image'     =>  $request->sticker,
                    'type'      =>  'sticker',
                    'response'  =>  $result,
                ]);
                if ($insert) {
                    return redirect()->back()->with('success', 'Successfully Inserted!!!');
                } else {
                    return redirect()->back()->with('error', 'There is some issue in inserted!!!');
                }
            } else {
                return redirect()->back()->with('error', 'There is some issue in sending for Whats App!!!');
            }
        }
    }

    public function viewWhatsAppDocument(Request $request)
    {
        $main_title = "Admin-Whatsapp-Document-View";

        $title =    "Whatsapp Document View";

        $details = WhatsappChat::where('type', 'document')->get();

        return view('whatsapp.document.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details
        ]);
    }

    public function addWhatsAppDocument(Request $request)
    {
        $main_title = "Admin-Add-Whats App Document";

        $title =    "Add Whats App Document";

        return view('whatsapp.document.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
        ]);
    }

    public function saveWhatsAppDocument(Request $request)
    {
        return $this->addUpdateWhatsAppDocument($request, "add", $this->curlService);
    }

    public function addUpdateWhatsAppDocument($request, $cond, $curlService)
    {
        $request->validate([
            'to'        =>  'required',
            'filename'  =>  'required',
            'document'  =>  'required',
            'msg'       =>  'required',
        ]);

        if ($request->input("edit_id") == "") {
            //send messages
            $url = "https://api.ultramsg.com/instance" . $this->setting->whats_app_instance . "/messages/document";
            $params = [
                'token'     => $this->setting->whats_app_token,
                'to'        => $request->to,
                'filename'  => $request->filename,
                'document'  => $request->document,
                'caption'   => $request->msg,
            ];

            $result = $curlService->callCurl($params, $url);
            $convert_result = json_decode($result, true);
            if ($convert_result && $convert_result['sent'] == true) {
                $insert = WhatsappChat::create([
                    'user_id'   =>  session('user'),
                    'token'     =>  $this->setting->whats_app_token,
                    'to'        =>  $request->to,
                    'msg'       =>  $request->msg,
                    'image'     =>  $request->document,
                    'filename'  =>  $request->filename,
                    'type'      =>  'document',
                    'response'  =>  $result,
                ]);
                if ($insert) {
                    return redirect()->back()->with('success', 'Successfully Inserted!!!');
                } else {
                    return redirect()->back()->with('error', 'There is some issue in inserted!!!');
                }
            } else {
                return redirect()->back()->with('error', 'There is some issue in sending for Whats App!!!');
            }
        }
    }

    public function viewWhatsAppAudio(Request $request)
    {
        $main_title = "Admin-Whatsapp-Audio-View";

        $title =    "Whatsapp Audio View";

        $details = WhatsappChat::where('type', 'audio')->get();

        return view('whatsapp.audio.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details
        ]);
    }

    public function addWhatsAppAudio(Request $request)
    {
        $main_title = "Admin-Add-Whats App Audio";

        $title =    "Add Whats App Audio";

        return view('whatsapp.audio.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
        ]);
    }

    public function saveWhatsAppAudio(Request $request)
    {
        return $this->addUpdateWhatsAppAudio($request, "add", $this->curlService);
    }

    public function addUpdateWhatsAppAudio($request, $cond, $curlService)
    {
        $validator = Validator::make($request->all(), [
            'to'    => 'required',
            'audio' => ['required', function ($attribute, $value, $fail) {

                $maxBase64Length = 10000000; // 10MB (Base64 length)
                $maxSizeBytes = 16 * 1024 * 1024; // 16MB

                // Check if it's a valid HTTP audio URL
                if (filter_var($value, FILTER_VALIDATE_URL)) {
                    if (!preg_match('/\.(mp3|aac|ogg)(\?.*)?$/i', $value)) {
                        $fail('The audio URL must end with .mp3, .aac, or .ogg.');
                    }
                    return;
                }

                // Check if it's base64
                if (preg_match('/^data:audio\/(mp3|mpeg|aac|ogg);base64,/', $value)) {

                    if (strlen($value) > $maxBase64Length) {
                        $fail('The base64 audio exceeds the maximum allowed length.');
                        return;
                    }

                    // Decode and check actual size
                    $base64Data = explode(',', $value)[1] ?? '';
                    $decoded = base64_decode($base64Data, true);

                    if ($decoded === false) {
                        $fail('Invalid base64 audio data.');
                    } elseif (strlen($decoded) > $maxSizeBytes) {
                        $fail('The audio file exceeds 16MB.');
                    }
                    return;
                }

                $fail('The audio must be a valid URL ending with .mp3, .aac, .ogg or a valid base64-encoded audio.');
            }],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('errors' ,$validator->errors());
        }

        if ($request->input("edit_id") == "") {
            //send messages
            $url = "https://api.ultramsg.com/instance" . $this->setting->whats_app_instance . "/messages/audio";
            $params = [
                'token'     => $this->setting->whats_app_token,
                'to'        => $request->to,
                'audio'     => $request->audio,
            ];

            $result = $curlService->callCurl($params, $url);
            $convert_result = json_decode($result, true);
            if ($convert_result && $convert_result['sent'] == true) {
                $insert = WhatsappChat::create([
                    'user_id'   =>  session('user'),
                    'token'     =>  $this->setting->whats_app_token,
                    'to'        =>  $request->to,
                    'msg'       =>  'N/A',
                    'image'     =>  $request->audio,
                    'type'      =>  'audio',
                    'response'  =>  $result,
                ]);
                if ($insert) {
                    return redirect()->back()->with('success', 'Successfully Inserted!!!');
                } else {
                    return redirect()->back()->with('error', 'There is some issue in inserted!!!');
                }
            } else {
                return redirect()->back()->with('error', 'There is some issue in sending for Whats App!!!');
            }
        }
    }

    public function viewWhatsAppVideo(Request $request)
    {
        $main_title = "Admin-Whatsapp-Video-View";

        $title =    "Whatsapp Video View";

        $details = WhatsappChat::where('type', 'video')->get();

        return view('whatsapp.video.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details
        ]);
    }

    public function addWhatsAppVideo(Request $request)
    {
        $main_title = "Admin-Add-Whats App Video";

        $title =    "Add Whats App Video";

        return view('whatsapp.video.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
        ]);
    }

    public function saveWhatsAppVideo(Request $request)
    {
        return $this->addUpdateWhatsAppVideo($request, "add", $this->curlService);
    }

    public function addUpdateWhatsAppVideo($request, $cond, $curlService)
    {
        $validator = Validator::make($request->all(), [
            'to'    => 'required',
            'video' => ['required', function ($attribute, $value, $fail) {

                $maxBase64Length = 10000000; // 10MB (Base64 length)
                $maxSizeBytes = 16 * 1024 * 1024; // 16MB

                // Check if it's a valid HTTP video URL
                if (filter_var($value, FILTER_VALIDATE_URL)) {
                    if (!preg_match('/\.(mp4|3gp|mov)(\?.*)?$/i', $value)) {
                        $fail('The video URL must end with  mp4 , 3gp , mov');
                    }
                    return;
                }

                // Check if it's base64
                if (preg_match('/^data:video\/(mp4|3gp|mov);base64,/', $value)) {

                    if (strlen($value) > $maxBase64Length) {
                        $fail('The base64 video exceeds the maximum allowed length.');
                        return;
                    }

                    // Decode and check actual size
                    $base64Data = explode(',', $value)[1] ?? '';
                    $decoded = base64_decode($base64Data, true);

                    if ($decoded === false) {
                        $fail('Invalid base64 video data.');
                    } elseif (strlen($decoded) > $maxSizeBytes) {
                        $fail('The video file exceeds 16MB.');
                    }
                    return;
                }

                $fail('The video must be a valid URL ending with .mp4, .3gp, .mov or a valid base64-encoded video.');
            }],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('errors' ,$validator->errors());
        }

        if ($request->input("edit_id") == "") {
            //send messages
            $url = "https://api.ultramsg.com/instance" . $this->setting->whats_app_instance . "/messages/video";
            $params = [
                'token'     => $this->setting->whats_app_token,
                'to'        => $request->to,
                'video'     => $request->video,
                'caption'   => $request->caption
            ];

            $result = $curlService->callCurl($params, $url);
            $convert_result = json_decode($result, true);
            if ($convert_result && $convert_result['sent'] == true) {
                $insert = WhatsappChat::create([
                    'user_id'   =>  session('user'),
                    'token'     =>  $this->setting->whats_app_token,
                    'to'        =>  $request->to,
                    'msg'       =>  $request->caption,
                    'image'     =>  $request->video,
                    'type'      =>  'video',
                    'response'  =>  $result,
                ]);
                if ($insert) {
                    return redirect()->back()->with('success', 'Successfully Inserted!!!');
                } else {
                    return redirect()->back()->with('error', 'There is some issue in inserted!!!');
                }
            } else {
                return redirect()->back()->with('error', 'There is some issue in sending for Whats App!!!');
            }
        }
    }

    public function viewWhatsAppContact(Request $request)
    {
        $main_title = "Admin-Whatsapp-Contact-View";

        $title =    "Whatsapp Contact View";

        $details = WhatsappChat::where('type', 'contact')->get();

        return view('whatsapp.contact.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details
        ]);
    }

    public function addWhatsAppContact(Request $request)
    {
        $main_title = "Admin-Add-Whats App Contact";

        $title =    "Add Whats App Contact";

        return view('whatsapp.contact.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
        ]);
    }

    public function saveWhatsAppContact(Request $request)
    {
        return $this->addUpdateWhatsAppContact($request, "add", $this->curlService);
    }

    public function addUpdateWhatsAppContact($request, $cond, $curlService)
    {
        $request->validate([
            "to"        =>  "required",
            "contact"   =>  "required"
        ]);

        if ($request->input("edit_id") == "") {
            //send messages
            $url = "https://api.ultramsg.com/instance" . $this->setting->whats_app_instance . "/messages/contact";
            $params = [
                'token'     => $this->setting->whats_app_token,
                'to'        => $request->to,
                'contact'   => $request->contact,
            ];

            $result = $curlService->callCurl($params, $url);
            $convert_result = json_decode($result, true);
            if ($convert_result && $convert_result['sent'] == true) {
                $insert = WhatsappChat::create([
                    'user_id'   =>  session('user'),
                    'token'     =>  $this->setting->whats_app_token,
                    'to'        =>  $request->to,
                    'msg'       =>  $request->contact,
                    'type'      =>  'contact',
                    'response'  =>  $result,
                ]);
                if ($insert) {
                    return redirect()->back()->with('success', 'Successfully Inserted!!!');
                } else {
                    return redirect()->back()->with('error', 'There is some issue in inserted!!!');
                }
            } else {
                return redirect()->back()->with('error', 'There is some issue in sending for Whats App!!!');
            }
        }
    }

    public function viewWhatsAppLocation(Request $request)
    {
        $main_title = "Admin-Whatsapp-Location-View";

        $title =    "Whatsapp Location View";

        $details = WhatsappChat::where('type', 'location')->get();

        return view('whatsapp.location.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details
        ]);
    }

    public function addWhatsAppLocation(Request $request)
    {
        $main_title = "Admin-Add-Whats App Location";

        $title =    "Add Whats App Location";

        return view('whatsapp.location.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
        ]);
    }

    public function saveWhatsAppLocation(Request $request)
    {
        return $this->addUpdateWhatsAppLocation($request, "add", $this->curlService);
    }

    public function addUpdateWhatsAppLocation($request, $cond, $curlService)
    {
        $request->validate([
            "to"        =>  "required",
            "address"   =>  "required",
            "lat"       =>  "required",
            "lng"       =>  "required",
        ]);

        if ($request->input("edit_id") == "") {
            //send messages
            $url = "https://api.ultramsg.com/instance" . $this->setting->whats_app_instance . "/messages/location";
            $params = [
                'token'     => $this->setting->whats_app_token,
                'to'        => $request->to,
                'address'   => $request->address,
                'lat'       => $request->lat,
                'lng'       => $request->lng,
            ];

            $result = $curlService->callCurl($params, $url);
            $convert_result = json_decode($result, true);
            if ($convert_result && $convert_result['sent'] == true) {
                $insert = WhatsappChat::create([
                    'user_id'   =>  session('user'),
                    'token'     =>  $this->setting->whats_app_token,
                    'to'        =>  $request->to,
                    'msg'       =>  $request->address."~||~".$request->lat."~||~".$request->lng,
                    'type'      =>  'location',
                    'response'  =>  $result,
                ]);
                if ($insert) {
                    return redirect()->back()->with('success', 'Successfully Inserted!!!');
                } else {
                    return redirect()->back()->with('error', 'There is some issue in inserted!!!');
                }
            } else {
                return redirect()->back()->with('error', 'There is some issue in sending for Whats App!!!');
            }
        }
    }

    public function viewWhatsAppVcard(Request $request)
    {
        $main_title = "Admin-Whatsapp-Vcard-View";

        $title =    "Whatsapp Vcard View";

        $details = WhatsappChat::where('type', 'vcard')->get();

        return view('whatsapp.vcard.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details
        ]);
    }

    public function addWhatsAppVcard(Request $request)
    {
        $main_title = "Admin-Add-Whats App Vcard";

        $title =    "Add Whats App Vcard";

        return view('whatsapp.vcard.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
        ]);
    }

    public function saveWhatsAppVcard(Request $request)
    {
        return $this->addUpdateWhatsAppVcard($request, "add", $this->curlService);
    }

    public function addUpdateWhatsAppVcard($request, $cond, $curlService)
    {
        $request->validate([
            "to"        =>  "required",
            "vcard"     =>  "required",
        ]);

        if ($request->input("edit_id") == "") {
            //send messages
            $url = "https://api.ultramsg.com/instance" . $this->setting->whats_app_instance . "/messages/vcard";
            $params = [
                'token'     => $this->setting->whats_app_token,
                'to'        => $request->to,
                'vcard'     => $request->vcard,
            ];

            $result = $curlService->callCurl($params, $url);
            $convert_result = json_decode($result, true);
            if ($convert_result && $convert_result['sent'] == true) {
                $insert = WhatsappChat::create([
                    'user_id'   =>  session('user'),
                    'token'     =>  $this->setting->whats_app_token,
                    'to'        =>  $request->to,
                    'msg'       =>  $request->vcard,
                    'type'      =>  'vcard',
                    'response'  =>  $result,
                ]);
                if ($insert) {
                    return redirect()->back()->with('success', 'Successfully Inserted!!!');
                } else {
                    return redirect()->back()->with('error', 'There is some issue in inserted!!!');
                }
            } else {
                return redirect()->back()->with('error', 'There is some issue in sending for Whats App!!!');
            }
        }
    }

    public function viewWhatsAppReaction(Request $request)
    {
        $main_title = "Admin-Whatsapp-Reaction-View";

        $title =    "Whatsapp Reaction View";

        $details = WhatsappChat::where('type', 'reaction')->get();

        return view('whatsapp.reaction.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details
        ]);
    }

    public function addWhatsAppReaction(Request $request)
    {
        $main_title = "Admin-Add-Whats-App-Reaction";

        $title =    "Add Whats App Reaction";

        return view('whatsapp.reaction.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
        ]);
    }

    public function saveWhatsAppReaction(Request $request)
    {
        return $this->addUpdateWhatsAppReaction($request, "add", $this->curlService);
    }

    public function addUpdateWhatsAppReaction($request, $cond, $curlService)
    {
        $request->validate([
            "to"        =>  "required",
            "vcard"     =>  "required",
        ]);

        if ($request->input("edit_id") == "") {
            //send messages
            $url = "https://api.ultramsg.com/instance" . $this->setting->whats_app_instance . "/messages/vcard";
            $params = [
                'token'     => $this->setting->whats_app_token,
                'to'        => $request->to,
                'vcard'     => $request->vcard,
            ];

            $result = $curlService->callCurl($params, $url);
            $convert_result = json_decode($result, true);
            if ($convert_result && $convert_result['sent'] == true) {
                $insert = WhatsappChat::create([
                    'user_id'   =>  session('user'),
                    'token'     =>  $this->setting->whats_app_token,
                    'to'        =>  $request->to,
                    'msg'       =>  $request->vcard,
                    'type'      =>  'vcard',
                    'response'  =>  $result,
                ]);
                if ($insert) {
                    return redirect()->back()->with('success', 'Successfully Inserted!!!');
                } else {
                    return redirect()->back()->with('error', 'There is some issue in inserted!!!');
                }
            } else {
                return redirect()->back()->with('error', 'There is some issue in sending for Whats App!!!');
            }
        }
    }

    public function viewWhatsAppResend(Request $request)
    {
        $main_title = "Admin-Whatsapp-Resend-View";

        $title =    "Whatsapp Resend View";

        $details = WhatsappChat::where('type', 'resend')->get();

        return view('whatsapp.resend.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details
        ]);
    }

    public function addWhatsAppResend(Request $request)
    {
        $main_title = "Admin-Add-Whats-App-Resend";

        $title =    "Add Whats App Resend";

        return view('whatsapp.resend.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
        ]);
    }

    public function saveWhatsAppResend(Request $request)
    {
        return $this->addUpdateWhatsAppResend($request, "add", $this->curlService);
    }

    public function addUpdateWhatsAppResend($request, $cond, $curlService)
    {
        $request->validate([
            "status"        =>  "required",
        ]);

        if ($request->input("edit_id") == "") {
            //send messages
            $url = "https://api.ultramsg.com/instance" . $this->setting->whats_app_instance . "/messages/resendByStatus";
            $params = [
                'token'     => $this->setting->whats_app_token,
                'status'        => $request->status,
            ];

            $result = $curlService->callCurl($params, $url);
            $convert_result = json_decode($result, true);
            if ($convert_result && $convert_result['success'] == 'done') {
                $insert = WhatsappChat::create([
                    'user_id'   =>  session('user'),
                    'token'     =>  $this->setting->whats_app_token,
                    'to'        =>  $request->to ?? session('phone'),
                    'msg'       =>  $request->status,
                    'type'      =>  'resend',
                    'response'  =>  $result,
                ]);
                if ($insert) {
                    return redirect()->back()->with('success', 'Successfully Inserted!!!');
                } else {
                    return redirect()->back()->with('error', 'There is some issue in inserted!!!');
                }
            } else {
                return redirect()->back()->with('error', 'There is some issue in sending for Whats App!!!');
            }
        }
    }

    public function viewWhatsAppQrcode(Request $request){
        $main_title = "Admin-Whatsapp-QR-Code";

        $title =    "Whatsapp QRCode View";

        // $details = WhatsappChat::where('type', 'resend')->get();

        return view('whatsapp.qrcode.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'instance'      =>  $this->setting->whats_app_instance,
            'token'         =>  $this->setting->whats_app_token
        ]);
    }
}
