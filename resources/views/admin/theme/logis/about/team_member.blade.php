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
                        <form class="forms-sample" method="POST" action="{{ route('save.theme.team.member') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" class="form-control"
                                    value="{{ $edit_details->title ?? '' }}" placeholder="Our Teams">
                            </div>

                            <div class="form-group">
                                <label for="desc" class="form-label">Description</label>
                                <textarea name="desc" class="form-control">{{ $edit_details->desc ?? '' }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="image" class="form-label">Image Upload</label>
                                <input type="file" name="image" class="form-control">
                                @if($edit_details)
                                <img src="{{ asset('storage/themes/teams').'/'.$edit_details->image }}" alt="" style="width:100px; height:100px;">
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $edit_details->name ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label for="designation" class="form-label">Designation</label>
                                <input type="text" name="designation" class="form-control" value="{{ $edit_details->designation ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label for="s_desc" class="form-label">Short Description</label>
                                <textarea name="s_desc" class="form-control">{{ $edit_details->s_desc ?? '' }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="t_url" class="form-label">Twitter X Url</label>
                                <textarea name="t_url" class="form-control">{{ $edit_details->t_url ?? '' }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="fb_url" class="form-label">Facebook Url</label>
                                <textarea name="fb_url" class="form-control">{{ $edit_details->fb_url ?? '' }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="insta_url" class="form-label">Instagram Url</label>
                                <textarea name="insta_url" class="form-control">{{ $edit_details->insta_url ?? '' }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="linkedin_url" class="form-label">LinkedIn Url</label>
                                <textarea name="linkedin_url" class="form-control">{{ $edit_details->linkedin_url ?? '' }}</textarea>
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
                            <a href="{{ route('theme.home.custom.data') }}" class="btn btn-light">previous</a>
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
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Short Description</th>
                                    <th>Twitter URL</th>
                                    <th>Facebook URL</th>
                                    <th>Instagram URL</th>
                                    <th>Linkedin URL</th>
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
                                            <td>
                                                <img src="{{ asset('storage/themes/teams').'/'.$detail->image }}" alt="" style="width:100px; height:100px;">
                                            </td>
                                            <td>{{ $detail->name ?? '' }}</td>
                                            <td>{{ $detail->designation ?? '' }}</td>
                                            <td>{{ $detail->s_desc ?? '' }}</td>
                                            <td>{{ $detail->t_url ?? '' }}</td>
                                            <td>{{ $detail->fb_url ?? '' }}</td>
                                            <td>{{ $detail->insta_url ?? '' }}</td>
                                            <td>{{ $detail->linkedin_url ?? '' }}</td>
                                            <td>{!! $detail->status == '1'
                                                ? '<button class="btn btn-success btn-sm">Active</button>'
                                                : '<button class="btn btn-danger btn-sm">In Active</button>' !!}</td>
                                            <td>{{ $detail->created_at }}</td>
                                            <td>
                                                <a href="{{ route('theme.about.team.member.edit', ['id' => $detail->id]) }}"
                                                    class="btn btn-dark btn-icon-text">Edit
                                                    <i class="mdi mdi-file-check btn-icon-append"></i>
                                                </a>
                                                <a href="{{ route('theme.about.team.member.delete', ['id' => $detail->id]) }}"
                                                    class="btn btn-danger">Delete
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
