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
                        <h4 class="card-title">Category Details</h4>
                        <a href="{{ route('add.category') }}" class="btn btn-primary btn-icon-text mb-2" style="float: right;">
                            Add
                        </a>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($details) > 0)
                                        @foreach ($details as $item)
                                            <tr>
                                                <td>{{ $item->name ?? '' }}</td>
                                                <td>
                                                    @if($item->type=="0")
                                                        <label class="badge badge-primary">Physical</label>
                                                    @else    
                                                        <label class="badge badge-info">Digital</label>
                                                    @endif    
                                                </td>
                                                <td>
                                                    <a href="{{ route('edit.category', ['id' => $item->id]) }}"
                                                        class="btn btn-dark btn-icon-text">Edit
                                                        <i class="mdi mdi-file-check btn-icon-append"></i>
                                                    </a>
                                                    <a href="{{ route('delete.category', ['id' => $item->id]) }}"
                                                        class="btn btn-danger">Delete
                                                        <i class="mdi mdi-delete btn-icon-append"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3 text-center">
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
