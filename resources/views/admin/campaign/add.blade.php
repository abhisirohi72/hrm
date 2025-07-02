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

                        <h4 class="card-title">Add Campaign Details</h4>
                        <form class="forms-sample" method="POST" action="{{ route('save.campaign') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="@if(isset($details) && $details->name!="") {{ $details->name }} @endif">
                            </div>

                            <div class="form-group">
                                <label for="type">Type</label>
                                <input type="text" name="type" id="type" class="form-control" value="@if(isset($details) && $details->type!="") {{ $details->type }} @endif">
                            </div>

                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="text" name="start_date" id="start_date" class="form-control" value="@if(isset($details) && $details->start_date!="") {{ $details->start_date }} @endif">
                            </div>

                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="text" name="end_date" id="end_date" class="form-control" value="@if(isset($details) && $details->end_date!="") {{ $details->end_date }} @endif">
                            </div>

                            <div class="form-group">
                                <label for="budget">Budget</label>
                                <input type="text" name="budget" id="budget" class="form-control" value="@if(isset($details) && $details->budget!="") {{ $details->budget }} @endif">
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="">Please Select</option>
                                    <option value="Planned" @if(isset($details) && $details->status=="Planned") selected @endif>Planned</option>
                                    <option value="Active" @if(isset($details) && $details->status=="Active") selected @endif>Active</option>
                                    <option value="Completed" @if(isset($details) && $details->status=="Completed") selected @endif>Completed</option>
                                    <option value="Paused" @if(isset($details) && $details->status=="Paused") selected @endif>Paused</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea name="notes" id="notes" cols="30" rows="10" class="form-control">{{ $details->notes ?? '' }}</textarea>
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
<script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    <script>
    $( function() {
        $( "#start_date, #end_date" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
    });
    </script>
@endpush