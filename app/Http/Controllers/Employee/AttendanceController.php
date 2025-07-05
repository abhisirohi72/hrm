<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;
use App\Models\ShopFooter;

class AttendanceController extends Controller
{
    public function showAttendance(Request $request)
    {
        $main_title = "Employee-Attendance";

        $title =    "Employee Attendance";

        $details = Attendance::with('employees')->where("employee_id", Auth::user()->id)->get();
        // echo "<pre>";
        // print_r($details);
        // exit;       
        return view('attendance.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details,
        ]);
    }

    public function addAttendance(Request $request)
    {
        $main_title = "Add-Employee-Attendance";

        $title =    "Add Employee Attendance";

        // $details = Attendance::with('employees')->where("employee_id", Auth::user()->id)->get();

        return view('attendance.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'emp_id'       =>  Auth::user()->id,
        ]);
    }

    public function markCheckIn(Request $request)
    {
        // echo session('phone'); exit;
        $employeeId = $request->employee_id;
        $today = now()->toDateString();

        Attendance::updateOrCreate(
            ['employee_id' => $employeeId, 'date' => $today],
            ['check_in_time' => now()->format('H:i:s'), 'status' => 'Present']
        );

        $setting_details = Setting::where("id", 1)->first();
        $footer_details = ShopFooter::where("id", 1)->first();
        $params = array(
            'token' => '{{ $setting_details->whats_app_token }}',
            'to' => $footer_details->contact . "," . session('phone'),
            'image' => env('APP_URL') . '/frontend/images/logo.png',
            'caption' => "Hello " . session('name') . " 👋,  \n\nWelcome to Webfintech! 🎉  \nYour Check In time is " . date("Y-m-d H:i:s")
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

        return back()->with('success', 'Check-in recorded!');
    }

    public function markCheckOut(Request $request)
    {
        $employeeId = $request->employee_id;
        $today = now()->toDateString();

        Attendance::where('employee_id', $employeeId)
            ->where('date', $today)
            ->update(['check_out_time' => now()->format('H:i:s')]);
        $setting_details = Setting::where("id", 1)->first();
        $footer_details = ShopFooter::where("id", 1)->first();
        $params = array(
            'token' => '{{ $setting_details->whats_app_token }}',
            'to' => $footer_details->contact . "," . session('phone'),
            'image' => env('APP_URL') . '/frontend/images/logo.png',
            'caption' => "Hello " . session('name') . " 👋,  \n\nWelcome to Webfintech! 🎉  \nYour Check Out time is " . date("Y-m-d H:i:s")
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
        return back()->with('success', 'Check-out recorded!');
    }
}
