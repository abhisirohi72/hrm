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

                        <h4 class="card-title">Add Departments Pages</h4>
                        <form class="forms-sample" method="POST" action="{{ route('save.page.access') }}">
                            @csrf
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="page_name[]" value="dashboard" @if(in_array("dashboard", $details->pluck("page_name")->toArray())) checked @endif/> Dashboard </label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="page_name[]" value="departments" @if(in_array("departments", $details->pluck("page_name")->toArray())) checked @endif/> Departments </label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="page_name[]" value="branch" @if(in_array("branch", $details->pluck("page_name")->toArray())) checked @endif/> Branch </label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="page_name[]" value="employee" @if(in_array("employee", $details->pluck("page_name")->toArray())) checked @endif/> Employee </label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="page_name[]" value="telecaler" @if(in_array("telecaler", $details->pluck("page_name")->toArray())) checked @endif/> View Telecaller Feedback </label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="page_name[]" value="attendance" @if(in_array("attendance", $details->pluck("page_name")->toArray())) checked @endif/> View Attendance </label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="page_name[]" value="loans" @if(in_array("loans", $details->pluck("page_name")->toArray())) checked @endif/> Loans </label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="page_name[]" value="salary" @if(in_array("salary", $details->pluck("page_name")->toArray())) checked @endif/> Advance Salary </label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="page_name[]" value="category" @if(in_array("category", $details->pluck("page_name")->toArray())) checked @endif/> Category </label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="page_name[]" value="products" @if(in_array("products", $details->pluck("page_name")->toArray())) checked @endif/> Products </label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="page_name[]" value="footer_shop" @if(in_array("footer_shop", $details->pluck("page_name")->toArray())) checked @endif/> Shop Footer Details </label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="page_name[]" value="discount" @if(in_array("discount", $details->pluck("page_name")->toArray())) checked @endif/> Discount </label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="page_name[]" value="cart_setting" @if(in_array("cart_setting", $details->pluck("page_name")->toArray())) checked @endif/> Cart Setting </label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="page_name[]" value="salary_account" @if(in_array("salary_account", $details->pluck("page_name")->toArray())) checked @endif/> Add Salary Account </label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="page_name[]" value="lead_management" @if(in_array("lead_management", $details->pluck("page_name")->toArray())) checked @endif/> Lead Management </label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="page_name[]" value="task_management" @if(in_array("task_management", $details->pluck("page_name")->toArray())) checked @endif/> Task Management </label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="page_name[]" value="todo" @if(in_array("todo", $details->pluck("page_name")->toArray())) checked @endif/> Todo List</label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="page_name[]" value="contact_us" @if(in_array("contact_us", $details->pluck("page_name")->toArray())) checked @endif/> Contact Us Details</label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="page_name[]" value="leaves" @if(in_array("leaves", $details->pluck("page_name")->toArray())) checked @endif/> Leaves</label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="page_name[]" value="holidays" @if(in_array("holidays", $details->pluck("page_name")->toArray())) checked @endif/> Holidays</label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="page_name[]" value="target" @if(in_array("target", $details->pluck("page_name")->toArray())) checked @endif/> Target</label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="page_name[]" value="sop" @if(in_array("sop", $details->pluck("page_name")->toArray())) checked @endif/> SOP</label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="page_name[]" value="campaign" @if(in_array("campaign", $details->pluck("page_name")->toArray())) checked @endif/> Campaign</label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="page_name[]" value="order_details" @if(in_array("order_details", $details->pluck("page_name")->toArray())) checked @endif/> Order Details</label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="page_name[]" value="material" @if(in_array("material", $details->pluck("page_name")->toArray())) checked @endif/> Materials</label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="page_name[]" value="users" @if(in_array("users", $details->pluck("page_name")->toArray())) checked @endif/> Users</label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="page_name[]" value="meetings" @if(in_array("meetings", $details->pluck("page_name")->toArray())) checked @endif/> Meetings</label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="page_name[]" value="template" @if(in_array("template", $details->pluck("page_name")->toArray())) checked @endif/> Template</label>
                            </div>

                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="page_name[]" value="whats_app" @if(in_array("whats_app", $details->pluck("page_name")->toArray())) checked @endif/> Whats App Setting</label>
                            </div>

                            <input type="hidden" name="department_id" value="{{ $id }}">
                            <button type="submit" class="btn btn-primary mr-2"> Submit </button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
