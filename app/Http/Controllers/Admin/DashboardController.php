<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Employee;
use App\Models\Lead;
use App\Models\TelecalerFeedback;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function view(Request $request){
        $title      =   "Admin-Dashboard";
        $t_leads    =   Lead::count();
        $t_feedback =   TelecalerFeedback::count();
        $t_campaign =   Campaign::count();
        $t_emp      =   Employee::count();
        // exit;
        return view('admin.dashboard', [
            'title'         =>  $title,
            't_leads'       =>  $t_leads,
            't_feedback'    =>  $t_feedback,
            't_campaign'    =>  $t_campaign,
            't_emp'         =>  $t_emp,
        ]);
    }
}
