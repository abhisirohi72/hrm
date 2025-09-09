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
                        <h4 class="card-title">Credentials Details</h4>
                        <a href="{{ route('credentials.add') }}" class="btn btn-primary btn-icon-text mb-2" style="float: right;">
                            Add
                        </a>
                        <div class="table-responsive" style="overflow: auto;">
                            <table class="table table-hover" style="overflow: auto;">
                                <thead>
                                    <tr>
                                        <th>URL</th>
                                        <th>User Email</th>
                                        <th>User Password</th>
                                        <th>Developer Email</th>
                                        <th>Developer Password</th>
                                        <th>Admin Email</th>
                                        <th>Admin Password</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($details) > 0)
                                        @foreach ($details as $item)
                                            <tr>
                                                <td>{{ $item->url }}</td>
                                                <td>{{ $item->user_email }}</td>
                                                <td>{{ $item->user_pass }}</td>
                                                <td>{{ $item->admin_email }}</td>
                                                <td>{{ $item->admin_password }}</td>
                                                <td>{{ $item->developer_email }}</td>
                                                <td>{{ $item->developer_password }}</td>
                                                <td>
                                                    <a href="{{ route('credentials.edit', ['id'=>$item->id]) }}" class="btn btn-dark btn-icon-text">Edit
                                                        <i class="mdi mdi-file-check btn-icon-append"></i>
                                                    </a>
                                                    <a href="{{ route('credentials.delete', ['id'=> $item->id]) }}" class="btn btn-danger">Delete
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
