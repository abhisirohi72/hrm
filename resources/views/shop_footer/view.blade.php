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
                        <h4 class="card-title">Shop Footer Details</h4>
                        @if (empty($details) && count($details) == 0)
                            <a href="{{ route('add.footer.details') }}" class="btn btn-primary btn-icon-text mb-2" style="float: right;">
                                Add
                            </a>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Mini Description</th>
                                        <th>Company Name</th>
                                        <th>Fb URL</th>
                                        <th>Instagram URL</th>
                                        <th>Twitter URL</th>
                                        <th>Linkedin URL</th>
                                        <th>Youtube URL</th>
                                        <th>Contact</th>
                                        <th>Company Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($details) && count($details) > 0)
                                        @foreach ($details as $item)
                                            <tr>
                                                <td>{{ $item->mini_desc ?? '' }}</td>
                                                <td>{{ $item->c_name }}</td>
                                                <td>{{ $item->fb_url }}</td>
                                                <td>{{ $item->insta_url }}</td>
                                                <td>{{ $item->twitter_url }}</td>
                                                <td>{{ $item->linkedin_url }}</td>
                                                <td>{{ $item->youtube_url }}</td>
                                                <td>{{ $item->contact }}</td>
                                                <td>{{ $item->c_email }}</td>
                                                <td>
                                                    <a href="{{ route('edit.footer.details', ['id' => $item->id]) }}"
                                                        class="btn btn-dark btn-icon-text">Edit
                                                        <i class="mdi mdi-file-check btn-icon-append"></i>
                                                    </a>
                                                    <a href="{{ route('delete.footer.details', ['id' => $item->id]) }}"
                                                        class="btn btn-danger">Delete
                                                        <i class="mdi mdi-delete btn-icon-append"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="2">
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
