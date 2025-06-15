<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function showAttendance(Request $request){
        $main_title= "Employee-Attendance";

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

    public function addAttendance(Request $request){
        $main_title= "Add-Employee-Attendance";

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
        $employeeId = $request->employee_id;
        $today = now()->toDateString();

        Attendance::updateOrCreate(
            ['employee_id' => $employeeId, 'date' => $today],
            ['check_in_time' => now()->format('H:i:s'), 'status' => 'Present']
        );

        return back()->with('success', 'Check-in recorded!');
    }

    public function markCheckOut(Request $request)
    {
        $employeeId = $request->employee_id;
        $today = now()->toDateString();

        Attendance::where('employee_id', $employeeId)
            ->where('date', $today)
            ->update(['check_out_time' => now()->format('H:i:s')]);

        return back()->with('success', 'Check-out recorded!');
    }

}
