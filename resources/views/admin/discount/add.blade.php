@extends('layouts.admin.app')

@section('title', $main_title)

@section('content')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
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

                        <h4 class="card-title">Add Discount Details</h4>
                        <form class="forms-sample" method="POST" action="{{ route('save.discount') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Discount Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Discount Name" value="{{ $details->name ?? '' }}" />
                            </div>

                            <div class="form-group">
                                <label for="name">Description</label>
                                <textarea class="form-control" id="description" name="description"
                                    placeholder="Enter Description">{{ $details->description ?? '' }}</textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="name">Discount Type</label>
                                <select name="discount_type" id="discount_type" class="form-control">
                                    <option value="" selected>Please Select</option>
                                    <option value="percentage" @if (isset($details) && $details->discount_type == 'percentage') selected @endif>Percentage</option>
                                    <option value="fixed" @if (isset($details) && $details->discount_type == 'fixed') selected @endif>Fixed Amount</option> 
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="discount_value">Discount Value</label>
                                <input type="number" class="form-control" id="discount_value" name="discount_value" placeholder="Enter Discount Value" value="{{ $details->discount_value ?? '' }}" />
                            </div>

                            <div class="form-group">
                                <label for="description">Start Date</label>
                                <input type="text" class="form-control" id="start_date" name="start_date" placeholder="Enter Start Date" value="{{ $details->start_date ?? '' }}" />
                            </div>

                            <div class="form-group">
                                <label for="price">End Date</label>
                                <input type="text" class="form-control" id="end_date" name="end_date"
                                    placeholder="Enter End Date" value="{{ $details->end_date ?? '' }}" />
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="" selected>Please Select</option>
                                    <option value="active" @if (isset($details) && $details->status == 'active') selected @endif>Active</option>
                                    <option value="inactive" @if (isset($details) && $details->status == 'inactive') selected @endif>Inactive</option>
                                </select>
                            </div>

                            <input type="hidden" name="edit_id" id="edit_id" value="{{ $details->id ?? '' }}">
                            <input type="hidden" name="old_image" id="old_image" value="{{ $details->image ?? '' }}">
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
