@extends('layouts.admin.app')

@section('title', $main_title)

@section('content')
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

                        <h4 class="card-title">Add Loan</h4>
                        <form method="POST" action="{{ route('loans.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="department">Employee</label>
                                <select name="employee_id" class="form-control" id="employee_id">
                                    <option value="" selected>Please Select</option>
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}" @if(isset($details) && ($details->employee_id==$employee->id)) selected @endif>{{ $employee->email }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="department">Loan Amount</label>
                                <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter Amount" value="{{ $details->amount ?? '' }}"/>
                            </div>

                            <div class="form-group">
                                <label for="department">Terms (In Months)</label>
                                <input type="number" class="form-control" id="term_months" name="term_months" placeholder="Enter Term Months" value="{{ $details->term_months ?? '' }}"/>
                            </div>

                            <div class="form-group">
                                <label for="int">Interest</label>
                                <input type="number" class="form-control" id="interest" name="interest" placeholder="Enter Interest" value="{{ $details->interest ?? '' }}"/>
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
