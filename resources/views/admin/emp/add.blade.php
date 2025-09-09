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

                        <h4 class="card-title">Add Employee Details</h4>
                        <form class="forms-sample" method="POST" action="{{ route('save.emp') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="emp_id">Employee ID</label>
                                <input type="text" class="form-control" id="emp_id" name="emp_id" placeholder="Enter Employee ID" value="{{ $details->emp_id ?? '' }}"/>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control" id="image" name="image" />
                            </div>
                            @if(isset($details))
                                <img src="{{ asset('storage/users').'/'.$details->image }}" alt="" style="width:100px;height:100px;" class="mb-2">
                            @endif

                            <div class="form-group">
                                <label for="full_name">Full Name</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter Full Name" value="{{ $details->full_name ?? '' }}"/>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Full Name" value="{{ $details->email ?? '' }}"/>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" />
                            </div>

                            <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Full Name" value="{{ $details->mobile ?? '' }}"/>
                            </div>

                            <div class="form-group">
                                <label for="dob">Date Of Birth</label>
                                <input type="text" class="form-control" id="dob" name="dob" placeholder="Enter Full Name" value="{{ $details->dob ?? '' }}"/>
                            </div>

                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control" id="address" name="address" placeholder="Enter Address">{{ $details->address ?? '' }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="dept_id">Department</label>
                                <select name="dept_id" id="dept_id" onchange="departmentData(this.value)" class="form-control">
                                    <option value="" selected>Please Select</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}" @if(isset($details) && $details->dept_id == $department->id) selected @endif>{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="branch_id">Branch</label>
                                <select name="branch_id" id="branch_id" class="form-control">
                                    <option value="" selected>Please Select</option>
                                    @foreach($branches as $branch)
                                        <option value="{{ $branch->id }}" class="branch_opt" data-branch-id="{{ $branch->dept_id }}" @if(isset($details) && $details->branch_id == $branch->id) selected @endif>{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Status</label>
                                <select name="status" class="form-control" id="status">
                                    <option value="">Please Select</option>
                                    <option value="1" @if(isset($details) && $details->status=="1") selected @endif>Active</option>
                                    <option value="0" @if(isset($details) && $details->status=="0") selected @endif>In Active</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="salary">Salary</label>
                                <input type="number" class="form-control" id="salary" name="salary" placeholder="Enter Full Name" value="{{ $details->salary ?? '' }}"/>
                            </div>

                            <div class="form-group">
                                <label for="joinning_date">Joinning Date</label>
                                <input type="text" class="form-control" id="joinning_date" name="joinning_date" placeholder="Enter Full Name" value="{{ $details->joinning_date ?? '' }}"/>
                            </div>

                            <input type="hidden" name="edit_id" id="edit_id" value="{{ $details->id ?? ''}}">
                            <input type="hidden" name="old_image" id="old_image" value="{{ $details->image ?? ''}}">
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
        $( "#dob, #joinning_date" ).datepicker({
            dateFormat: "yy-mm-dd"
        });

        function departmentData(data){
            $(".branch_opt").hide();
            $(".branch_opt").each(function(){
                if($(this).attr("data-branch-id")==data){
                    $(this).show();
                }
            });
        }
    });
    </script>
@endpush
