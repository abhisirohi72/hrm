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
                        <h4 class="card-title">{{ $title }} Details</h4>
                        <h1 id="status">connecting</h1>
                        <h2 id="substatus">
                            </h1>
                            <img id="qr"
                                src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="https://cdn.socket.io/4.4.1/socket.io.min.js"
        integrity="sha384-fKnu0iswBIqkjxrhQCTZ7qlLHOFEgNkRmK2vaO/LbTZSXdJfAu6ewRBdwHPhBo/H" crossorigin="anonymous">
    </script>
    <script>
        instance_id = "instance{{ $instance }}" // put your instance id here
        token = "{{ $token }}"; // put your token here

        var server = 'https://api.ultramsg.com'
        var socket = io.connect(server, {
            transports: ['websocket'],
            path: '/' + instance_id + '/socket.io',
            auth: {
                instance_id: instance_id,
                token: token
            }
        });

        socket.on('connect', function(msg) {
            document.getElementById("status").innerHTML = "connected";
        });
        socket.on("connect_error", (err) => {
            //console.log(err)
        });
        socket.on("disconnect", function() {
            socket.disconnect();
        });

        socket.on('status', function(results) {
            if (results && results.status && results.status.accountStatus) {
                if (results.status.accountStatus.status) {
                    document.getElementById("status").innerHTML = results.status.accountStatus.status
                }
                if (results.status.accountStatus.substatus) {
                    document.getElementById("substatus").innerHTML = results.status.accountStatus.substatus
                }
                if (results.status.accountStatus.qrCodeImage) {
                    document.getElementById("qr").src = results.status.accountStatus.qrCodeImage
                } else {
                    document.getElementById("qr").src =
                        "data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==";
                }
            }
        })
    </script>
@endpush
