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

                        <h4 class="card-title">Add Target Details</h4>
                        <form class="forms-sample" method="POST" action="{{ route('save.target') }}">
                            @csrf
                            <div class="form-group">
                                <label for="employee_id">Employee Name</label>
                                <select class="form-control" id="employee_id" name="employee_id">
                                    <option value="">Select Employee</option>
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ (isset($details) && $details->employee_id == $employee->id) ? 'selected' : '' }}>
                                            {{ $employee->email }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="target_name">Target Name</label>
                                <input type="text" class="form-control" id="target_name" name="target_name" placeholder="Enter Target Name" value="{{ $details->target_name ?? '' }}"/>
                            </div>

                            <div class="form-group">
                                <label for="target_start_date">Target Start Date</label>
                                <input type="text" class="form-control" id="target_start_date" name="target_start_date" placeholder="Enter Target Start Date" value="{{ $details->target_start_date ?? '' }}"/>
                            </div>

                            <div class="form-group">
                                <label for="target_end_date">Target End Date</label>
                                <input type="text" class="form-control" id="target_end_date" name="target_end_date" placeholder="Enter Target End Date" value="{{ $details->target_end_date ?? '' }}"/>
                            </div>

                            <div class="form-group">
                                <label for="target_type">Target Type</label>
                                <select class="form-control" id="target_type" name="target_type">
                                    <option value="" selected>Select Target Type</option>
                                    <option value="0" @if(isset($details) && $details->target_type == '0') selected @endif>No. Of Leads</option>
                                    <option value="1" @if(isset($details) && $details->target_type == 1) selected @endif>Total Collections</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="target_amount">Target </label>
                                <input type="number" class="form-control" id="target_amount" name="target_amount" placeholder="Enter Target Amount" value="{{ $details->target_amount ?? '' }}"/>
                            </div>

                            <div class="form-group">
                                <label for="target_achieved">Target Achieved</label>
                                <input type="number" class="form-control" id="target_achieved" name="target_achieved" placeholder="Enter Target Achieved" value="{{ $details->target_achieved ?? '' }}"/>
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
        $( "#target_start_date, #target_end_date" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
    });
    </script>
@endpush
