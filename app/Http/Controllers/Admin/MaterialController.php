<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MaterialController extends Controller
{
    public function viewMaterial(Request $request){
        $main_title= "Admin-Materials-View";

        $title =    "Materials View";

        $details= Material::all();

        return view('admin.material.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details
        ]);
    }

    public function addMaterial(Request $request){
        $main_title= "Admin-Add-Material";

        $title =    "Add Material";

        return view('admin.material.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
        ]);
    }

    public function editMaterial($edit_id, Request $request){
        $main_title= "Admin-Edit-Material";

        $title =    "Edit Material";

        $details = Material::where("id", $edit_id)->first();

        return view('admin.material.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'edit_id'       =>  $edit_id,
            'details'       =>  $details,
        ]);
    }

    public function saveMaterial(Request $request){
        return $this->addUpdateMaterial($request, "add");
    }

    public function addUpdateMaterial($request, $cond){

        $directory = "materials";
        Storage::disk('public')->makeDirectory($directory);

        if($request->input("edit_id")==""){
            $image_name =   "";
            $pdf_name   =   "";
            $video_name =   "";
            if($request->file("image") && $request->file("image")->isValid()){
                $file = $request->file('image');

                // Generate encrypted (random) filename with original extension
                $image_name = Str::random(40) . '.' . $file->getClientOriginalExtension();

                // Store in public/images folder
                $path = $file->storeAs($directory, $image_name, 'public');
            }

            if($request->file("pdf") && $request->file("pdf")->isValid()){
                $file = $request->file('pdf');

                // Generate encrypted (random) filename with original extension
                $pdf_name = Str::random(40) . '.' . $file->getClientOriginalExtension();

                // Store in public/images folder
                $path = $file->storeAs($directory, $pdf_name, 'public');
            }

            if($request->file("video") && $request->file("video")->isValid()){
                $file = $request->file('video');

                // Generate encrypted (random) filename with original extension
                $video_name = Str::random(40) . '.' . $file->getClientOriginalExtension();

                // Store in public/images folder
                $path = $file->storeAs($directory, $video_name, 'public');
            }
            $insert= Material::create([
                "pdf"   =>  $pdf_name   ?? '',
                "video" =>  $video_name ?? '' ,
                "image" =>  $image_name ?? '',
            ]);

            if($insert){
                return redirect()->back()->with('success', 'Successfully Inserted!!!');
            }else{
                return redirect()->back()->with('error', 'There is some issue in inserted!!!');
            }
        }else{
            $old_data = Material::where("id", $request->edit_id)->first();
            $image_name = $old_data->image;
            $pdf_name   = $old_data->pdf;
            $video_name = $old_data->video;

            if($request->file("image")->isValid()){
                $file = $request->file('image');

                // Generate encrypted (random) filename with original extension
                $image_name = Str::random(40) . '.' . $file->getClientOriginalExtension();

                // Store in public/images folder
                $path = $file->storeAs($directory, $image_name, 'public');
            }

            if($request->file("pdf")->isValid()){
                $file = $request->file('pdf');

                // Generate encrypted (random) filename with original extension
                $pdf_name = Str::random(40) . '.' . $file->getClientOriginalExtension();

                // Store in public/images folder
                $path = $file->storeAs($directory, $pdf_name, 'public');
            }

            if($request->file("video")->isValid()){
                $file = $request->file('video');

                // Generate encrypted (random) filename with original extension
                $video_name = Str::random(40) . '.' . $file->getClientOriginalExtension();

                // Store in public/images folder
                $path = $file->storeAs($directory, $video_name, 'public');
            }

            $update= Material::where("id", $request->input("edit_id"))->update([
                "pdf"   =>  $pdf_name   ?? '',
                "video" =>  $video_name ?? '' ,
                "image" =>  $image_name ?? '',
            ]);

            if($update){
                return redirect()->back()->with('success', 'Successfully Updated!!!');
            }else{
                return redirect()->back()->with('error', 'There is some issue in updated!!!');
            }
        }
    }

    public function deleteLeave($del_id){
        $delete  = Material::where("id", $del_id)->delete();

        if($delete){
            return redirect()->back()->with('success', 'Successfully Deleted!!!');
        }else{
            return redirect()->back()->with('error', 'There is some issue in deleted!!!');
        }
    }
}
