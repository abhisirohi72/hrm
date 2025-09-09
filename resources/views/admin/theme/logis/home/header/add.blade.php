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
                        <form class="forms-sample" method="POST" action="{{ route('home.save.first.step') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="bg_img" class="form-label">Background Image</label>
                                <input type="file" name="bg_img" id="bg_img" class="form-control">
                                @if (is_object($edit_details) && !empty($edit_details->bg_img))
                                    <img src="{{ asset('storage/themes/home/header') . '/' . $edit_details->bg_img }}"
                                        style="width: 100px;height:100px;">
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    value="{{ $edit_details->title ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label for="desc" class="form-label">Description</label>
                                <textarea name="desc" id="desc" class="form-control">{{ $edit_details->desc ?? '' }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="adding_columns" class="form-label">Adding Columns</label>
                                <div class="row">
                                    @if ($edit_details)
                                        @php
                                            $col_names = json_decode($edit_details->custom_col_name, true);
                                            $col_values = json_decode($edit_details->custom_col_value, true);
                                        @endphp

                                        @foreach ($col_names as $key => $col_name)
                                            <div class="col-md-6 mt-2">
                                                <input type="text" name="col_name[]" class="form-control"
                                                    value="{{ $col_name }}">
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <input type="text" name="col_value[]" class="form-control"
                                                    value="{{ $col_values[$key] }}">
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-md-4">
                                            <input type="text" name="col_name[]" class="form-control"
                                                placeholder="Enter Title">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" name="col_value[]" class="form-control"
                                                placeholder="Enter Title Value">
                                        </div>
                                    @endif
                                    <div class="col-md-4 mt-2">
                                        {{-- @if (empty($edit_details)) --}}
                                        <div class="col-12">
                                            <button type="button" class="btn btn-sm btn-info"
                                                onclick="addMoreFeature()">Add More
                                                Columns</button>
                                        </div>
                                        {{-- @endif --}}
                                    </div>
                                </div>
                            </div>
                            <div id="feature-container"></div>

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
                            <input type="hidden" name="edit_image" value="{{ $edit_details->image ?? '' }}">
                            <button type="submit" class="btn btn-primary mr-2"> Proceed & Next Step </button>
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
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Column Name</th>
                                    <th>Column Value</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($details))
                                    @foreach ($details as $detail)
                                        <tr>
                                            <td>
                                                @if (isset($detail) && $detail->image != '')
                                                    <img src="{{ asset('storage/themes/home/header') . '/' . $detail->bg_img }}"
                                                        style="width: 100px;height:100px;">
                                                @endif
                                            </td>
                                            <td>{{ $detail->title ?? '' }}</td>
                                            <td>{{ $detail->desc ?? '' }}</td>
                                            <td>
                                                @if ($detail)
                                                    @php
                                                        $col_names = json_decode($detail->custom_col_name, true);
                                                        echo implode(', ', $col_names);
                                                    @endphp
                                                @endif
                                            </td>
                                            <td>
                                                @if ($detail)
                                                    @php
                                                        $col_values = json_decode($detail->custom_col_value,true);
                                                        echo implode(', ', $col_values);
                                                    @endphp
                                                @endif
                                            </td>
                                            <td>{!! $detail->status == '1'
                                                ? '<button class="btn btn-success btn-sm">Active</button>'
                                                : '<button class="btn btn-danger btn-sm">In Active</button>' !!}</td>
                                            <td>{{ $detail->created_at }}</td>
                                            <td>
                                                <a href="{{ route('home.header.edit', ['id' => $detail->id]) }}"
                                                    class="btn btn-dark btn-icon-text">Edit
                                                    <i class="mdi mdi-file-check btn-icon-append"></i>
                                                </a>
                                                <a href="{{ route('home.header.delete', ['id' => $detail->id]) }}"
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
@push('script')
    <script>
        function addMoreFeature() {
            var adding_data = `
                <div class="feature-item row border rounded p-2 mb-2">
                    <div class="col-md-5">
                        <input type="text" name="col_name[]" class="form-control" placeholder="Enter Title">
                    </div>
                    <div class="col-md-5">
                        <input type="text" name="col_value[]" class="form-control" placeholder="Enter Title Value">
                    </div>
                    <div class="col-md-2">
                        <span style="float:left;cursor: pointer;" class="text-danger remove-feature">
                            <span class="mdi mdi-close-circle-outline"></span>
                        </span>
                    </div>
                </div>
            `;

            document.getElementById('feature-container').insertAdjacentHTML('beforeend', adding_data);
        }

        // Event delegation for dynamically added elements
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-feature')) {
                e.target.closest('.feature-item').remove();
            }
        });
    </script>
@endpush
