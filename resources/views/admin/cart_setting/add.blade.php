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

                        <h4 class="card-title">Cart Setting</h4>
                        <form class="forms-sample" method="POST" action="{{ route('save.cart.setting') }}">
                            @csrf
                            <div class="form-group">
                                <label for="department">GST</label>
                                <input type="number" class="form-control" id="gst" name="gst"
                                    placeholder="Enter GST Number" value="{{ $details->gst ?? '' }}" />
                            </div>

                            <div class="form-group">
                                <label for="exampleInputUsername1">Payment Mode</label>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="wallet_payment_mode" value="1" @if (isset($details) && $details->wallet_payment_mode==1) checked @endif /> Wallet
                                    </label>
                                </div>  
                                <div class="form-check">
                                    <label for="cod" class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="cod_payment_mode" value="1" @if (isset($details) && $details->cod_payment_mode==1) checked @endif /> Cash On Delivery
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label for="online" class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="online_payment_mode" value="1" @if (isset($details) && $details->online_payment_mode==1) checked @endif /> Online
                                    </label>
                                </div>
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
