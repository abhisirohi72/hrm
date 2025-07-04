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
                        <h4 class="card-title">Whats App Flow</h4>
                        @if (count($details) == 0)
                        <a href="{{ route('add.whats_app.flow') }}" class="btn btn-primary btn-icon-text mb-2" style="float: right;">
                            Add
                        </a>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Searching Words</th>
                                        <th>Reply</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($details) > 0)
                                        @foreach ($details as $detail)
                                            <tr>
                                                <td>{{ $detail->searching_words ?? '' }}</td>
                                                <td>{!! $detail->reply ?? '' !!}</td>
                                                <td>
                                                    <a href="{{ route('edit.whats_app.flow', ['id' => $detail->id]) }}" class="btn btn-dark btn-icon-text">Edit <i class="mdi mdi-file-check btn-icon-append"></i>
                                                    </a>
                                                    <a href="{{ route('delete.whats_app.flow', ['id' => $detail->id]) }}" class="btn btn-danger">Delete <i class="mdi mdi-delete btn-icon-append"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8 text-center">
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