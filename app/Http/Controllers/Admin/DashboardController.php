<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Employee;
use App\Models\Lead;
use App\Models\OrderHistory;
use App\Models\TelecalerFeedback;
use App\Models\Todo;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function view(Request $request){
        $title          =   "Admin-Dashboard";
        $t_leads        =   Lead::count();
        $t_feedback     =   TelecalerFeedback::count();
        $t_campaign     =   Campaign::count();
        $t_emp          =   Employee::count();
        $o_history      =   OrderHistory::with(['single_products', 'users'])->get();
        $todos          =   Todo::all();
        $r_customers    =   User::where("role", "1")->get();
        // echo "<pre>";
        // print_r($o_history);
        // exit;
        return view('admin.dashboard', [
            'title'         =>  $title,
            't_leads'       =>  $t_leads,
            't_feedback'    =>  $t_feedback,
            't_campaign'    =>  $t_campaign,
            't_emp'         =>  $t_emp,
            'o_history'     =>  $o_history,
            'todos'         =>  $todos,
            'r_customers'   =>  $r_customers,
        ]);
    }
}
