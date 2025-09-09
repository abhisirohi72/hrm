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

                        <h4 class="card-title">Add Credentials Details</h4>
                        <form class="forms-sample" method="POST" action="{{ route('save.credentials') }}">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">URL</label>
                                <textarea class="form-control" id="url" name="url">{{ $details->url ?? '' }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="user_email">User Email @if(request()->segment(2)=="edit") (<a href="{{ $details->url ?? '' }}">View</a>) @endif</label>
                                <input type="text" class="form-control" id="user_email" name="user_email" value="{{ $details->user_email ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label for="user_pass">User Password</label>
                                <input type="text" class="form-control" id="user_pass" name="user_pass" value="{{ $details->user_pass ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label for="admin_email">Admin Email @if(request()->segment(2)=="edit") (<a href="{{ $details->url ?? '' }}">View</a>) @endif</label>
                                <input type="text" class="form-control" id="admin_email" name="admin_email" value="{{ $details->admin_email ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label for="admin_password">Admin Password</label>
                                <input type="text" class="form-control" id="admin_password" name="admin_password" value="{{ $details->admin_password ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label for="developer_email">Developer Email @if(request()->segment(2)=="edit") (<a href="{{ $details->url ?? '' }}">View</a>) @endif</label>
                                <input type="text" class="form-control" id="developer_email" name="developer_email" value="{{ $details->developer_email ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label for="developer_password">Developer Password</label>
                                <input type="text" class="form-control" id="developer_password" name="developer_password" value="{{ $details->developer_password ?? '' }}">
                            </div>

                            <input type="hidden" name="edit_id" id="edit_id" value="{{ $details->id ?? ''}}">
                            <button type="submit" class="btn btn-primary mr-2"> Submit </button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
