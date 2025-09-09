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
                        {{-- @if (count($details) == 0) --}}
                        <a href="{{ route('add.whats_app.flow') }}" class="btn btn-primary btn-icon-text mb-2"
                            style="float: right;">
                            Add
                        </a>
                        {{-- @endif --}}
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Searching Words</th>
                                        <th>Reply</th>
                                        <th>Image</th>
                                        <th>Document</th>
                                        <th>Filename</th>
                                        <th>Audio</th>
                                        <th>Video</th>
                                        <th>Date</th>
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
                                                    @if (!empty($detail->image))
                                                        <img src="{{ asset('storage/whatsapp') . '/' . $detail->image }}"
                                                            alt="" style="width:100px; height:100px;">
                                                    @else
                                                        <button class="btn btn-info">N/A</button>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (!empty($detail->document))
                                                        <a href="{{ asset('storage/whatsapp') . '/' . $detail->document }}"
                                                            class="btn btn-info" target="_blank">View</a>
                                                    @else
                                                        <button class="btn btn-info">N/A</button>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $detail->filename ?? '' }}
                                                </td>
                                                <td>
                                                    @if (!empty($detail->audio))
                                                        <br><a
                                                            href="{{ asset('storage/whatsapp') . '/' . $detail->audio }}"
                                                            class="btn btn-info" target="_blank">View</a>
                                                    @else
                                                        <button class="btn btn-info">N/A</button>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (!empty($detail->video))
                                                        <a href="{{ asset('storage/whatsapp') . '/' . $detail->video }}"
                                                            class="btn btn-info" target="_blank">View</a>
                                                    @else
                                                        <button class="btn btn-info">N/A</button>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $detail->created_at }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('edit.whats_app.flow', ['id' => $detail->id]) }}"
                                                        class="btn btn-dark btn-icon-text">Edit <i
                                                            class="mdi mdi-file-check btn-icon-append"></i>
                                                    </a>
                                                    <a href="{{ route('delete.whats_app.flow', ['id' => $detail->id]) }}"
                                                        class="btn btn-danger">Delete <i
                                                            class="mdi mdi-delete btn-icon-append"></i>
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
