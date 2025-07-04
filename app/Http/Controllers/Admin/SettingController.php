<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
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

    public function addWhatsApp(Request $request)
    {
        $main_title = "Admin-Add-Setting";

        $title =    "Add Setting";

        return view('admin.setting.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
        ]);
    }

    public function editWhatsApp($edit_id, Request $request)
    {
        $main_title = "Admin-Edit-Setting";

        $title =    "Edit Setting";

        $details = Setting::where("id", $edit_id)->first();

        return view('admin.setting.add', [
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
