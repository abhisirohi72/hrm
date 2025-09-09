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
                        <form class="forms-sample" method="POST" action="{{ route('save.selected.theme') }}">
                            @csrf
                            @foreach ($details as $detail)
                                <div class="form-group">
                                    {{ $detail->name }}
                                    <input type="radio" name="theme" value="{{ $detail->id }}"
                                        @if ($detail->is_selected == 1) checked @endif>
                                    <a href="{{ $detail->url }}" target="_blank" class="btn btn-sm btn-info"
                                        style="float: right;">Preview</a>
                                </div>
                            @endforeach
                            
                            <button type="submit" class="btn btn-primary mr-2"> Submit </button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection