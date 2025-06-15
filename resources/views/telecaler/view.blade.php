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
                        <h4 class="card-title">Telecaler Feedback Details</h4>
                        <a href="{{ route('add.t_feedback') }}" class="btn btn-primary btn-icon-text mb-2" style="float: right;">
                            Add
                        </a>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Cust. Name</th>
                                        <th>Contact Num.</th>
                                        <th>Call Purpose</th>
                                        <th>Interested</th>
                                        <th>Feedback Notes</th>
                                        <th>Next Follow Up</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($details) > 0)
                                        @foreach ($details as $item)
                                            <tr>
                                                <td>{{ $item->customer_name ?? '' }}</td>
                                                <td>{{ $item->contact_number ?? '' }}</td>
                                                <td>
                                                    @if($item->call_purpose=="0")
                                                        <label class="badge badge-success">Inquiry</label>
                                                    @elseif($item->call_purpose=="1")
                                                        <label class="badge badge-primary">Follow Up</label>
                                                    @elseif($item->call_purpose=="2")
                                                        <label class="badge  badge-warning">Promotion</label>
                                                    @else
                                                           <label class="badge badge-danger">Complaint</label>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($item->insterested=="0")
                                                        <label class="badge badge-danger">No</label>
                                                    @else
                                                           <label class="badge badge-success">Yes</label>
                                                    @endif
                                                </td>
                                                <td>{{ $item->feedback_notes ?? '' }}</td>
                                                <td>{{ $item->next_followup ?? '' }}</td>
                                                <td>
                                                    <a href="{{ route('edit.t_feedback', ['id'=>$item->id]) }}" class="btn btn-dark btn-icon-text">Edit
                                                        <i class="mdi mdi-file-check btn-icon-append"></i>
                                                    </a>
                                                    <a href="{{ route('delete.t_feedback', ['id'=>$item->id]) }}" class="btn btn-danger">Delete
                                                        <i class="mdi mdi-delete btn-icon-append"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="2">
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
