@extends('layouts.admin.app')

@section('title', $main_title)

@section('content')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">{{ $title }}</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> {{ $title }} </li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <h4 class="card-title">Add Leads Details</h4>
                        @if(!empty($details))
                            <form class="forms-sample" method="POST" action="{{ route('leads.update', ['lead' => $details->id]) }}" enctype="multipart/form-data">
                        @else
                        <form class="forms-sample" method="POST" action="{{ route('leads.store') }}" enctype="multipart/form-data">
                        @endif
                            @csrf
                            <div class="form-group">
                                <label for="name">Leads Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Leads Name" value="{{ $details->name ?? '' }}"/>
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone" value="{{ $details->phone ?? '' }}"/>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{ $details->email ?? '' }}"/>
                            </div>

                            <div class="form-group">
                                <label for="source">Source</label>
                                <input type="text" class="form-control" id="source" name="source" placeholder="Enter Source" value="{{ $details->source ?? '' }}"/>
                            </div>

                            <div class="form-group">
                                <label for="dept_id">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="" selected>Please Select</option>
                                    <option value="New" @if(isset($details) && $details->status == "New") selected @endif>New</option>
                                    <option value="Follow-up" @if(isset($details) && $details->status == "Follow-up") selected @endif>Follow-up</option>
                                    <option value="Converted" @if(isset($details) && $details->status == "Converted") selected @endif>Converted</option>
                                    <option value="Rejected" @if(isset($details) && $details->status == "Rejected") selected @endif>Rejected</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="last_call_date">Last Call Date</label>
                                <input type="text" class="form-control" id="last_call_date" name="last_call_date" placeholder="Enter Last Call Date" value="{{ $details->last_call_date ?? '' }}"/>
                            </div>

                            <div class="form-group">
                                <label for="next_followup_date">Next Follow Up Date</label>
                                <input type="text" class="form-control" id="next_followup_date" name="next_followup_date" placeholder="Enter Full Name" value="{{ $details->next_followup_date ?? '' }}"/>
                            </div>

                            <div class="form-group">
                                <label for="remarks">Remarks</label>
                                <textarea class="form-control" id="remarks" name="remarks" placeholder="Enter Remarks">{{ $details->remarks ?? '' }}</textarea>
                            </div>

                            <input type="hidden" name="edit_id" id="edit_id" value="{{ $details->id ?? ''}}">
                            <button type="submit" class="btn btn-primary mr-2"> Submit </button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
<script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    <script>
    $( function() {
        $( "#last_call_date, #next_followup_date" ).datepicker({
            dateFormat: "yy-mm-dd"
        });

        function departmentData(data){
            $(".branch_opt").hide();
            $(".branch_opt").each(function(){
                if($(this).attr("data-branch-id")==data){
                    $(this).show();
                }
            });
        }
    });
    </script>
@endpush
