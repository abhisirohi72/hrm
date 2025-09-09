<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>{{ $title ?? 'System Check' }}</title>
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
                        <h2 class="card-title text-center mb-4">🔧 Step 2:
                            System Check</h2>
                        <ul>
                            <li>
                                PHP Version: {{
                                $requirements['php_version']['value'] }}
                                (Required: {{
                                $requirements['php_version']['required'] }})
                                {!! $requirements['php_version']['status'] ?
                                '✅ OK' : '❌ FAIL' !!}
                            </li>

                            <li>
                                MySQL Version: {{
                                $requirements['mysql_version']['value'] ??
                                '❌ Not connected' }}
                                {!! $requirements['mysql_version']['status'] ?
                                '✅ OK' : '❌ FAIL' !!}
                            </li>

                            <li>Composer Installed: {!!
                                $requirements['composer'] ? '✅ OK' : '❌ FAIL'
                                !!}</li>

                            <hr>
                            <h3>🔌 PHP Extensions</h3>
                            <ul>
                                @foreach ($requirements['extensions'] as $ext =>
                                $loaded)
                                <li>{{ strtoupper($ext) }}: {!! $loaded ? '✅' :
                                    '❌' !!}</li>
                                @endforeach
                            </ul>

                            <hr>
                            <h3>🧠 PHP Functions</h3>
                            <ul>
                                <li>allow_url_fopen: {!!
                                    $requirements['functions']['allow_url_fopen']
                                    ? '✅' : '❌' !!}</li>
                                <li>file_get_contents: {!!
                                    $requirements['functions']['file_get_contents']
                                    ? '✅' : '❌' !!}</li>
                            </ul>
                        </ul>
                        <a href="{{ route('installer.success') }}"
                            class="btn btn-sm btn-primary">Next Step</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
