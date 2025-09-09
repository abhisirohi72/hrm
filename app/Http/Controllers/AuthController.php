<?php

namespace App\Http\Controllers;

use App\Models\PageAccess;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name'      =>  $request->name,
            'email'     =>  $request->email,
            'password'  =>  Hash::make($request->password),
            'role'      =>  '1',
            'phone'     =>  $request->phone,
        ]);
        $setting_details = Setting::where("id", 1)->first();
        $params = array(
            'token' => '{{ $setting_details->whats_app_token }}',
            'to' => $request->phone,
            'image' => env('APP_URL') . '/frontend/images/logo.png',
            'caption' => "Hello " . $request->name . " 👋,  \n\nWelcome to Webfintech! 🎉  \nWe're excited to have you on board. If you have any questions, feel free to ask.  \n\nHappy exploring!"
        );
        $curl = curl_init();
        // echo "https://api.ultramsg.com/instance$setting_details->whats_app_instance/messages/image";
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.ultramsg.com/instance$setting_details->whats_app_instance/messages/image",
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
            // echo $response;
        }


        return redirect()->back()->with("success", "Record has been inserted!!!");
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);
        $data = Auth::attempt($credentials);
        // echo "<pre>";
        // print_r($data);
        // exit;   
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user(); // ✅ Fix: get the logged-in user
            $user->last_login_at = now();
            $user->save();

            $page_access_details = PageAccess::where("department_id", Auth::user()->role)->get();
            session([
                'user'          =>  Auth::id(),
                'name'          =>  Auth::user()->name,
                'email'         =>  Auth::user()->email,
                'image'         =>  Auth::user()->image,
                'role'          =>  Auth::user()->role,
                'stripe_id'     =>  Auth::user()->stripe_id,
                'phone'         =>  Auth::user()->phone,
                'last_login_at' =>  Auth::user()->last_login_at,
                'page_access'   =>  $page_access_details,
            ]);
            $setting_details = Setting::where("id", 1)->first();
            if($setting_details && $setting_details->whats_app_instance){
                $params = array(
                    'token' => '{{ $setting_details->whats_app_token }}',
                    'to' => Auth::user()->phone,
                    'image' => env('APP_URL') . '/frontend/images/logo.png',
                    'caption' => "Hello " . Auth::user()->name . " 👋,  \n\nWelcome to Webfintech! 🎉  \nWe're excited to have you on board. If you have any questions, feel free to ask.  \n\nHappy exploring!"
                );
                $curl = curl_init();
                // echo "https://api.ultramsg.com/instance$setting_details->whats_app_instance/messages/image";
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.ultramsg.com/instance$setting_details->whats_app_instance/messages/image",
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
                    // echo $response;
                }
            }
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
