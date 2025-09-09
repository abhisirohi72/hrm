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
                        <h4 class="card-title">Advance Salary</h4>
                        <a href="{{ route('advances.create') }}" class="btn btn-primary btn-icon-text mb-2"
                            style="float: right;">
                            Add Advance Salary
                        </a>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Employee</th>
                                        <th>Month</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($advances) > 0)
                                        @foreach ($advances as $item)
                                            <tr>
                                                <td>{{ $item->employee->email ?? '' }}</td>
                                                <td>{{ $item->month }}</td>
                                                <td>{{ $item->amount }}</td>
                                                <td>{{ $item->status }}</td>
                                                <td>
                                                    @if ($item->status == 'pending')
                                                        <a href="{{ route('advances.approve', $item->id) }}" class="btn btn-success">Approve</a> |
                                                        <a href="{{ route('advances.reject', $item->id) }}" class="btn btn-danger">Reject</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5">
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
