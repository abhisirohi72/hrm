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

                        <h4 class="card-title">Add Product Details</h4>
                        <form class="forms-sample" method="POST" action="{{ route('save.product') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="" selected>Please Select</option>
                                    @if (isset($cat_details) && filled($cat_details))
                                        @foreach ($cat_details as $cat_detail)
                                            <option value="{{ $cat_detail->id }}"
                                                @if (isset($details) && $details->category_id == $cat_detail->id) selected @endif>
                                                {{ $cat_detail->name }}
                                                @if ($cat_detail->type == '0')
                                                    - Physical
                                                @else
                                                    - Digital
                                                @endif
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="name">Image</label>
                                <input type="file" class="form-control" id="image" name="image" />
                            </div>
                            @if (isset($details))
                                <img src="{{ asset('storage/product/images') . '/' . $details->image }}" alt="" style="width:100px;height:100px;" class="mb-2">
                            @endif
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Name" value="{{ $details->name ?? '' }}" />
                            </div>

                            <div class="form-group">
                                <label for="sku">SKU</label>
                                <input type="text" class="form-control" id="sku" name="sku"
                                    placeholder="Enter SKU" value="{{ $details->sku ?? '' }}" />
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Enter description">{{ $details->description ?? '' }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" id="price" name="price"
                                    placeholder="Enter price" value="{{ $details->price ?? '' }}" />
                            </div>

                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity"
                                    placeholder="Enter quantity" value="{{ $details->quantity ?? '' }}" />
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
