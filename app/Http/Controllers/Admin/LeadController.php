<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;

class LeadController extends Controller
{
    public function index()
    {
        $main_title= "Admin-Leads-View";

        $title =    "Leads View";

        $leads = Lead::orderBy('created_at', 'desc')->get();

        return view('admin.leads.view', compact('leads', 'main_title', 'title'));
    }

    public function create()
    {
        $main_title= "Admin-Add-Leads";

        $title =    "Leads Create";

        return view('admin.leads.add', compact('main_title', 'title'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'nullable|email',
            'source' => 'nullable',
            'status' => 'required',
            'last_call_date' => 'nullable|date',
            'next_followup_date' => 'nullable|date',
            'remarks' => 'nullable'
        ]);

        Lead::create($data);
        return redirect()->back()->with('success', 'Lead added.');
    }

    public function edit(Lead $lead)
    {
        $main_title= "Admin-Edit-Leads";

        $title =    "Leads Edit";
        // Ensure the lead exists
        if (!$lead) {
            return redirect()->route('leads.index')->with('error', 'Lead not found.');
        }
        // Pass the lead data to the view
        $details = Lead::find($lead->id);
        return view('admin.leads.add', compact('details', 'main_title', 'title'));
    }

    public function update(Request $request, Lead $lead)
    {
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'nullable|email',
            'source' => 'nullable',
            'status' => 'required',
            'last_call_date' => 'nullable|date',
            'next_followup_date' => 'nullable|date',
            'remarks' => 'nullable'
        ]);

        $lead->update($data);
        return redirect()->back()->with('success', 'Lead updated.');
    }
}
