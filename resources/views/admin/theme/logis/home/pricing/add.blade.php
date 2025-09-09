@extends('layouts.admin.app')

@section('title', $main_title)

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css" />
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

                        <h4 class="card-title">{{ $title }} Details</h4>
                        <form class="forms-sample" method="POST" action="{{ route('home.save.seventh.step') }}"
                            enctype="multipart/form-data" id="myForm">
                            @csrf
                            <div class="form-group">
                                <label for="m_title" class="form-label">Main Title</label>
                                <input type="text" name="m_title" class="form-control" placeholder="Pricing"
                                    value="{{ $edit_details->m_title ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label for="desc" class="form-label">Description</label>
                                <textarea name="s_desc" class="form-control">{{ $edit_details->s_desc ?? '' }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Plan Name"
                                    value="{{ $edit_details->title ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label for="price" class="form-label">Price Per Month</label>
                                <input type="text" name="price" class="form-control" placeholder="Plan Price"
                                    value="{{ $edit_details->price ?? '' }}">
                            </div>

                            @if (empty($edit_details))
                                <div class="form-group">
                                    <label for="points" class="form-label">Points</label>
                                    <input type="text" name="points[]" class="form-control" placeholder="Plan Points"
                                        value="{{ $edit_details->points ?? '' }}">
                                </div>
                            @else
                                @php
                                    $points = json_decode($edit_details->points, true);
                                @endphp
                                @foreach($points as $key=>$point)
                                    <div class="form-group">
                                        <label for="points" class="form-label">Points {{ $key+1 }}</label>
                                        <input type="text" name="points[]" class="form-control" value="{{ $point ?? '' }}">
                                    </div>
                                @endforeach
                            @endif

                            @if (empty($edit_details))
                                <div class="form-group">
                                    <button type="button" class="btn btn-sm btn-info" onclick="addMoreFeature()">Add
                                        More
                                        Columns</button>
                                </div>

                                <div id="feature-container"></div>
                            @endif

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
                            <button type="cubmit" class="btn btn-primary mr-2"> Proceed & Next Step
                            </button>
                            <a href="{{ route('theme.home.call.to.action') }}" class="btn btn-light">previous</a>
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
                                    <th>Main Title</th>
                                    <th>Short Description</th>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>Points</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($details))
                                    @foreach ($details as $detail)
                                        <tr>
                                            <td>{{ $detail->m_title ?? '' }}</td>
                                            <td>{{ $detail->s_desc ?? '' }}</td>
                                            <td>{{ $detail->title ?? '' }}</td>
                                            <td>{{ $detail->price ?? '' }}</td>
                                            <td>
                                                @php
                                                    $points = json_decode($detail->points, true);
                                                    echo implode('<br><br>', $points);
                                                @endphp
                                            </td>
                                            <td>{!! $detail->status == '1'
                                                ? '<button class="btn btn-success btn-sm">Active</button>'
                                                : '<button class="btn btn-danger btn-sm">In Active</button>' !!}</td>
                                            <td>{{ $detail->created_at }}</td>
                                            <td>
                                                <a href="{{ route('home.pricing.edit', ['id' => $detail->id]) }}"
                                                    class="btn btn-dark btn-icon-text">Edit
                                                    <i class="mdi mdi-file-check btn-icon-append"></i>
                                                </a>
                                                <a href="{{ route('home.pricing.delete', ['id' => $detail->id]) }}"
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
                <div class="remove_div p-2 mt-2 mb-2" style="border:1px solid #CCC;">
                    <span style="float:right;cursor: pointer;" class="text-danger remove-feature">
                            <span class="mdi mdi-close-circle-outline"></span>
                        </span>
                    <div class="form-group">
                        <label for="points" class="form-label">Points</label>
                        <input type="text" name="points[]" class="form-control" placeholder="Plan Points">
                    </div>
                </div>
            `;

            document.getElementById('feature-container').insertAdjacentHTML('beforeend', adding_data);
        }

        // Event delegation for dynamically added elements
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-feature')) {
                e.target.closest('.remove_div').remove();
            }
        });
    </script>
@endpush
