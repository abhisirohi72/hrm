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

                        <h4 class="card-title">Add SOP Details</h4>
                        <form class="forms-sample" method="POST" action="{{ route('save.sop') }}">
                            @csrf
                            <div class="form-group">
                                <label for="full_name">Department</label>
                                <select name="department_id" id="department_id" class="form-control">
                                    <option value="" selected>Please Select</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"
                                            @if (isset($details) && $details->department_id == $department->id) selected @endif>{{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input"  name="timming" value="0" @if (isset($details) && $details->timming=="0")
                                            checked
                                        @endif/> Once 
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input"  name="timming" value="1" @if (isset($details) && $details->timming=="1")
                                            checked
                                        @endif/> Daily 
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input"  name="timming" value="2" @if (isset($details) && $details->timming=="2")
                                            checked
                                        @endif/> Weekly
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input"  name="timming" value="3" @if (isset($details) && $details->timming=="3")
                                            checked
                                        @endif/> Monthly
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input"  name="timming" value="4" @if (isset($details) && $details->timming=="4")
                                            checked
                                        @endif/> Quarterly
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input"  name="timming" value="5" @if (isset($details) && $details->timming=="5")
                                            checked
                                        @endif/> Half Yearly
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input"  name="timming" value="6" @if (isset($details) && $details->timming=="6")
                                            checked
                                        @endif/> Yearly
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="text" class="form-control" id="date" name="date"
                                    placeholder="Enter Date" value="{{ $details->date ?? '' }}" />
                            </div>

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Enter Title" value="{{ $details->title ?? '' }}" />
                            </div>

                            <div class="form-group">
                                <label for="branch_name">SOP</label>
                                <textarea class="form-control" id="sop" name="sop" rows="4"
                                    placeholder="Enter SOP">{{ $details->sop ?? '' }}</textarea>
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
        $( "#date" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
    });
    </script>
@endpush