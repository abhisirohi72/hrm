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
                        <form class="forms-sample" method="POST" action="{{ route('save.user.details') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="name" id="name" required value="{{ $details->name ?? ''}}" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Email address</label>
                                <input type="email" class="form-control" name="email"
                                    value="{{ $details->email ?? ''}}" placeholder="Enter your email" >
                            </div>

                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password"
                                    value="{{ $details->password ?? ''}}" placeholder="Enter your Password" >
                            </div>

                            <div class="form-group">
                                <label class="form-label">Image</label>
                                <input type="file" class="form-control" name="image" id="image">
                            </div>

                            @if(isset($details->image) && $details->image!="")
                                <div class="form-group">
                                    <label for="">Current Image</label>
                                    <img src="{{ asset('storage/users').'/'.$details->image }}" alt="" style="width: 100px; height:100px;">
                                </div>
                            @endif

                            <div class="form-group">
                                <label class="form-label">Wallet Balance</label>
                                <input type="text" class="form-control" name="wallet_balance"
                                    value="{{ $details->wallet_balance ?? ''}}" placeholder="Enter your wallet balance" >
                            </div>

                            <div class="form-group">
                                <label for="">Stripe ID</label>
                                <textarea class="form-control" id="stripe_id" name="stripe_id" placeholder="Enter your Stripe ID">{{ $details->stripe_id ?? ''}}</textarea>
                            </div>

                            <input type="hidden" name="old_image" id="old_image" value="{{ $details->image ?? ''}}">
                            <input type="hidden" name="edit_id" id="edit_id" value="{{ $details->id ?? ''}}">
                            <button type="submit" class="btn btn-primary mr-2"> Submit </button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
