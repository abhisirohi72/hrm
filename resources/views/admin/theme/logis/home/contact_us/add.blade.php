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

                        <h4 class="card-title">Details</h4>
                        <form class="forms-sample" method="POST" action="{{ route('save.theme.contact') }}">
                            @csrf
                            <div class="form-group">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" class="form-control"
                                    value="{{ $edit_details->title ?? '' }}" placeholder="Contact">
                            </div>

                            <div class="form-group">
                                <label for="desc" class="form-label">Description</label>
                                <textarea name="desc" class="form-control">{{ $edit_details->desc ?? '' }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="address" class="form-label">Address</label>
                                <textarea name="address" class="form-control">{{ $edit_details->address ?? '' }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="call_us" class="form-label">Call Us</label>
                                <input type="text" name="call_us" class="form-control"
                                    value="{{ $edit_details->call_us ?? '' }}" placeholder="Contact">
                            </div>

                            <div class="form-group">
                                <label for="email_us" class="form-label">Email us</label>
                                <input type="text" name="email_us" class="form-control" value="{{ $edit_details->email_us ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="" selected>Please Select</option>
                                    <option value="1" @if (is_object($edit_details) && $edit_details->status == '1') selected @endif>
                                        Active</option>
                                    <option value="0" @if (is_object($edit_details) && $edit_details->status == '0') selected @endif>In Active
                                    </option>
                                </select>
                            </div>
                            <input type="hidden" name="theme_id" id="theme_id" value="{{ $selected_theme->id }}">
                            <input type="hidden" name="edit_id" value="{{ $edit_details->id ?? '' }}">
                            <button type="submit" class="btn btn-primary mr-2"> Proceed & Next Step </button>
                            <a href="{{ route('theme.about.team.member') }}" class="btn btn-light">previous</a>
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
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Address</th>
                                    <th>Call Us</th>
                                    <th>Email Us</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($details))
                                    @foreach ($details as $detail)
                                        <tr>
                                            <td>{{ $detail->title ?? '' }}</td>
                                            <td>{{ $detail->desc ?? '' }}</td>
                                            <td>{{ $detail->address ?? '' }}</td>
                                            <td>{{ $detail->call_us ?? '' }}</td>
                                            <td>{{ $detail->email_us ?? '' }}</td>
                                            <td>{!! $detail->status == '1'
                                                ? '<button class="btn btn-success btn-sm">Active</button>'
                                                : '<button class="btn btn-danger btn-sm">In Active</button>' !!}</td>
                                            <td>{{ $detail->created_at }}</td>
                                            <td>
                                                <a href="{{ route('theme.contact.edit', ['id' => $detail->id]) }}" class="btn btn-dark btn-icon-text">Edit
                                                    <i class="mdi mdi-file-check btn-icon-append"></i>
                                                </a>
                                                <a href="{{ route('theme.contact.delete', ['id' => $detail->id]) }}" class="btn btn-danger">Delete
                                                    <i class="mdi mdi-delete btn-icon-append"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
