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
                        <form class="forms-sample" method="POST" action="{{ route('home.save.sixth.step') }}" enctype="multipart/form-data" id="myForm">
                            @csrf
                            <div class="form-group">
                                <label for="m_title" class="form-label">Main Title</label>
                                <input type="text" name="m_title" class="form-control" placeholder="Features" value="{{ $edit_details->m_title ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label for="desc" class="form-label">Description</label>
                                <textarea name="s_desc" class="form-control">{{ $edit_details->s_desc ?? '' }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                                @if (is_object($edit_details) && !empty($edit_details->image))
                                    <img src="{{ asset('storage/themes/feature') . '/' . $edit_details->image }}" style="width: 100px;height:100px;">
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Call To Action" value="{{ $edit_details->title ?? '' }}">
                            </div>

                            <style>
                                #editor {
                                    height: 200px;
                                }

                                #preview-box {
                                    background: #f8f9fa;
                                    border: 1px dashed #ccc;
                                    padding: 10px;
                                    white-space: pre-wrap;
                                    font-family: monospace;
                                    margin-top: 20px;
                                }
                            </style>
                            <div class="form-group">
                                <label for="msg">Description</label>
                                <div id="toolbar-container">
                                    <span class="ql-formats">
                                        <select class="ql-font"></select>
                                        <select class="ql-size"></select>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-bold"></button>
                                        <button class="ql-italic"></button>
                                        <button class="ql-underline"></button>
                                        <button class="ql-strike"></button>
                                    </span>
                                    <span class="ql-formats">
                                        <select class="ql-color"></select>
                                        <select class="ql-background"></select>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-script" value="sub"></button>
                                        <button class="ql-script" value="super"></button>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-header" value="1"></button>
                                        <button class="ql-header" value="2"></button>
                                        <button class="ql-blockquote"></button>
                                        <button class="ql-code-block"></button>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-list" value="ordered"></button>
                                        <button class="ql-list" value="bullet"></button>
                                        <button class="ql-indent" value="-1"></button>
                                        <button class="ql-indent" value="+1"></button>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-direction" value="rtl"></button>
                                        <select class="ql-align"></select>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-link"></button>
                                        <button class="ql-image"></button>
                                        <button class="ql-video"></button>
                                        <button class="ql-formula"></button>
                                    </span>
                                    <span class="ql-formats">
                                        <button class="ql-clean"></button>
                                    </span>
                                </div>
                                <div id="editor">{!! $edit_details->desc ?? '' !!}</div>
                                <div id="preview-box" class="mt-3 d-none"></div>
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
                            
                            <input type="hidden" name="desc" id="desc">
                            <input type="hidden" name="theme_id" id="theme_id" value="{{ $selected_theme->id }}">
                            <input type="hidden" name="edit_id" value="{{ $edit_details->id ?? '' }}">
                            <button type="button" class="btn btn-primary mr-2" onclick="form_submit()"> Proceed & Next Step </button>
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
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Description</th>
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
                                            <td>
                                                @if (isset($detail) && $detail->image != '')
                                                    <img src="{{ asset('storage/themes/feature') . '/' . $detail->image }}" alt="" style="width: 100px;height:100px;">
                                                @endif
                                            </td>
                                            <td>{{ $detail->title ?? '' }}</td>
                                            <td>{!! $detail->desc ?? '' !!}</td>
                                            <td>{!! $detail->status == '1'
                                                ? '<button class="btn btn-success btn-sm">Active</button>'
                                                : '<button class="btn btn-danger btn-sm">In Active</button>' !!}</td>
                                            <td>{{ $detail->created_at }}</td>
                                            <td>
                                                <a href="{{ route('home.feature.edit', ['id' => $detail->id]) }}" class="btn btn-dark btn-icon-text">Edit
                                                    <i class="mdi mdi-file-check btn-icon-append"></i>
                                                </a>
                                                <a href="{{ route('home.feature.delete', ['id' => $detail->id]) }}" class="btn btn-danger">Delete
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
        const quill = new Quill('#editor', {
            modules: {
                syntax: true,
                toolbar: '#toolbar-container',
            },
            placeholder: 'Compose an epic...',
            theme: 'snow',
        });

        function form_submit() {
            let html = quill.root.innerHTML.trim();
            document.getElementById('desc').value = html;
            document.getElementById('myForm').submit();
        }

        function preview_message() {
            let html = quill.root.innerHTML.trim();
            let formatted = convertQuillHtmlToWhatsappFormat(html);
            let previewBox = document.getElementById('preview-box');
            previewBox.innerText = formatted;
            previewBox.classList.remove('d-none');
        }
        function addMoreFeature() {
            var adding_data = `
                <div class="remove_div p-2 mt-2 mb-2" style="border:1px solid #CCC;">
                    <span style="float:right;cursor: pointer;" class="text-danger remove-feature">
                            <span class="mdi mdi-close-circle-outline"></span>
                        </span>
                    <div class="form-group">
                        <label for="icon" class="form-label">Icon</label>
                        <input type="text" name="icon[]" class="form-control"  placeholder='<i class="bi bi-arrow-right"></i>'>
                        <a href="https://icons.getbootstrap.com/" class="btn btns-m btn-primary mt-2"
                            target="_blank">More Icon</a>
                    </div>

                    <div class="form-group">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title[]" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label for="s_desc" class="form-label">Short Description</label>
                        <textarea name="s_desc[]" class="form-control"></textarea>
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
