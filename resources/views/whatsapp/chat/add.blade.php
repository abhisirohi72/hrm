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
                        <form id="myForm" method="POST" action="{{ route('save.whats_app.chat') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">To</label>
                                <input type="text" name="to" id="to" class="form-control"
                                    value="@if (isset($details) && $details->to != '') {{ $details->to }} @endif">
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
                                <label for="msg">Message</label>
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
                                {{-- <textarea id="editor" name="msg" style="width:100%;height:200px; "></textarea> --}}
                                <div id="editor"></div>
                                <div id="preview-box" class="mt-3 d-none"></div>
                            </div>
                            <input type="hidden" name="msg" id="msg">
                            <input type="hidden" name="main_msg" id="main_msg">
                            <input type="hidden" name="edit_id" id="edit_id" value="{{ $details->id ?? '' }}">
                            <button type="button" class="btn btn-primary mr-2" onclick="form_submit()"> Submit </button>
                            <button type="button" onclick="preview_message()" class="btn btn-info ml-2">Preview</button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <!-- Initialize Quill editor -->
    <script>
        const quill = new Quill('#editor', {
            modules: {
                syntax: true,
                toolbar: '#toolbar-container',
            },
            placeholder: 'Compose an epic...',
            theme: 'snow',
        });

        function convertQuillHtmlToWhatsappFormat(html) {
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = html;

            tempDiv.querySelectorAll('strong, b').forEach(el => el.outerHTML = `*${el.textContent}*`);
            tempDiv.querySelectorAll('em, i').forEach(el => el.outerHTML = `_${el.textContent}_`);
            tempDiv.querySelectorAll('u').forEach(el => el.outerHTML = `__${el.textContent}__`);
            tempDiv.querySelectorAll('s, del').forEach(el => el.outerHTML = `~${el.textContent}~`);
            tempDiv.querySelectorAll('code').forEach(el => el.outerHTML = `\`${el.textContent}\``);
            tempDiv.querySelectorAll('pre').forEach(el => el.outerHTML = `\`\`\`\n${el.textContent}\n\`\`\``);
            tempDiv.querySelectorAll('blockquote').forEach(el => el.outerHTML = `> ${el.textContent}\n`);
            tempDiv.querySelectorAll('li').forEach(el => {
                const parent = el.closest('ol');
                const isOrdered = parent !== null;
                el.outerHTML = isOrdered ?
                    `1. ${el.textContent}\n` :
                    `* ${el.textContent}\n`;
            });
            tempDiv.querySelectorAll('a').forEach(el => {
                const text = el.textContent;
                const href = el.getAttribute('href');
                el.outerHTML = `${text} (${href})`;
            });
            tempDiv.querySelectorAll('br').forEach(el => el.outerHTML = '\n');
            tempDiv.querySelectorAll('p').forEach(el => el.outerHTML = `${el.textContent}\n`);

            return tempDiv.textContent || tempDiv.innerText || '';
        }



        function form_submit() {
            let html = quill.root.innerHTML.trim();
            let formatted = convertQuillHtmlToWhatsappFormat(html);

            if (formatted === '' || formatted === '<p><br></p>') {
                alert("Please enter a message.");
                return false;
            }

            document.getElementById('msg').value = formatted;
            document.getElementById('main_msg').value = html;
            document.getElementById('myForm').submit();
        }

        function preview_message() {
            let html = quill.root.innerHTML.trim();
            let formatted = convertQuillHtmlToWhatsappFormat(html);
            let previewBox = document.getElementById('preview-box');
            previewBox.innerText = formatted;
            previewBox.classList.remove('d-none');
        }
    </script>
@endpush
