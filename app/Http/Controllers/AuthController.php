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
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      =>  '1',
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
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

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $page_access_details = PageAccess::where("department_id", Auth::user()->role)->get();
            session([
                'user'          =>  Auth::id(),
                'name'          =>  Auth::user()->name,
                'email'         =>  Auth::user()->email,
                'image'         =>  Auth::user()->image,
                'role'          =>  Auth::user()->role,
                'stripe_id'     =>  Auth::user()->stripe_id,
                'phone'         =>  Auth::user()->phone,
                'page_access'   =>  $page_access_details,
            ]);
            $setting_details = Setting::where("id", 1)->first();
            $params = array(
                'token' => '{{ $setting_details->whats_app_token }}',
                'to' => Auth::user()->phone,
                'image' => env('APP_URL').'/frontend/images/logo.png',
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
