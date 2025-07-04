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

                        <h4 class="card-title">{{ $title }} Details</h4>
                        <form class="forms-sample" method="POST" action="{{ route('save.meeting') }}">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Assign To</label>
                                <select name="assing_to" id="assing_to" class="form-control">
                                    <option value="">Please Select</option>
                                    @foreach($user_details as $user_detail)
                                        <option value="{{ $user_detail->id }}">{{ $user_detail->email }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Date</label>
                                <input type="text" name="date" id="date" class="form-control" value="{{ $details->date ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Meeting Template</label>
                                <select name="meeting_template" id="meeting_template" class="form-control">
                                    <option value="" selected>Please Select</option>
                                    @foreach($templates as $template)
                                        <option value="{{ $template->id }}" @if(isset($details) && $details->meeting_template== $template->id) selected @endif>{{ $template->title }}</option>
                                    @endforeach    
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ $details->title ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Message</label>
                                <textarea name="message" id="message" class="form-control">{{ $details->message ?? '' }}</textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Customer Name</label>
                                <input type="text" name="customer_name" id="customer_name" class="form-control" value="{{ $details->customer_name ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="" selected>Please Select</option>
                                    <option value="0" @if(isset($details) && $details->status== "0") selected @endif>Pending</option>
                                    <option value="1" @if(isset($details) && $details->status== "1") selected @endif>Completed</option>
                                    <option value="2" @if(isset($details) && $details->status== "2") selected @endif>Missing</option>
                                </select>
                            </div>

                            <input type="hidden" name="edit_id" id="edit_id" value="{{ $details->id ?? '' }}">
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
        $( "#date" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
    });
    </script>
@endpush