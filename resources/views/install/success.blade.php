<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>{{ $title ?? 'Project Successful Active' }}</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
            rel="stylesheet">
        <style>
        body {
            background: linear-gradient(to right, #667eea, #764ba2);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            border-radius: 1rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .form-control:focus {
            border-color: #764ba2;
            box-shadow: 0 0 0 0.2rem rgba(118, 75, 162, 0.25);
        }

        .btn-primary {
            background-color: #764ba2;
            border-color: #764ba2;
        }

        .btn-primary:hover {
            background-color: #5e3d91;
            border-color: #5e3d91;
        }

        .card-title {
            font-weight: 600;
            font-size: 1.5rem;
        }
    </style>
    </head>

    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card p-4">
                        <h2 class="card-title text-center mb-4">✅ Installation
                            Complete!</h2>
                        <p>You can now <a href="{{ route('home') }}" class="btn btn-sm btn-info">login</a> and use your app.</p>
                        <h4 class="text-info">Admin Credentials</h4>
                        <p>Email:       - admin@gmail.com</p>
                        <p>Password:    - admin</p>
                        <a href="{{ route('login.form') }}" class="btn btn-sm btn-primary mb-3">Admin Login</a>
                        </hr>
                        <h4 class="text-info">User Credentials</h4>
                        <p>Email:       - user@gmail.com</p>
                        <p>Password:    - user</p>
                        <a href="{{ route('login.form') }}" class="btn btn-sm btn-primary">User Login</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
