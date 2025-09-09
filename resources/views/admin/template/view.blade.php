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
                        <h4 class="card-title">Template Details</h4>
                        <a href="{{ route('add.template') }}" class="btn btn-primary btn-icon-text mb-2" style="float:right;">
                            Add
                        </a>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Template</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($details) > 0)
                                        @foreach ($details as $detail)
                                            <tr>
                                                <td>{{ $detail->title }}</td>
                                                <td>{!! $detail->template !!}</td><td>
                                                    @if($detail->status=="0")
                                                        <p class="text-danger">In Active</p>
                                                    @else
                                                        <p class="text-success">Active</p>
                                                    @endif    
                                                </td>
                                                <td>
                                                    <a href="{{ route('edit.template', ['id' => $detail->id]) }}" class="btn btn-dark btn-icon-text">Edit<i class="mdi mdi-file-check btn-icon-append"></i>
                                                    </a>
                                                    <a href="{{ route('delete.template', ['id' => $detail->id]) }}" class="btn btn-danger">Delete <i class="mdi mdi-delete btn-icon-append"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4 text-center">
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
