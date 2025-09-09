<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\WhatsAppFlow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

    public function addWhatsApp(Request $request)
    {
        $main_title = "Admin-Add-Whats-App";

        $title =    "Add Whats-App";

        return view('admin.setting.add', [
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

    public function saveWhatsAppFlow(Request $request)
    {
        $request->validate([
            // "name"      =>  "required|unique:departments,name,".$request->input('edit_id'),
            'searching_words'   =>  "required|unique:whats_app_flows,searching_words,".$request->input('edit_id'),
            'image'             =>  'nullable|file|image|mimes:jpg,jpeg,gif,png,webp,bmp|max:16384', // 16MB = 16384 KB
            'document'          =>  'nullable|file|mimes:zip,xlsx,csv,txt,pptx,docx,doc,ppt,pdf,rar,7z,xls|max:30720', //30MB = 30×1024 = 30720 KB
            'filename'          =>  "nullable|string|max:255",
            'audio'             =>  "nullable|file|mimes:mp3,aac,ogg|max:16384", //16 mb
            'video'             =>  'nullable|file|mimes:mp4,3gp,mov|max:16384',
            "reply"             =>  "required",
        ]);

        $directory = "whatsapp";
        Storage::disk('public')->makeDirectory($directory);

        if ($request->input("edit_id") == "") {
            $image_name     = "";
            $document_name  = "";
            $audio_name     = "";
            $video_name     = "";

            //FOR IMAGE
            if ($request->file("image") && $request->file("image")->isValid()) {
                $file = $request->file('image');

                // Generate encrypted (random) filename with original extension
                $image_name = Str::random(40) . '.' . $file->getClientOriginalExtension();

                // Store in public/images folder
                $path = $file->storeAs($directory, $image_name, 'public');
            }

            //FOR DOCUMENT
            if ($request->file("document") && $request->file("document")->isValid()) {
                $file = $request->file('document');

                // Generate encrypted (random) filename with original extension
                $document_name = Str::random(40) . '.' . $file->getClientOriginalExtension();

                // Store in public/documents folder
                $path = $file->storeAs($directory, $document_name, 'public');
                // echo "<pre>";
                // print_r($path);
            }

            //FOR Audio
            if ($request->file("audio") && $request->file("audio")->isValid()) {
                $file = $request->file('audio');

                // Generate encrypted (random) filename with original extension
                $audio_name = Str::random(40) . '.' . $file->getClientOriginalExtension();

                // Store in public/audios folder
                $path = $file->storeAs($directory, $audio_name, 'public');
                // echo "<pre>";
                // print_r($path);
            }

            //FOR Video
            if ($request->file("video") && $request->file("video")->isValid()) {
                $file = $request->file('video');

                // Generate encrypted (random) filename with original extension
                $video_name = Str::random(40) . '.' . $file->getClientOriginalExtension();

                // Store in public/videos folder
                $path = $file->storeAs($directory, $video_name, 'public');
                // echo "<pre>";
                // print_r($path);
            }

            $insert = WhatsAppFlow::create([
                "searching_words"   =>  $request->input("searching_words"),
                "reply"             =>  $request->input("reply"),
                "image"             =>  $image_name,
                "document"          =>  $document_name,
                "filename"          =>  $request->filename,
                "audio"             =>  $audio_name,
                "video"             =>  $video_name
            ]);
            if ($insert) {
                return redirect()->back()->with('success', 'Successfully Inserted!!!');
            } else {
                return redirect()->back()->with('error', 'There is some issue in inserted!!!');
            }
        } else {
            $old_data = WhatsAppFlow::where("id", $request->input("edit_id"))->first();

            $image_name     = $old_data->image;
            $document_name  = $old_data->document;
            $audio_name     = $old_data->audio;
            $video_name     = $old_data->video;

            //FOR IMAGE
            if ($request->file("image") && $request->file("image")->isValid()) {
                $file = $request->file('image');

                // Generate encrypted (random) filename with original extension
                $image_name = Str::random(40) . '.' . $file->getClientOriginalExtension();

                // Store in public/images folder
                $path = $file->storeAs($directory, $image_name, 'public');
            }

            //FOR DOCUMENT
            if ($request->file("document") && $request->file("document")->isValid()) {
                $file = $request->file('document');

                // Generate encrypted (random) filename with original extension
                $document_name = Str::random(40) . '.' . $file->getClientOriginalExtension();

                // Store in public/documents folder
                $path = $file->storeAs($directory, $document_name, 'public');
                // echo "<pre>";
                // print_r($path);
            }

            //FOR Audio
            if ($request->file("audio") && $request->file("audio")->isValid()) {
                $file = $request->file('audio');

                // Generate encrypted (random) filename with original extension
                $audio_name = Str::random(40) . '.' . $file->getClientOriginalExtension();

                // Store in public/audios folder
                $path = $file->storeAs($directory, $audio_name, 'public');
                // echo "<pre>";
                // print_r($path);
            }

            //FOR Video
            if ($request->file("video") && $request->file("video")->isValid()) {
                $file = $request->file('video');

                // Generate encrypted (random) filename with original extension
                $video_name = Str::random(40) . '.' . $file->getClientOriginalExtension();

                // Store in public/videos folder
                $path = $file->storeAs($directory, $video_name, 'public');
                // echo "<pre>";
                // print_r($path);
            }

            $update = WhatsAppFlow::where("id", $request->input("edit_id"))->update([
                "searching_words"     =>  $request->input("searching_words"),
                "reply"               =>  $request->input("reply"),
                "image"             =>  $image_name,
                "document"          =>  $document_name,
                "filename"          =>  $request->filename,
                "audio"             =>  $audio_name,
                "video"             =>  $video_name
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

    public function deleteWhatsAppFlow($del_id, Request $request)
    {
        $delete  = WhatsAppFlow::where("id", $del_id)->delete();

        if ($delete) {
            return redirect()->back()->with('success', 'Successfully Deleted!!!');
        } else {
            return redirect()->back()->with('error', 'There is some issue in deleted!!!');
        }
    }

    public function deleteWhatsApp($del_id, Request $request)
    {
        $delete  = Setting::truncate();

        if ($delete) {
            return redirect()->back()->with('success', 'Successfully Deleted!!!');
        } else {
            return redirect()->back()->with('error', 'There is some issue in deleted!!!');
        }
    }
}
