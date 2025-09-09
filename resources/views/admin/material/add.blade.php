@extends('layouts.admin.app')

@section('title', $main_title)

@section('content')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> --}}

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

                        <h4 class="card-title">Add Material Details</h4>
                        <form class="forms-sample" method="POST" action="{{ route('save.material') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*" />
                            </div>
                            @if (isset($details))
                                <img src="{{ asset('storage/materials') . '/' . $details->image }}" alt=""
                                    style="width:100px;height:100px;" class="mb-2">
                            @endif

                            <div class="form-group">
                                <label for="pdf">PDF</label>
                                <input type="file" class="form-control" id="pdf" name="pdf"
                                    accept="application/pdf" />
                            </div>
                            @if (isset($details))
                                <a href="{{ asset('storage/materials') . '/' . $details->pdf }}" class="btn btn-primary"
                                    target="_blank">Download</a>
                            @endif

                            <div class="form-group">
                                <label for="video">Video</label>
                                <input type="file" class="form-control" id="video" name="" accept="video/*" />
                            </div>
                            @if (isset($details))
                                <video width="640" height="360" controls>
                                    <source src="{{ asset('storage/materials') . '/' . $details->video }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <br>
                            @endif

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
