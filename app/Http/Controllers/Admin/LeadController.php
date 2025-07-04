<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\Setting;

class LeadController extends Controller
{
    public function index()
    {
        $main_title = "Admin-Leads-View";

        $title =    "Leads View";

        $leads = Lead::orderBy('created_at', 'desc')->get();

        return view('admin.leads.view', compact('leads', 'main_title', 'title'));
    }

    public function create()
    {
        $main_title = "Admin-Add-Leads";

        $title =    "Leads Create";

        return view('admin.leads.add', compact('main_title', 'title'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'nullable|email',
            'source' => 'nullable',
            'status' => 'required',
            'last_call_date' => 'nullable|date',
            'next_followup_date' => 'nullable|date',
            'remarks' => 'nullable'
        ]);

        Lead::create($data);
        $setting_details = Setting::where("id", 1)->first();
        $params = array(
            'token' => '{{ $setting_details->whats_app_token }}',
            'to' => $request->input("phone"),
            'image' => env('APP_URL') . '/frontend/images/logo.png',
            'caption' => "Hello " . $request->input("name") . " 👋,  \n\nWelcome to Webfintech! 🎉  \nWe're excited to have you on board. If you have any questions, feel free to ask. 
            \nNew Lead has been generated, \n\nHappy exploring!"
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
        return redirect()->back()->with('success', 'Lead added.');
    }

    public function edit(Lead $lead)
    {
        $main_title = "Admin-Edit-Leads";

        $title =    "Leads Edit";
        // Ensure the lead exists
        if (!$lead) {
            return redirect()->route('leads.index')->with('error', 'Lead not found.');
        }
        // Pass the lead data to the view
        $details = Lead::find($lead->id);
        return view('admin.leads.add', compact('details', 'main_title', 'title'));
    }

    public function update(Request $request, Lead $lead)
    {
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'nullable|email',
            'source' => 'nullable',
            'status' => 'required',
            'last_call_date' => 'nullable|date',
            'next_followup_date' => 'nullable|date',
            'remarks' => 'nullable'
        ]);

        $lead->update($data);
        return redirect()->back()->with('success', 'Lead updated.');
    }
}
