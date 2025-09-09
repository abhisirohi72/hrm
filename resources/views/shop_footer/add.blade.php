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

                        <h4 class="card-title">{{ $title }}</h4>
                        <form class="forms-sample" method="POST" action="{{ route('save.footer.details') }}">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Mini Description</label>
                                <textarea class="form-control" name="mini_desc" id="mini_desc" required>{{ $details->mini_desc ?? ''}}</textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Company Name</label>
                                <input type="text" class="form-control" name="c_name"
                                    value="{{ $details->c_name ?? ''}}" placeholder="Enter your company name" >
                            </div>

                            <div class="form-group">
                                <label class="form-label">Facebook URL</label>
                                <input type="text" class="form-control" name="fb_url"
                                    value="{{ $details->fb_url ?? ''}}" placeholder="Enter your facebook url" >
                            </div>

                            <div class="form-group">
                                <label class="form-label">Instagram URL</label>
                                <input type="text" class="form-control" name="insta_url"
                                    value="{{ $details->insta_url ?? ''}}" placeholder="Enter your instagram url" >
                            </div>

                            <div class="form-group">
                                <label class="form-label">Twitter URL</label>
                                <input type="text" class="form-control" name="twitter_url"
                                    value="{{ $details->twitter_url ?? ''}}" placeholder="Enter your twitter url" >
                            </div>

                            <div class="form-group">
                                <label class="form-label">Linkedin URL</label>
                                <input type="text" class="form-control" name="linkedin_url"
                                    value="{{ $details->linkedin_url ?? ''}}" placeholder="Enter your linkedin url" >
                            </div>

                            <div class="form-group">
                                <label class="form-label">Youtube URL</label>
                                <input type="text" class="form-control" name="youtube_url"
                                    value="{{ $details->youtube_url ?? ''}}" placeholder="Enter your youtube url" >
                            </div>

                            <div class="form-group">
                                <label class="form-label">Contact</label>
                                <input type="text" class="form-control" name="contact"
                                    value="{{ $details->contact ?? ''}}" placeholder="Enter your contact" >
                            </div>

                            <div class="form-group">
                                <label class="form-label">Company Email</label>
                                <input type="text" class="form-control" name="c_email"
                                    value="{{ $details->c_email ?? ''}}" placeholder="Enter your company email" >
                            </div>

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
