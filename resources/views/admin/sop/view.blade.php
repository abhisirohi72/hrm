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
                        <h4 class="card-title">SOP Details</h4>
                        <a href="{{ route('add.sop') }}" class="btn btn-primary btn-icon-text mb-2" style="float: right;">
                            Add
                        </a>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Timming</th>
                                        <th>Department</th>
                                        <th>Date</th>
                                        <th>Title</th>
                                        <th>SOP</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($details) > 0)
                                        @foreach ($details as $detail)
                                            <tr>
                                                <td>
                                                    @if($detail->timming=="0")
                                                        Once
                                                    @elseif($detail->timming=="1")
                                                        Daily
                                                    @elseif($detail->timming=="2")
                                                        Weekly
                                                    @elseif($detail->timming=="3")
                                                        Monthly
                                                    @elseif($detail->timming=="4")
                                                        Quarterly
                                                    @elseif($detail->timming=="5")
                                                        Half-Yearly
                                                    @else
                                                        Yearly
                                                    @endif       
                                                </td>
                                                <td>{{ $detail->departments->name ?? '' }}</td>
                                                <td>{{ $detail->date ?? '' }}</td>
                                                <td>{{ $detail->title ?? '' }}</td>
                                                <td>{{ $detail->sop ?? '' }}</td>
                                                <td>
                                                    <a href="{{ route('edit.sop', ['id' => $detail->id]) }}"
                                                        class="btn btn-dark btn-icon-text">Edit
                                                        <i class="mdi mdi-file-check btn-icon-append"></i>
                                                    </a>
                                                    <a href="{{ route('delete.sop', ['id' => $detail->id]) }}"
                                                        class="btn btn-danger">Delete
                                                        <i class="mdi mdi-delete btn-icon-append"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8 text-center">
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
