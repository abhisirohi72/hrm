<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Database Credentials' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
                    <h2 class="card-title text-center mb-4">🔧 Step 1: Database Configuration</h2>

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form method="POST" action="{{ route('installer.save_database') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="db_host" class="form-label">Database
                                Host</label>
                            <input type="text" class="form-control" id="db_host" name="db_host" value="127.0.0.1"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="db_port" class="form-label">Database
                                Port</label>
                            <input type="text" class="form-control" id="db_port" name="db_port" value="3306"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="db_database" class="form-label">Database Name</label>
                            <input type="text" class="form-control" id="db_database" name="db_database" required>
                        </div>

                        <div class="mb-3">
                            <label for="db_username" class="form-label">Database Username</label>
                            <input type="text" class="form-control" id="db_username" name="db_username" required>
                        </div>

                        <div class="mb-3">
                            <label for="db_password" class="form-label">Database Password</label>
                            <input type="password" class="form-control" id="db_password" name="db_password">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Save &
                                Install</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
