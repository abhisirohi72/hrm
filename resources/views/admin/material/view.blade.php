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
                        <h4 class="card-title">Materials Details</h4>
                        <a href="{{ route('add.material') }}" class="btn btn-primary btn-icon-text mb-2"
                            style="float:right;">
                            Add
                        </a>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>PDF</th>
                                        <th>Video</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($details) > 0)
                                        @foreach ($details as $detail)
                                            <tr>
                                                <td>
                                                    <iframe src="{{ asset('storage/materials').'/'.$detail->pdf }}" width="300px" height="360px">
                                                        This browser does not support PDFs. Please download the PDF to view it: 
                                                        <a href="{{ asset('storage/materials').'/'.$detail->pdf }}">Download PDF</a>.
                                                    </iframe>
                                                </td>
                                                <td>
                                                    <video width="640" height="360" controls>
                                                        <source src="{{ asset('storage/materials').'/'.$detail->video }}"
                                                            type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                </td>
                                                <td>
                                                    @if (!empty($detail->image))
                                                        <img src="{{ asset('storage/materials') . '/' . $detail->image }}" alt="" style="width:640px;height:360px;">
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('edit.material', ['id' => $detail->id]) }}"
                                                        class="btn btn-dark btn-icon-text">Edit<i
                                                            class="mdi mdi-file-check btn-icon-append"></i>
                                                    </a>
                                                    <a href="{{ route('delete.material', ['id' => $detail->id]) }}"
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
