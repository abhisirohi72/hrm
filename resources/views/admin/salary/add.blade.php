@extends('layouts.admin.app')

@section('title', $main_title)

@section('content')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
  {{-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> --}}
  
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

                        <h4 class="card-title">Add Salary Details</h4>
                        <form class="forms-sample" method="POST" action="{{ route('save.salary') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="full_name">Account Holder Name</label>
                                <input type="text" class="form-control" id="account_holder_name" name="account_holder_name" placeholder="Enter Account Holder Name" value="{{ $details->account_holder_name ?? '' }}"/>
                            </div>

                            <div class="form-group">
                                <label for="bank_name">Bank Name</label>
                                <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Enter Bank Name" value="{{ $details->bank_name ?? '' }}"/>
                            </div>

                            <div class="form-group">
                                <label for="account_number">Account Number</label>
                                <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Enter Account Number" value="{{ $details->account_number ?? '' }}"/>
                            </div>

                            <div class="form-group">
                                <label for="dob">Account Type</label>
                                <select name="account_type" id="account_type" class="form-control">
                                    <option value="" selected>Please Select</option>
                                    <option value="savings" @if(isset($details) && $details->account_type == "savings") selected @endif>Savings</option>
                                    <option value="current" @if(isset($details) && $details->account_type == "current") selected @endif>Current</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="ifsc_code">Bank IFSC Code</label>
                                <input type="text" class="form-control" id="ifsc_code" name="ifsc_code" placeholder="Enter IFSC Code    " value="{{ $details->ifsc_code ?? '' }}"/>
                            </div>

                            <div class="form-group">
                                <label for="branch_name">Bank Branch Name</label>
                                <input type="text" class="form-control" id="branch_name" name="branch_name" placeholder="Enter Bank Branch Name" value="{{ $details->branch_name ?? '' }}"/>
                            </div>

                            <div class="form-group">
                                <label for="branch_address">Bank Branch Address</label>
                                <input type="text" class="form-control" id="branch_address" name="branch_address" placeholder="Enter Bank Branch Name" value="{{ $details->branch_address ?? '' }}"/>
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
