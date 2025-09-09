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

                        <h4 class="card-title">Add Leave</h4>
                        <form class="forms-sample" method="POST" action="{{ route('save.leaves') }}">
                            @csrf
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="text" class="form-control" id="start_date" name="start_date" placeholder="Enter Start Date" value="{{ $details->start_date ?? '' }}"/>
                            </div>

                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="text" class="form-control" id="end_date" name="end_date" placeholder="Enter End Date" value="{{ $details->end_date ?? '' }}"/>
                            </div>

                            <div class="form-group">
                                <label for="email">Leave Type</label>
                                <input type="text" class="form-control" id="leave_type" name="leave_type" placeholder="Enter Leave Type like Casual, Medical" value="{{ $details->leave_type ?? '' }}"/>
                            </div>

                            <div class="form-group">
                                <label for="reason">Reason</label>
                                <textarea class="form-control" id="reason" name="reason" placeholder="Enter Reason">{{ $details->reason ?? '' }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="dept_id">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="" selected>Please Select</option>
                                    <option value="pending" @if(isset($details) && $details->status == "pending") selected @endif>Pending</option>
                                    <option value="approved" @if(isset($details) && $details->status == "approved") selected @endif>Approved</option>
                                    <option value="rejected" @if(isset($details) && $details->status == "rejected") selected @endif>Rejected</option>
                                </select>
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
        $( "#start_date, #end_date" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
    });
    </script>
@endpush
