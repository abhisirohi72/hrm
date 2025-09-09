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

                        <h4 class="card-title">{{ $title }} Details</h4>
                        <form id="myForm" method="POST" action="{{ route('save.whats_app.document') }}">
                            @csrf
                            <div class="form-group">
                                <label for="to">To</label>
                                <input type="text" name="to" id="to" class="form-control"
                                    value="@if (isset($details) && $details->to != '') {{ $details->to }} @endif">
                            </div>

                            <div class="form-group">
                                <label for="filename">Filename</label>
                                <input type="text" name="filename" id="filename" class="form-control" value="@if (isset($details) && $details->filename != '') {{ $details->filename }} @endif" placeholder="File name, for example 1.jpg or Hello.pdf filename Max length : 255 char .">
                            </div>

                            <div class="form-group">
                                <label for="document">Document</label>
                                <input type="text" name="document" id="document" class="form-control"   value="@if (isset($details) && $details->document != '') {{ $details->document }} @endif" placeholder="HTTP link image or base64-encoded file, Supported most extensions like ( zip , xlsx , csv , txt , pptx , docx ....etc ) .">
                            </div>

                            <div class="form-group">
                                <label for="msg">Captions</label>
                                <input type="text" name="msg" id="msg" class="form-control" value="@if (isset($details) && $details->msg != '') {{ $details->msg }} @endif" placeholder="The text under the file . Data type : text, UTF-8 or UTF-16 string with emoji .">
                            </div>
                            <button type="submit" class="btn btn-primary mr-2"> Submit </button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection