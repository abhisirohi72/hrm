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

                        <h4 class="card-title">Loan List</h4>
                        <a href="{{ route('loans.create') }}" class="btn btn-primary btn-icon-text mb-2" style="float: right;">
                            Create Loan
                        </a>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Employee</th>
                                        <th>Amount</th>
                                        <th>Term</th>
                                        <th>EMI</th>
                                        <th>Status</th>
                                        <th>Interest</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($loans) > 0)
                                        @foreach ($loans as $loan)
                                            <tr>
                                                <td>{{ $loan->id }}</td>
                                                <td>{{ $loan->employee->email }}</td>
                                                <td>{{ $loan->amount }}</td>
                                                <td>{{ $loan->term_months }} months</td>
                                                <td>{{ $loan->monthly_emi }}</td>
                                                <td>{{ $loan->status }}</td>
                                                <td>{{ $loan->interest ?? '0' }}%</td>
                                                <td>
                                                    <a href="{{ route('edit.loan', ['id'=>$loan->id]) }}" class="btn btn-dark btn-icon-text">Edit
                                                        <i class="mdi mdi-file-check btn-icon-append"></i>
                                                    </a>
                                                    <a href="{{ route('delete.loan', ['id'=>$loan->id]) }}" class="btn btn-danger">Delete
                                                        <i class="mdi mdi-delete btn-icon-append"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7">
                                                <p>No Records Found..</p>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
