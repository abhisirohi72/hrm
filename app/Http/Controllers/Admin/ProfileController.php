<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function viewProfile(Request $request)
    {
        $main_title = "Admin-Add-Profile";

        $title =    "Add Profile";

        $details = User::where("id", session('user'))->first();

        return view('admin.users.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details
        ]);
    }

    public function saveProfile(Request $request)
    {
        return $this->addUpdateProfile($request, "add");
    }

    public function addUpdateProfile($request, $cond)
    {
        $request->validate([
            // "name"      =>  "required|unique:departments,name,".$request->input('edit_id'),
            'image'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "name"      =>  "required",
        ]);

        $directory = "users";
        Storage::disk('public')->makeDirectory($directory);

        $filename  = $request->input("old_image");
        // echo $request->file("image")->isValid(); exit;
        if ($request->file("image") && $request->file("image")->isValid()) {
            $file = $request->file('image');

            // Generate encrypted (random) filename with original extension
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();

            // Store in public/images folder
            $path = $file->storeAs($directory, $filename, 'public');
            // echo "<pre>";
            // print_r($path);
        }
        // exit;
        $update = User::where("id", session('user'))->update([
            "image"         =>  $filename,
            "name"          =>  $request->input("name"),
            "stripe_id"          =>  $request->input("stripe_id"),
        ]);

        if ($update) {
            return redirect()->back()->with('success', 'Successfully Updated!!!');
        } else {
            return redirect()->back()->with('error', 'There is some issue in updated!!!');
        }
    }
}
