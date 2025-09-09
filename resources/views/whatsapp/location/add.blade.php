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
                        <form id="myForm" method="POST" action="{{ route('save.whats_app.location') }}">
                            @csrf
                            <div class="form-group">
                                <label for="to">To</label>
                                <input type="text" name="to" id="to" class="form-control"
                                    value="@if (isset($details) && $details->to != '') {{ $details->to }} @endif">
                            </div>

                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" class="form-control"
                                    placeholder="Text under the location. Supports two lines. To use two lines, use the \n symbol. Max length : 300 char">
                            </div>

                            <div class="form-group">
                                <label for="lat">Latitude</label>
                                <input type="text" name="lat" id="lat" class="form-control"
                                    placeholder="Latitude Example : 25.197197">
                            </div>

                            <div class="form-group">
                                <label for="lng">Longitude</label>
                                <input type="text" name="lng" id="lng" class="form-control" placeholder="Longitude Example : 25.197197">
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
