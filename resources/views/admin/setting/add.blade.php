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

                        <h4 class="card-title">Add Whatsapp Details</h4>
                        <form class="forms-sample" method="POST" action="{{ route('save.whats.app') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="whats_app_token">Whats App Token</label>
                                <input type="text" class="form-control" id="whats_app_token" name="whats_app_token" placeholder="Enter Whats App Token" value="{{ $details->whats_app_token ?? '' }}"/>
                            </div>

                            <div class="form-group">
                                <label for="whats_app_instance">Whats App Instance</label>
                                <input type="text" class="form-control" id="whats_app_instance" name="whats_app_instance" placeholder="Enter Whats App Instance" value="{{ $details->whats_app_instance ?? '' }}"/>
                            </div>

                            <input  type="hidden" name="edit_id" id="edit_id" value="{{ $details->id ?? ''}}">
                            <button type="submit" class="btn btn-primary mr-2"> Submit </button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
