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

                        <h4 class="card-title">Add Branch Details</h4>
                        <form action="{{ route('attendance.checkin') }}" method="POST">
                            @csrf
                            <input type="hidden" name="employee_id" value="{{ $emp_id }}">
                            <button type="submit" class="btn btn-success">Check In</button>
                        </form>

                        <form action="{{ route('attendance.checkout') }}" method="POST" class="mt-2">
                            @csrf
                            <input type="hidden" name="employee_id" value="{{ $emp_id }}">
                            <button type="submit" class="btn btn-warning">Check Out</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
