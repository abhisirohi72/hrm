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

                        <h4 class="card-title">Add Branch Details</h4>
                        <form class="forms-sample" method="POST" action="{{ route('save.branch') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="department">Department Name</label>
                                <select class="form-control" id="dept_name" name="dept_name">
                                    <option value="">Please Select</option>
                                    @foreach($details as $detail)
                                        <option value="{{ $detail->id ?? ''  }}" @if(isset($b_details->departments) &&$b_details->departments->id==$detail->id) selected  @endif>{{ $detail->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputUsername1">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Branch Name" value="{{ $b_details->name ?? '' }}"/>
                            </div>

                            <div class="form-group">
                                <label for="">Address</label>
                                <textarea class="form-control" id="address" name="address" placeholder="Enter your address">{{ $b_details->address ?? ''}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="">Status</label>
                                <select name="status" class="form-control" id="status">
                                    <option value="">Please Select</option>
                                    <option value="1" @if(isset($b_details) && $b_details->status=='1') selected @endif>Active</option>
                                    <option value="0" @if(isset($b_details) && $b_details->status=='0') selected @endif>In Active</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Company Logo</label>
                                <input type="file" class="form-control" id="c_logo" name="c_logo">
                                @if(isset($b_details->c_logo) && $b_details->c_logo!="")
                                    <img src="{{ asset('storage/company').'/'.$b_details->c_logo }}" alt="" style="width: 100px; height:100px;">
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="">Company Website</label>
                                <input type="text" class="form-control" id="c_website" name="c_website" placeholder="Enter your Company Website" value="{{ $b_details->c_website ?? ''}}">
                            </div>

                            <div class="form-group">
                                <label for="">Company Email</label>
                                <input type="text" class="form-control" id="c_email" name="c_email" placeholder="Enter your Company email" value="{{ $b_details->c_email ?? ''}}">
                            </div>

                            <input type="hidden" name="edit_id" id="edit_id" value="{{ $edit_id ?? ''}}">
                            <input type="hidden" name="old_c_logo" id="old_c_logo" value="{{ $b_details->c_logo ?? ''}}">
                            <button type="submit" class="btn btn-primary mr-2"> Submit </button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
