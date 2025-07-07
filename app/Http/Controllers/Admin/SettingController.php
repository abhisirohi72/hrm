<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\WhatsAppFlow;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function viewWhatsApp(Request $request)
    {
        $main_title = "Admin-Setting";

        $title =    "Setting View";

        $details = Setting::all();

        return view('admin.setting.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details
        ]);
    }

    public function viewWhatsAppFlow(Request $request)
    {
        $main_title = "Admin-Whats-App-Flow";

        $title =    "Whats App Flow View";

        $details = WhatsAppFlow::all();

        return view('admin.setting.flow_view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details
        ]);
    }

    public function addWhatsAppFlow(Request $request)
    {
        $main_title = "Admin-Add-Whats-App-Flow";

        $title =    "Add Whats-App-Flow";

        return view('admin.setting.flow_add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
        ]);
    }

    public function editWhatsAppFlow($edit_id, Request $request)
    {
        $main_title = "Admin-Edit-Whats-App-Flow";

        $title =    "Edit Whats-App-Flow";

        $details = WhatsAppFlow::where("id", $edit_id)->first();

        return view('admin.setting.flow_add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'edit_id'       =>  $edit_id,
            'details'       =>  $details,
        ]);
    }

    public function saveWhatsApp(Request $request)
    {
        return $this->addUpdateWhatsApp($request);
    }

    public function saveWhatsAppFlow(Request $request){
        $request->validate([
            // "name"      =>  "required|unique:departments,name,".$request->input('edit_id'),
            'searching_words'     => 'required',
            "reply" =>  "required",
        ]);
        
        if ($request->input("edit_id") == "") {
            // echo 
            $insert = WhatsAppFlow::create([
                "searching_words"     =>  $request->input("searching_words"),
                "reply"               =>  $request->input("reply"),
            ]);
            if ($insert) {
                return redirect()->back()->with('success', 'Successfully Inserted!!!');
            } else {
                return redirect()->back()->with('error', 'There is some issue in inserted!!!');
            }
        } else {
            $update = WhatsAppFlow::where("id", $request->input("edit_id"))->update([
                "searching_words"     =>  $request->input("searching_words"),
                "reply"               =>  $request->input("reply"),
            ]);

            if ($update) {
                return redirect()->back()->with('success', 'Successfully Updated!!!');
            } else {
                return redirect()->back()->with('error', 'There is some issue in updated!!!');
            }
        }
    }

    public function addUpdateWhatsApp($request)
    {
        $request->validate([
            'whats_app_token'       =>  'required',
            'whats_app_instance'    =>  'required',
        ]);
        
        Setting::updateOrCreate(
            ['id' => 1],
            [
                'whats_app_token'      => $request->input('whats_app_token') ?? '',
                'whats_app_instance'   => $request->input('whats_app_instance') ?? '',
            ]
        );

        return redirect()->back()->with("success", "Record has been successfully saved!!!");
    }

    public function deleteEmp($del_id, Request $request)
    {
        $delete  = Setting::where("id", $del_id)->delete();

        if ($delete) {
            return redirect()->back()->with('success', 'Successfully Deleted!!!');
        } else {
            return redirect()->back()->with('error', 'There is some issue in deleted!!!');
        }
    }
}
