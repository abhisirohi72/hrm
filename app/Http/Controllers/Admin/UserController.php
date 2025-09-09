<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function viewUserDetails(Request $request){
        $main_title= "Admin-Customers-View";

        $title =    "Customers View";

        $details= User::where("role", "1")->get();

        return view('admin.users.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details
        ]);
    }

    public function addUserDetails(Request $request){
        $main_title= "Admin-Add-Customers";

        $title =    "Add Customers";

        return view('admin.users.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
        ]);
    }

    public function editUserDetails($edit_id, Request $request){
        $main_title= "Admin-Edit-Customers";

        $title =    "Edit Customers";

        $details = User::where("id", $edit_id)->first();

        return view('admin.users.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'edit_id'       =>  $edit_id,
            'details'       =>  $details,
        ]);
    }

    public function saveUserDetails(Request $request){
        return $this->addUpdateUserDetails($request, "add");
    }

    public function addUpdateUserDetails($request, $cond){
        $request->validate([
            'image'         => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "name"          =>  "required",
            "email"         =>  "required|unique:users,email,".$request->input('edit_id'),
        ]);

        $directory = "users";
        Storage::disk('public')->makeDirectory($directory);

        if($request->input("edit_id")==""){
            $image_name =   "";
            if($request->file("image") && $request->file("image")->isValid()){
                $file = $request->file('image');

                // Generate encrypted (random) filename with original extension
                $image_name = Str::random(40) . '.' . $file->getClientOriginalExtension();

                // Store in public/images folder
                $path = $file->storeAs($directory, $image_name, 'public');
            }

            
            $insert= User::create([
                "name"              =>  $request->name ?? '',
                "email"             =>  $request->email ?? '',
                "password"          =>  Hash::make($request->password) ?? '',
                "image"             =>  $image_name,
                "wallet_balance"    =>  $request->wallet_balance ?? '',
                'stripe_id'         =>  $request->stripe_id ?? '',
                'role'              =>  '1',
            ]);

            if($insert){
                return redirect()->back()->with('success', 'Successfully Inserted!!!');
            }else{
                return redirect()->back()->with('error', 'There is some issue in inserted!!!');
            }
        }else{
            $old_data = User::where("id", $request->edit_id)->first();
            $image_name = $old_data->image;

            if($request->file("image") && $request->file("image")->isValid()){
                $file = $request->file('image');

                // Generate encrypted (random) filename with original extension
                $image_name = Str::random(40) . '.' . $file->getClientOriginalExtension();

                // Store in public/images folder
                $path = $file->storeAs($directory, $image_name, 'public');
            }

            $update= User::where("id", $request->input("edit_id"))->update([
                "name"              =>  $request->name ?? '',
                "email"             =>  $request->email ?? '',
                "password"          =>  Hash::make($request->password) ?? '',
                "image"             =>  $image_name,
                "wallet_balance"    =>  $request->wallet_balance ?? '',
                'stripe_id'         =>  $request->stripe_id ?? '',
                'role'              =>  '1',
            ]);

            if($update){
                return redirect()->back()->with('success', 'Successfully Updated!!!');
            }else{
                return redirect()->back()->with('error', 'There is some issue in updated!!!');
            }
        }
    }

    public function deleteLeave($del_id){
        $delete  = user::where("id", $del_id)->delete();

        if($delete){
            return redirect()->back()->with('success', 'Successfully Deleted!!!');
        }else{
            return redirect()->back()->with('error', 'There is some issue in deleted!!!');
        }
    }
}
