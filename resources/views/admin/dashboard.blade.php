@extends('layouts.admin.app')

@section('title', $title)

@section('content')
    <div class="main-panel">
        <div class="content-wrapper pb-0">
            <div class="page-header flex-wrap">
                <h3 class="mb-0"> Hi, welcome back! <span class="pl-0 h6 pl-sm-2 text-muted d-inline-block">Your web
                        analytics dashboard
                        template.</span>
                </h3>
                <div class="d-flex">
                    <button type="button" class="btn btn-sm bg-white btn-icon-text border">
                        <i class="mdi mdi-email btn-icon-prepend"></i> Email </button>
                    <button type="button" class="btn btn-sm bg-white btn-icon-text border ml-3">
                        <i class="mdi mdi-printer btn-icon-prepend"></i> Print </button>
                    <a href="{{ route('add.emp') }}" class="btn btn-sm ml-3 btn-success"> Add Employee </a>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12 stretch-card grid-margin">
                    <div class="row">
                        <div class="col-xl-4 col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3">
                            <div class="card bg-warning">
                                <div class="card-body px-3 py-4">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="color-card">
                                            <p class="mb-0 color-card-head">Total Leads</p>
                                            <h2 class="text-white"> {{ $t_leads }}
                                            </h2>
                                        </div>
                                        <i class="card-icon-indicator mdi mdi-account-multiple"></i>
                                    </div>
                                    {{-- <h6 class="text-white">18.33% Since last month</h6> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3">
                            <div class="card bg-danger">
                                <div class="card-body px-3 py-4">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="color-card">
                                            <p class="mb-0 color-card-head">Total Telecaller Feedback's</p>
                                            <h2 class="text-white"> {{ $t_feedback }}
                                                {{-- <span class="h5">00</span> --}}
                                            </h2>
                                        </div>
                                        <i class="card-icon-indicator mdi mdi-message-alert-outline"></i>
                                    </div>
                                    {{-- <h6 class="text-white">13.21% Since last month</h6> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3 pb-lg-0 pb-xl-3">
                            <div class="card bg-primary">
                                <div class="card-body px-3 py-4">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="color-card">
                                            <p class="mb-0 color-card-head">Total Campaigns</p>
                                            <h2 class="text-white"> {{ $t_campaign }}
                                                {{-- <span class="h5">00</span> --}}
                                            </h2>
                                        </div>
                                        <i class="card-icon-indicator mdi mdi-bullhorn"></i>
                                    </div>
                                    {{-- <h6 class="text-white">67.98% Since last month</h6> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3 pb-lg-0 pb-xl-3">
                            <div class="card bg-success">
                                <div class="card-body px-3 py-4">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="color-card">
                                            <p class="mb-0 color-card-head">Total Employees</p>
                                            <h2 class="text-white">{{ $t_emp }}</h2>
                                        </div>
                                        <i class="card-icon-indicator mdi mdi-account-group"></i>
                                    </div>
                                    {{-- <h6 class="text-white">20.32% Since last month</h6> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3 pb-lg-0 pb-xl-3">
                            <div class="card bg-success">
                                <div class="card-body px-3 py-4">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="color-card">
                                            <p class="mb-0 color-card-head">Last Login</p>
                                            <h2 class="text-white">{{ session('last_login_at')->diffForHumans() }}</h2>
                                        </div>
                                        <i class="card-icon-indicator mdi mdi-account-group"></i>
                                    </div>
                                    {{-- <h6 class="text-white">20.32% Since last month</h6> --}}
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3 pb-lg-0 pb-xl-3">
                            <div class="card bg-success">
                                <div class="card-body px-3 py-4">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="color-card">
                                            <p class="mb-0 color-card-head">Current Time</p>
                                            <h2 class="text-white"><span id="client-time"></span>
                                            </h2>
                                        </div>
                                        <i class="card-icon-indicator mdi mdi-account-group"></i>
                                    </div>
                                    {{-- <h6 class="text-white">20.32% Since last month</h6> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-xl-9 stretch-card grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-7">
                                    <h5>Business Survey</h5>
                                    <p class="text-muted"> Show overview jan 2018 - Dec 2019 <a
                                            class="text-muted font-weight-medium pl-2" href="#"><u>See Details</u></a>
                                    </p>
                                </div>
                                <div class="col-sm-5 text-md-right">
                                    <button type="button"
                                        class="btn btn-icon-text mb-3 mb-sm-0 btn-inverse-primary font-weight-normal">
                                        <i class="mdi mdi-email btn-icon-prepend"></i>Download Report
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="card mb-3 mb-sm-0">
                                        <div class="card-body py-3 px-4">
                                            <p class="m-0 survey-head">Today Earnings</p>
                                            <div class="d-flex justify-content-between align-items-end flot-bar-wrapper">
                                                <div>
                                                    <h3 class="m-0 survey-value">5,300</h3>
                                                    <p class="text-success m-0">-310 avg. sales</p>
                                                </div>
                                                <div id="earningChart" class="flot-chart"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card mb-3 mb-sm-0">
                                        <div class="card-body py-3 px-4">
                                            <p class="m-0 survey-head">Product Sold</p>
                                            <div class="d-flex justify-content-between align-items-end flot-bar-wrapper">
                                                <div>
                                                    <h3 class="m-0 survey-value">9,100</h3>
                                                    <p class="text-danger m-0">-310 avg. sales</p>
                                                </div>
                                                <div id="productChart" class="flot-chart"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body py-3 px-4">
                                            <p class="m-0 survey-head">Today Orders</p>
                                            <div class="d-flex justify-content-between align-items-end flot-bar-wrapper">
                                                <div>
                                                    <h3 class="m-0 survey-value">4,354</h3>
                                                    <p class="text-success m-0">-310 avg. sales</p>
                                                </div>
                                                <div id="orderChart" class="flot-chart"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-sm-12">
                                    <div class="flot-chart-wrapper">
                                        <div id="flotChart" class="flot-chart">
                                            <canvas class="flot-base"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <p class="text-muted mb-0"> Lorem ipsum dolor sit amet, consectetur
                                        adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                                        dolore. <b>Learn More</b>
                                    </p>
                                </div>
                                <div class="col-sm-4">
                                    <p class="mb-0 text-muted">Sales Revenue</p>
                                    <h5 class="d-inline-block survey-value mb-0"> 2,45,500 </h5>
                                    <p class="d-inline-block text-danger mb-0"> last 8 months </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="row">
                <div class="col-xl-8 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body px-0 overflow-auto">
                            <h4 class="card-title pl-4">Purchase History</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Customer</th>
                                            <th>Project</th>
                                            {{-- <th>Price</th> --}}
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($o_history as $data)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if (empty($data->users->image))
                                                            <img src="assets/images/faces/face1.jpg" alt="image" />
                                                        @else
                                                            <img src="{{ asset('storage/users/' . $data->users->image) }}"
                                                                alt="image" />
                                                        @endif
                                                        <div class="table-user-name ml-3">
                                                            <p class="mb-0 font-weight-medium"> {{ $data->users->email }}
                                                            </p>
                                                            <small>
                                                                Is placed? @if ($data->is_placed == '0')
                                                                    No
                                                                @else
                                                                    Yes
                                                                @endif
                                                            </small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $data->single_products->name }}</td>
                                                <td>
                                                    <div class="badge badge-inverse-success"> {{ $data->t_price }} </div>
                                                </td>
                                                {{-- <td> 77.99</td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <a class="text-black mt-3 d-block pl-4" href="{{ route('view.order_details') }}">
                                <span class="font-weight-medium h6">View all order history</span>
                                <i class="mdi mdi-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title font-weight-medium"> Business Survey </div>
                            <p class="text-muted"> Lorem ipsum dolor sitadipiscing elit, sed amet do
                                eiusmod tempor we find a new solution </p>
                            <div class="d-flex flex-wrap border-bottom py-2 border-top justify-content-between">
                                <img class="survey-img mb-lg-3" src="assets/images/dashboard/img_3.jpg" alt="" />
                                <div class="pt-2">
                                    <h5 class="mb-0">Villa called Archagel</h5>
                                    <p class="mb-0 text-muted">St, San Diego, CA</p>
                                    <h5 class="mb-0">600/mo</h5>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap border-bottom py-2 justify-content-between">
                                <img class="survey-img mb-lg-3" src="assets/images/dashboard/img_1.jpg" alt="" />
                                <div class="pt-2">
                                    <h5 class="mb-0">Luxury villa in Hermo</h5>
                                    <p class="mb-0 text-muted">Glendale, CA</p>
                                    <h5 class="mb-0">900/mo</h5>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap border-bottom py-2 justify-content-between">
                                <img class="survey-img mb-lg-3" src="assets/images/dashboard/img_2.jpg" alt="" />
                                <div class="pt-2">
                                    <h5 class="mb-0">House on the Clarita</h5>
                                    <p class="mb-0 text-muted">Business Survey</p>
                                    <h5 class="mb-0">459/mo</h5>
                                </div>
                            </div>
                            <a class="text-black mt-3 d-block font-weight-medium h6" href="#">View
                                all <i class="mdi mdi-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-black">To do Task List</h4>
                            <p class="text-muted">Created by anonymous</p>
                            <div class="list-wrapper">
                                <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                                    @foreach ($todos as $data)
                                        <li>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="checkbox" type="checkbox" />
                                                    {{ $data->title }}</label>
                                                <span class="list-time">{{ $data->created_at }}</span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="add-items d-flex flex-wrap flex-sm-nowrap">
                                <input type="text" class="form-control todo-list-input flex-grow"
                                    placeholder="Add task name" name="title" id="todo_title" />
                                <button class="add btn btn-primary font-weight-regular text-nowrap" id="add-task"
                                    onclick="addTask()"> Add Task </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-black">Recent Customers</h4>
                            <p class="text-muted">All contacts</p>
                            @foreach ($r_customers as $key => $data)
                                <div class="row pt-2 pb-1">
                                    <div class="col-12 col-sm-7">
                                        <div class="row">
                                            <div class="col-4 col-md-4">
                                                @if ($data->image == '')
                                                    <img class="customer-img" src="assets/images/faces/face22.jpg"
                                                        alt="" />
                                                @else
                                                    <img class="customer-img"
                                                        src="{{ asset('storage/users/' . $data->image) }}"
                                                        alt="" />
                                                @endif
                                            </div>
                                            <div class="col-8 col-md-8 p-sm-0">
                                                <h6 class="mb-0">{{ $data->email }}</h6>
                                                <p class="text-muted font-12">{{ $data->created_at }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-5 pl-0">
                                        <canvas id="areaChart{{ $key + 1 }}"></canvas>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-black">Business Survey</h4>
                            <p class="text-muted pb-2">Jan 01 2019 - Dec 31 2019</p>
                            <canvas id="surveyBar"></canvas>
                            <div class="row border-bottom pb-3 pt-4 align-items-center mx-0">
                                <div class="col-sm-9 pl-0">
                                    <div class="d-flex">
                                        <img src="assets/images/dashboard/img_4.jpg" alt="" />
                                        <div class="pl-2">
                                            <h6 class="m-0">Red Chair</h6>
                                            <p class="m-0">Home Decoration</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 pl-0 pl-sm-3">
                                    <div class="badge badge-inverse-success mt-3 mt-sm-0"> +7.7% </div>
                                </div>
                            </div>
                            <div class="row py-3 align-items-center mx-0">
                                <div class="col-sm-9 pl-0">
                                    <div class="d-flex">
                                        <img src="assets/images/dashboard/img_5.jpg" alt="" />
                                        <div class="pl-2">
                                            <h6 class="m-0">Gray Sofa</h6>
                                            <p class="m-0">Home Decoration</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 pl-0 pl-sm-3">
                                    <div class="badge badge-inverse-success mt-3 mt-sm-0"> +7.7% </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-8 grid-margin stretch-card">
                    <div class="card card-calender">
                        <div class="card-body">
                            <div class="row pt-4">
                                <div class="col-sm-6">
                                    <h1 class="text-white">10:16PM</h1>
                                    <h5 class="text-white">Monday 25 October, 2016</h5>
                                    <h5 class="text-white pt-2 m-0">Precipitation:50%</h5>
                                    <h5 class="text-white m-0">Humidity:23%</h5>
                                    <h5 class="text-white m-0">Wind:13 km/h</h5>
                                </div>
                                <div class="col-sm-6 text-sm-right pt-3 pt-sm-0">
                                    <h3 class="text-white">Clear Sky</h3>
                                    <p class="text-white m-0">London, UK</p>
                                    <h3 class="text-white m-0">21°C</h3>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-sm-12">
                                    <ul class="d-flex pl-0 overflow-auto">
                                        <li class="weakly-weather-item text-white font-weight-medium text-center active">
                                            <p class="mb-0">TODAY</p>
                                            <i class="mdi mdi-weather-cloudy"></i>
                                            <p class="mb-0">21<span class="symbol">°c</span></p>
                                        </li>
                                        <li class="weakly-weather-item text-white font-weight-medium text-center">
                                            <p class="mb-0">MON</p>
                                            <i class="mdi mdi-weather-hail"></i>
                                            <p class="mb-0">21<span class="symbol">°c</span></p>
                                        </li>
                                        <li class="weakly-weather-item text-white font-weight-medium text-center">
                                            <p class="mb-0">TUE</p>
                                            <i class="mdi mdi-weather-cloudy"></i>
                                            <p class="mb-0">21<span class="symbol">°c</span></p>
                                        </li>
                                        <li class="weakly-weather-item text-white font-weight-medium text-center">
                                            <p class="mb-0">WED</p>
                                            <i class="mdi mdi-weather-fog"></i>
                                            <p class="mb-0">21<span class="symbol">°c</span></p>
                                        </li>
                                        <li class="weakly-weather-item text-white font-weight-medium text-center">
                                            <p class="mb-0">THU</p>
                                            <i class="mdi mdi-weather-hail"></i>
                                            <p class="mb-0">21<span class="symbol">°c</span></p>
                                        </li>
                                        <li class="weakly-weather-item text-white font-weight-medium text-center">
                                            <p class="mb-0">FRI</p>
                                            <i class="mdi mdi-weather-cloudy"></i>
                                            <p class="mb-0">21<span class="symbol">°c</span></p>
                                        </li>
                                        <li class="weakly-weather-item text-white font-weight-medium text-center">
                                            <p class="mb-0">SAT</p>
                                            <i class="mdi mdi-weather-hail"></i>
                                            <p class="mb-0">21<span class="symbol">°c</span></p>
                                        </li>
                                        <li class="weakly-weather-item text-white font-weight-medium text-center">
                                            <p class="mb-0">SUN</p>
                                            <i class="mdi mdi-weather-cloudy"></i>
                                            <p class="mb-0">21<span class="symbol">°c</span></p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 grid-margin stretch-card">
                    <!--activity-->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">
                                <span class="d-flex justify-content-between">
                                    <span>Activity</span>
                                    <span class="dropdown dropleft d-block">
                                        <span id="dropdownMenuButton1" data-toggle="dropdown" role="button"
                                            aria-haspopup="true" aria-expanded="false">
                                            <span><i class="mdi mdi-dots-horizontal"></i></span>
                                        </span>
                                        <span class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <a class="dropdown-item" href="#">Contact</a>
                                            <a class="dropdown-item" href="#">Helpdesk</a>
                                            <a class="dropdown-item" href="#">Chat with us</a>
                                        </span>
                                    </span>
                                </span>
                            </h4>
                            <ul class="gradient-bullet-list border-bottom">
                                <li>
                                    <h6 class="mb-0"> It's awesome when we find a new solution </h6>
                                    <p class="text-muted">2h ago</p>
                                </li>
                                <li>
                                    <h6 class="mb-0">Report has been updated</h6>
                                    <p class="text-muted">
                                        <span>2h ago</span>
                                        <span class="d-inline-block">
                                            <span class="d-flex d-inline-block">
                                                <img class="ml-1" src="assets/images/faces/face1.jpg" alt="" />
                                                <img class="ml-1" src="assets/images/faces/face10.jpg"
                                                    alt="" />
                                                <img class="ml-1" src="assets/images/faces/face14.jpg"
                                                    alt="" />
                                            </span>
                                        </span>
                                    </p>
                                </li>
                                <li>
                                    <h6 class="mb-0"> Analytics dashboard has been created#Slack </h6>
                                    <p class="text-muted">2h ago</p>
                                </li>
                                <li>
                                    <h6 class="mb-0"> It's awesome when we find a new solution </h6>
                                    <p class="text-muted">2h ago</p>
                                </li>
                            </ul>
                            <a class="text-black mt-3 mb-0 d-block h6" href="#">View all <i
                                    class="mdi mdi-chevron-right"></i></a>
                        </div>
                    </div>
                    <!--activity ends-->
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-xl-4 col-md-6 grid-margin stretch-card">
                    <div class="card card-invoice">
                        <div class="card-body">
                            <h4 class="card-title pb-3">Pending invoices</h4>
                            <div class="list-card">
                                <div class="row align-items-center">
                                    <div class="col-7 col-sm-8">
                                        <div class="row align-items-center">
                                            <div class="col-sm-4">
                                                <img src="assets/images/faces/face2.jpg" alt="" />
                                            </div>
                                            <div class="col-sm-8 pr-0 pl-sm-0">
                                                <span>06 Jan 2019</span>
                                                <h6 class="mb-1 mb-sm-0">Isabel Cross</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5 col-sm-4">
                                        <div class="d-flex pt-1 align-items-center">
                                            <div class="reload-outer bg-info">
                                                <i class="mdi mdi-reload"></i>
                                            </div>
                                            <div class="dropdown dropleft pl-1 pt-3">
                                                <div id="dropdownMenuButton2" data-toggle="dropdown" role="button"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <p><i class="mdi mdi-dots-vertical"></i></p>
                                                </div>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                    <a class="dropdown-item" href="#">Sales</a>
                                                    <a class="dropdown-item" href="#">Track
                                                        Invoice</a>
                                                    <a class="dropdown-item" href="#">Payment
                                                        History</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-card">
                                <div class="row align-items-center">
                                    <div class="col-7 col-sm-8">
                                        <div class="row align-items-center">
                                            <div class="col-sm-4">
                                                <img src="assets/images/faces/face3.jpg" alt="" />
                                            </div>
                                            <div class="col-sm-8 pr-0 pl-sm-0">
                                                <span>18 Mar 2019</span>
                                                <h6 class="mb-1 mb-sm-0">Carrie Parker</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5 col-sm-4">
                                        <div class="d-flex pt-1 align-items-center">
                                            <div class="reload-outer bg-primary">
                                                <i class="mdi mdi-reload"></i>
                                            </div>
                                            <div class="dropdown dropleft pl-1 pt-3">
                                                <div id="dropdownMenuButton3" data-toggle="dropdown" role="button"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <p><i class="mdi mdi-dots-vertical"></i></p>
                                                </div>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                                    <a class="dropdown-item" href="#">Sales</a>
                                                    <a class="dropdown-item" href="#">Track
                                                        Invoice</a>
                                                    <a class="dropdown-item" href="#">Payment
                                                        History</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-card">
                                <div class="row align-items-center">
                                    <div class="col-7 col-sm-8">
                                        <div class="row align-items-center">
                                            <div class="col-sm-4">
                                                <img src="assets/images/faces/face11.jpg" alt="" />
                                            </div>
                                            <div class="col-sm-8 pr-0 pl-sm-0">
                                                <span>10 Apr 2019</span>
                                                <h6 class="mb-1 mb-sm-0">Don Bennett</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5 col-sm-4">
                                        <div class="d-flex pt-1 align-items-center">
                                            <div class="reload-outer bg-warning">
                                                <i class="mdi mdi-reload"></i>
                                            </div>
                                            <div class="dropdown dropleft pl-1 pt-3">
                                                <div id="dropdownMenuButton4" data-toggle="dropdown" role="button"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <p><i class="mdi mdi-dots-vertical"></i></p>
                                                </div>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                                                    <a class="dropdown-item" href="#">Sales</a>
                                                    <a class="dropdown-item" href="#">Track
                                                        Invoice</a>
                                                    <a class="dropdown-item" href="#">Payment
                                                        History</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="list-card">
                                <div class="row align-items-center">
                                    <div class="col-7 col-sm-8">
                                        <div class="row align-items-center">
                                            <div class="col-sm-4">
                                                <img src="assets/images/faces/face3.jpg" alt="" />
                                            </div>
                                            <div class="col-sm-8 pr-0 pl-sm-0">
                                                <span>18 Mar 2019</span>
                                                <h6 class="mb-1 mb-sm-0">Carrie Parker</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5 col-sm-4">
                                        <div class="d-flex pt-1 align-items-center">
                                            <div class="reload-outer bg-info">
                                                <i class="mdi mdi-reload"></i>
                                            </div>
                                            <div class="dropdown dropleft pl-1 pt-3">
                                                <div id="dropdownMenuButton5" data-toggle="dropdown" role="button"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <p><i class="mdi mdi-dots-vertical"></i></p>
                                                </div>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton5">
                                                    <a class="dropdown-item" href="#">Sales</a>
                                                    <a class="dropdown-item" href="#">Track
                                                        Invoice</a>
                                                    <a class="dropdown-item" href="#">Payment
                                                        History</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 grid-margin stretch-card">
                    <!--datepicker-->
                    <div class="card">
                        <div class="card-body">
                            <div id="inline-datepicker" class="datepicker table-responsive"></div>
                        </div>
                    </div>
                    <!--datepicker ends-->
                </div>
                <div class="col-xl-4 col-md-6 stretch-card grid-margin stretch-card">
                    <!--browser stats-->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Browser stats</h4>
                            <div class="row py-2">
                                <div class="col-sm-12">
                                    <div class="d-flex justify-content-between pb-3 border-bottom">
                                        <div>
                                            <img class="mr-2" src="assets/images/browser-logo/opera-logo.png"
                                                alt="" />
                                            <span class="p">opera mini</span>
                                        </div>
                                        <p class="mb-0">23%</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row py-2">
                                <div class="col-sm-12">
                                    <div class="d-flex justify-content-between pb-3 border-bottom">
                                        <div>
                                            <img class="mr-2" src="assets/images/browser-logo/safari-logo.png"
                                                alt="" />
                                            <span class="p">Safari</span>
                                        </div>
                                        <p class="mb-0">07%</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row py-2">
                                <div class="col-sm-12">
                                    <div class="d-flex justify-content-between pb-3 border-bottom">
                                        <div>
                                            <img class="mr-2" src="assets/images/browser-logo/chrome-logo.png"
                                                alt="" />
                                            <span class="p">Chrome</span>
                                        </div>
                                        <p class="mb-0">33%</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row py-2">
                                <div class="col-sm-12">
                                    <div class="d-flex justify-content-between pb-3 border-bottom">
                                        <div>
                                            <img class="mr-2" src="assets/images/browser-logo/firefox-logo.png"
                                                alt="" />
                                            <span class="p">Firefox</span>
                                        </div>
                                        <p class="mb-0">17%</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row py-2">
                                <div class="col-sm-12">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <img class="mr-2" src="assets/images/browser-logo/explorer-logo.png"
                                                alt="" />
                                            <span class="p">Explorer</span>
                                        </div>
                                        <p class="mb-0">05%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--browser stats ends-->
                </div>
            </div> --}}
        </div>
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©
                    {{ env('APP_NAME') }} @php echo date("Y"); @endphp</span>
                {{-- <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap dashboard template</a> from Bootstrapdash.com</span> --}}
            </div>
        </footer>
    </div>
    <!-- main-panel ends -->
@endsection
@push('script')
    <script>
        function addTask() {
            var title = $("#todo_title").val();
            if (title == "") {
                alert("Title Field Is Required");
                return false;
            }
            $.ajax({
                type: "POST",
                url: "{{ route('todos.store') }}",
                data: {
                    title: title
                },
                success: function(data) {
                    console.log(data);
                    alert(data.message);
                    $("#todo_title").val('');
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        }
    </script>
@endpush
@push('script')
<script>
    function updateClientTime() {
        const now = new Date();

        // Format the time (e.g., 10:05:23 AM)
        const timeString = now.toLocaleTimeString(); // You can also use .toLocaleString() for full date+time

        // Update the span
        document.getElementById('client-time').textContent = timeString;
    }

    // Update every second
    setInterval(updateClientTime, 1000);

    // Run immediately on load
    updateClientTime();
</script>
@endpush
    
