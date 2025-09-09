@extends('layouts.admin.app')

@section('title', $main_title)

@section('content')
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/45.2.1/ckeditor5.css">

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

                        <h4 class="card-title">Details</h4>
                        <form class="forms-sample" method="POST" action="{{ route('save.theme') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Add Theme Name" value="{{ $edit_details->name ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                                @if ($edit_details && $edit_details->image != '')
                                    <img src="{{ asset('storage/themes/') . '/' . $edit_details->image }}" alt=""
                                        style="width: 100px;height:100px;">
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="url" class="form-label">Url</label>
                                <textarea name="url" id="url" class="form-control" placeholder="Add Theme Name">{{ $edit_details->url ?? '' }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="" selected>Please Select</option>
                                    <option value="1" @if ($edit_details && $edit_details->status == '1') selected @endif>
                                        Active</option>
                                    <option value="0" @if ($edit_details && $edit_details->status == '0') selected @endif>In
                                        Active</option>
                                </select>
                            </div>
                            <input type="hidden" name="edit_id" value="{{ $edit_details->id ?? '' }}">
                            <input type="hidden" name="edit_image" value="{{ $edit_details->image ?? '' }}">
                            <button type="submit" class="btn btn-primary mr-2"> Submit </button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body" style="overflow: auto;">
                        <h4 class="card-title">Details</h4>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>URL</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Is Deleted</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($details as $detail)
                                    <tr>
                                        <td>{{ $detail->name }}</td>
                                        <td>
                                            @if (isset($detail) && $detail->image != '')
                                                <img src="{{ asset('storage/themes') . '/' . $detail->image }}"
                                                    alt="" style="width: 100px;height:100px;">
                                            @endif
                                        </td>
                                        <td>{{ $detail->url }}</td>
                                        <td>{!! $detail->status == '1'
                                            ? '<button class="btn btn-success btn-sm">Active</button>'
                                            : '<button class="btn btn-danger btn-sm">In Active</button>' !!}</td>
                                        <td>{{ $detail->created_at }}</td>
                                        <td>{!! $detail->is_deleted == '1'
                                            ? '<button class="btn btn-danger btn-sm">Deleted</button>'
                                            : '<button class="btn btn-success btn-sm">Not Deleted</button>' !!}</td>
                                        <td>
                                            <a href="{{ route('edit.theme', ['id' => $detail->id]) }}"
                                                class="btn btn-dark btn-icon-text">Edit
                                                <i class="mdi mdi-file-check btn-icon-append"></i>
                                            </a>
                                            <a href="{{ route('delete.theme', ['id' => $detail->id]) }}"
                                                class="btn btn-danger">Delete
                                                <i class="mdi mdi-delete btn-icon-append"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
