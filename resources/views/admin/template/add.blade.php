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

                        <h4 class="card-title">{{ $title }} Details</h4>
                        <form class="forms-sample" method="POST" action="{{ route('save.template') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" id="title" required value="{{ $details->title ?? '' }}">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Template</label>
                                <textarea name="template" id="editor" cols="30" rows="30">{!! $details->template ?? '' !!}</textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="" selected>Please Select</option>
                                    <option value="1" @if(isset($details) && $details->status=="1") selected @endif>Active</option>
                                    <option value="0" @if(isset($details) && $details->status=="0") selected @endif>In Active</option>
                                </select>
                            </div>

                            <input type="hidden" name="edit_id" id="edit_id" value="{{ $details->id ?? '' }}">
                            <button type="submit" class="btn btn-primary mr-2"> Submit </button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
<script src="https://cdn.ckeditor.com/ckeditor5/45.2.1/ckeditor5.umd.js"></script>
		<script>
			const {
				ClassicEditor,
				Essentials,
				Paragraph,
				Bold,
				Italic,
				Font
			} = CKEDITOR;
			// Create a free account and get <YOUR_LICENSE_KEY>
			// https://portal.ckeditor.com/checkout?plan=free
			ClassicEditor
				.create( document.querySelector( '#editor' ), {
					licenseKey: 'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3NTI4ODMxOTksImp0aSI6ImFiNGMwZTJlLTUxN2MtNDljMi1iYzZlLTUxN2U5ZTE0NWQyYyIsInVzYWdlRW5kcG9pbnQiOiJodHRwczovL3Byb3h5LWV2ZW50LmNrZWRpdG9yLmNvbSIsImRpc3RyaWJ1dGlvbkNoYW5uZWwiOlsiY2xvdWQiLCJkcnVwYWwiLCJzaCJdLCJ3aGl0ZUxhYmVsIjp0cnVlLCJsaWNlbnNlVHlwZSI6InRyaWFsIiwiZmVhdHVyZXMiOlsiKiJdLCJ2YyI6ImJjZTBmODRhIn0.IlPW41fmLzm2Xc0XWkiRFcw9dyjQFETc_Jm9AO2PRnerRnxxhv23BQ-UP_uEO6d0seItXRtSUWw8SJC9LY_Uwg',
					plugins: [ Essentials, Paragraph, Bold, Italic, Font ],
					toolbar: [
						'undo', 'redo', '|', 'bold', 'italic', '|',
						'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
					]
				} )
				.then( editor => {
					window.editor = editor;
				} )
				.catch( error => {
					console.error( error );
				} );
		</script>    
@endpush
