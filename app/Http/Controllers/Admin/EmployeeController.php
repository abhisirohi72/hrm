<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Hash;
use App\Models\Setting;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function viewEmp(Request $request)
    {
        $main_title = "Admin-Employee";

        $title =    "Employee";

        $details = Employee::with(['departments', 'branches'])->get();

        return view('admin.emp.view', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'details'       =>  $details
        ]);
    }

    public function addEmp(Request $request)
    {
        $main_title = "Admin-Add-Employee";

        $title =    "Add Employee";

        $departments = Department::all();
        $branches = Branch::all();

        return view('admin.emp.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'departments'   =>  $departments,
            'branches'      =>  $branches
        ]);
    }

    public function editEmp($edit_id, Request $request)
    {
        $main_title = "Admin-Edit-Employee";

        $title =    "Edit Employee";

        $departments = Department::all();

        $branches = Branch::all();

        $details = Employee::where("id", $edit_id)->first();

        return view('admin.emp.add', [
            'main_title'    =>  $main_title,
            'title'         =>  $title,
            'edit_id'       =>  $edit_id,
            'details'       =>  $details,
            'departments'   =>  $departments,
            'branches'      =>  $branches
        ]);
    }

    public function saveEmp(Request $request)
    {
        return $this->addUpdateEmp($request, "add");
    }

    public function addUpdateEmp($request, $cond)
    {
        $edit_id= $request->input('edit_id');
        $request->validate([
            // "name"      =>  "required|unique:departments,name,".$request->input('edit_id'),
            'image'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "full_name" =>  "required",
            'email' => [
                'required',
                Rule::unique('employees', 'email')->ignore($edit_id), // ignore for current employee
                function ($attribute, $value, $fail) use ($edit_id) {
                    $existsInUsers = DB::table('users')->where('email', $value)->exists();
                    if ($existsInUsers) {
                        $fail('The email has already been taken in the users table.');
                    }
                }
            ],
            "emp_id"     =>  "required|unique:employees,emp_id," . $request->input('edit_id'),
            "mobile"    =>  "required",
            "dob"       =>  "required",
            "address"   =>  "required",
            "dept_id"   =>  "required",
            "branch_id" =>  "required",
            "status"    =>  "required",
            // "password"  =>  "required",
        ]);

        $directory = "users";
        Storage::disk('public')->makeDirectory($directory);

        if ($request->input("edit_id") == "") {
            $filename = "";
            if ($request->file("image") && $request->file("image")->isValid()) {
                $file = $request->file('image');

                // Generate encrypted (random) filename with original extension
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();

                // Store in public/images folder
                $path = $file->storeAs($directory, $filename, 'public');
            }
            $encrypt_pass = Hash::make($request->password);
            // echo 
            $insert = Employee::create([
                "image"         =>  $filename,
                "full_name"     =>  $request->input("full_name"),
                "email"         =>  $request->input("email"),
                "mobile"        =>  $request->input("mobile"),
                "dob"           =>  $request->input("dob"),
                "address"       =>  $request->input("address"),
                "dept_id"       =>  $request->input("dept_id"),
                "branch_id"     =>  $request->input("branch_id"),
                "joinning_date" =>  $request->input("joinning_date"),
                "salary"        =>  $request->input("salary"),
                "status"        =>  $request->input("status"),
                'password'      =>  $encrypt_pass,
                "emp_id"        =>  $request->emp_id
            ]);
            // echo "<pre>";
            // print_r([
            //     "name"      =>  $request->input("full_name"),
            //     "email"     =>  $request->input("email"),
            //     "image"     =>  $filename,
            //     "password"  =>  $encrypt_pass,
            //     "role"      =>  $request->input("dept_id"),
            // ]);
            // exit;
            //insert on user table also
            $user_insert = User::create([
                "name"      =>  $request->input("full_name"),
                "email"     =>  $request->input("email"),
                "image"     =>  $filename,
                "password"  =>  $encrypt_pass,
                "role"      =>  $request->input("dept_id"),
                "phone"     =>  $request->input("mobile"),
            ]);

            if ($insert) {
                $setting_details = Setting::where("id", 1)->first();
                $params = array(
                    'token' => '{{ $setting_details->whats_app_token }}',
                    'to' => $request->input("mobile"),
                    'image' => env('APP_URL') . '/frontend/images/logo.png',
                    'caption' => "Hello " . $request->input("full_name") . " 👋,  \n\nWelcome to Webfintech! 🎉  \nWe're excited to have you on board. If you have any questions, feel free to ask.\n\n Emp ID:-".$request->emp_id."\n Email:-".$request->email."\nPassword:- ".$request->password."  \n\nHappy exploring!"
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
                return redirect()->back()->with('success', 'Successfully Inserted!!!');
            } else {
                return redirect()->back()->with('error', 'There is some issue in inserted!!!');
            }
        } else {
            //get old data
            $old_data = Employee::where("id", $request->edit_id)->first();

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
            $update = Employee::where("id", $request->input("edit_id"))->update([
                "image"         =>  $filename,
                "full_name"     =>  $request->input("full_name"),
                "email"         =>  $request->input("email"),
                "mobile"        =>  $request->input("mobile"),
                "dob"           =>  $request->input("dob"),
                "address"       =>  $request->input("address"),
                "dept_id"       =>  $request->input("dept_id"),
                "branch_id"     =>  $request->input("branch_id"),
                "joinning_date" =>  $request->input("joinning_date"),
                "salary"        =>  $request->input("salary"),
                "status"        =>  $request->input("status"),
                'password'      => ($request->password != "") ? Hash::make($request->password) : $old_data->password,
                "emp_id"        =>  $request->emp_id
            ]);

            if ($update) {
                //update on user table
                $old_user_data = User::where("email", $request->email)->first();
                if ($old_user_data) {
                    // echo "<pre>";
                    // print_r([
                    //     "name"      =>  $request->input("full_name"),
                    //     "email"     =>  $request->input("email"),
                    //     "image"     =>  $filename,
                    //     "password"  =>  ($request->password != "") ? Hash::make($request->password) : $old_data->password,
                    //     "role"      =>  $request->input("dept_id"),
                    // ]);
                    // exit;
                    User::where("email", $request->email)->update([
                        "name"      =>  $request->input("full_name"),
                        "image"     =>  $filename,
                        "password"  => ($request->password != "") ? Hash::make($request->password) : $old_data->password,
                        "role"      =>  $request->input("dept_id"),
                        "phone"     =>  $request->input("mobile"),
                    ]);
                }
                return redirect()->back()->with('success', 'Successfully Updated!!!');
            } else {
                return redirect()->back()->with('error', 'There is some issue in updated!!!');
            }
        }
    }

    public function deleteEmp($del_id, Request $request)
    {
        $delete  = Employee::where("id", $del_id)->delete();

        if ($delete) {
            return redirect()->back()->with('success', 'Successfully Deleted!!!');
        } else {
            return redirect()->back()->with('error', 'There is some issue in deleted!!!');
        }
    }

    public function viewEmpIcard($emp_id, Request $request)
    {
        $details = Employee::with(['departments', 'branches'])->where("id", $emp_id)->first();

        return response()->json([
            'details' => $details
        ]);
    }

    public function viewJoinningLetter($emp_id, Request $request)
    {
        $employee = Employee::with(['departments', 'branches'])->where("id", $emp_id)->first();
        $company_name = "Your Company Name";
        $hr_name = "HR Manager";

        $html = view('admin.emp.joining_letter', [
            'employee'      =>  $employee,
            'company_name'  =>  $company_name,
            'hr_name'       =>  $hr_name
        ])->render();

        return response()->json(['html' => $html]);
    }

    public function viewOfferLetter($emp_id, Request $request)
    {
        $employee = Employee::with(['departments', 'branches'])->where("id", $emp_id)->first();
        $company_name = "Your Company Name";
        $hr_name = "HR Manager";

        $html = view('admin.emp.offer_letter', [
            'employee'      =>  $employee,
            'company_name'  =>  $company_name,
            'hr_name'       =>  $hr_name
        ])->render();

        return response()->json(['html' => $html]);
    }

    public function downloadOfferLetter($emp_id, Request $request)
    {
        $employee = Employee::with(['departments', 'branches'])->where("id", $emp_id)->first();
        $company_name = "Your Company Name";
        $hr_name = "HR Manager";

        $pdf = Pdf::loadView('admin.emp.d_offer_letter', [
            'employee'      =>  $employee,
            'company_name'  =>  $company_name,
            'hr_name'       =>  $hr_name
        ]);

        return $pdf->download("Offer_Letter_{$employee->employee_code}.pdf");
    }

    public function downloadJoinningLetter($emp_id, Request $request)
    {
        $employee = Employee::with(['departments', 'branches'])->where("id", $emp_id)->first();
        $company_name = "Your Company Name";
        $hr_name = "HR Manager";

        $pdf = Pdf::loadView('admin.emp.d_joinning_letter', [
            'employee'      =>  $employee,
            'company_name'  =>  $company_name,
            'hr_name'       =>  $hr_name
        ]);

        return $pdf->download("Joinning_letter_{$employee->employee_code}.pdf");
    }

    public function downloadIcard($emp_id, Request $request)
    {
        $employee = Employee::with(['departments', 'branches'])->where("id", $emp_id)->first();
        $company_name = "Your Company Name";
        $hr_name = "HR Manager";

        $pdf = Pdf::loadView('admin.emp.icard', [
            'employee'      =>  $employee,
            'company_name'  =>  $company_name,
            'hr_name'       =>  $hr_name
        ]);

        return $pdf->download("Icard_{$employee->employee_code}.pdf");
    }
}
