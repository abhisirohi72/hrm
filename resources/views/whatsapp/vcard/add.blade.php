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
                        <form id="myForm" method="POST" action="{{ route('save.whats_app.vcard') }}">
                            @csrf
                            <div class="form-group">
                                <label for="to">To</label>
                                <input type="text" name="to" id="to" class="form-control"
                                    value="@if (isset($details) && $details->to != '') {{ $details->to }} @endif">
                            </div>

                            <div class="form-group">
                                <label for="vcard">Vcard</label>
                                <textarea name="vcard" id="vcard" class="form-control"
                                    placeholder="Text value vcard 3.0 Max length : 4096 char Example :BEGIN:VCARD\nVERSION:3.0\nN:lastname;firstname\nFN:firstname lastname\nTEL;TYPE=CELL;waid=14000000001:14000000002\nNICKNAME:nickname\nBDAY:01.01.1987\nX-GENDER:M\nNOTE:note\nADR;TYPE=home:;;;;;;\nADR;TYPE=work_:;;;;;;\nEND:VCARD" style="height:100px;"></textarea>
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
