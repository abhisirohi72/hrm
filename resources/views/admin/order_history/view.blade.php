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
                    <div class="card-body" style="overflow: auto;">
                        <h4 class="card-title">Order Details</h4>
                        <a href="{{ route('add.material') }}" class="btn btn-primary btn-icon-text mb-2"
                            style="float:right;">
                            Add
                        </a>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Order Unique ID</th>
                                        <th>Product Name</th>
                                        <th>Product Image</th>
                                        <th>Product Price</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Is Placed</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($details) > 0)
                                        @foreach ($details as $detail)
                                            <tr>
                                                <td>{{ $detail->order_unique_id }}</td>
                                                <td>{{ $detail->products[0]->name }}</td>
                                                <td><img src="{{ asset('storage/product/images') . '/' . $detail->products[0]->image }}" alt="" style="width:100px;height:100px;" class="mb-2"></td>
                                                <td>{{ number_format($detail->p_price,2) }}</td>
                                                <td>{{ $detail->qnty }}</td>
                                                <td>{{ number_format($detail->t_price,2) }}</td>
                                                <td>
                                                    @if($detail->is_placed=="0")
                                                        No
                                                    @else
                                                        yes
                                                    @endif    
                                                </td>
                                                <td>
                                                    {{-- <a href="{{ route('edit.material', ['id' => $detail->id]) }}"
                                                        class="btn btn-dark btn-icon-text">Edit<i
                                                            class="mdi mdi-file-check btn-icon-append"></i>
                                                    </a> --}}
                                                    <a href="{{ route('delete.order_details', ['unique_id' => $detail->id]) }}"
                                                        class="btn btn-danger">Delete <i
                                                            class="mdi mdi-delete btn-icon-append"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4 text-center">
                                                <p>No Records Found..</p>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
