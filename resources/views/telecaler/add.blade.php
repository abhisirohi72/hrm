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

                        <h4 class="card-title">Add Telecaler Feedback</h4>
                        <form class="forms-sample" method="POST" action="{{ route('save.t_feedback') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="department">Customer Name</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter Customer Name" value="{{ $b_details->customer_name ?? '' }}"/>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputUsername1">Contact Number</label>
                                <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Enter Contact Number" value="{{ $b_details->contact_number ?? '' }}"/>
                            </div>

                            <div class="form-group">
                                <label for="">Call Purpose</label>
                                <select name="call_purpose" class="form-control" id="call_purpose">
                                    <option value="">Please Select</option>
                                    <option value="0" @if(isset($b_details) && $b_details->call_purpose=='0') selected @endif>Inquiry</option>
                                    <option value="1" @if(isset($b_details) && $b_details->call_purpose=='1') selected @endif>Follow Up</option>
                                    <option value="1" @if(isset($b_details) && $b_details->call_purpose=='2') selected @endif>Promotion</option>
                                    <option value="1" @if(isset($b_details) && $b_details->call_purpose=='3') selected @endif>Complaint</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Interested</label>
                                <select name="insterested" class="form-control" id="insterested">
                                    <option value="">Please Select</option>
                                    <option value="0" @if(isset($b_details) && $b_details->insterested=='0') selected @endif>No</option>
                                    <option value="1" @if(isset($b_details) && $b_details->insterested=='1') selected @endif>Yes</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Feedback Notes</label>
                                <input type="text" class="form-control" id="feedback_notes" name="feedback_notes" placeholder="Enter your Feedback Notes" value="{{ $b_details->feedback_notes ?? ''}}">
                            </div>

                            <div class="form-group">
                                <label for="">Next Follow Up</label>
                                <input type="text" class="form-control" id="next_followup" name="next_followup" placeholder="Enter your Next Follow Up" value="{{ $b_details->next_followup ?? ''}}">
                            </div>

                            <input type="hidden" name="edit_id" id="edit_id" value="{{ $edit_id ?? ''}}">
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
        $( "#next_followup" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
    });
    </script>
@endpush
