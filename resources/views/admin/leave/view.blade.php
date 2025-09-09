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
                    <div class="card-body" style="overflow: auto;">
                        <h4 class="card-title">Leads Details</h4>
                        <a href="{{ route('add.leaves') }}" class="btn btn-primary btn-icon-text mb-2" style="float: right;">
                            Add
                        </a>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Leave Type</th>
                                        <th>Reason</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @if (count($details) > 0)
                                            @foreach ($details as $detail)
                                            <tr>
                                                <td>{{ $detail->start_date ?? '' }}</td>
                                                <td>{{ $detail->end_date ?? '' }}</td>
                                                <td>{{ $detail->leave_type ?? '' }}</td>
                                                <td>{{ $detail->reason ?? '' }}</td>
                                                <td>{{ $detail->status ?? '' }}</td>
                                                <td>
                                                    <a href="{{ route('edit.leaves', ['id' => $detail->id]) }}"
                                                        class="btn btn-dark btn-icon-text">Edit
                                                        <i class="mdi mdi-file-check btn-icon-append"></i>
                                                    </a>
                                                    <a href="{{ route('delete.leaves', ['id' => $detail->id]) }}"
                                                        class="btn btn-danger">Delete
                                                        <i class="mdi mdi-delete btn-icon-append"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6 text-center">
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
