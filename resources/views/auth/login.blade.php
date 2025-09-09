<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('frontend/images/logo.png') }}">

    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            overflow: hidden;
            /* prevents scrollbar from pushing content */
        }

        .bg-video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .main-content {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            background: rgb(167 235 159 / 95%);
            z-index: 1;
        }
    </style>
</head>

<body>

    <!-- Background Video -->
    <video autoplay muted loop playsinline class="bg-video">
        <source src="{{ asset('frontend/assets/video/bg.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Login Form Content -->
    <div class="container main-content">
        <div class="card p-4 shadow" style="width: 100%; max-width: 400px;">
            <h3 class="mb-4 text-center">Login</h3>

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" required autofocus>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>

                <div class="text-center mt-3">
                    <a href="#">Forgot Password</a><br>
                    <a href="{{ route('register.form') }}">Register</a>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
