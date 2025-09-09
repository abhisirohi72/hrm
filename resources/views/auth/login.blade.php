<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Product Demo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #111;
            color: #fff;
        }

        header {
            text-align: center;
            padding: 30px;
            background: #1b1b1d;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
            color: gold;
        }

        .container {
            max-width: 400px;
            margin: 40px auto;
            background: #1e1e20;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }

        .container h2 {
            margin: 0 0 20px;
            text-align: center;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: none;
            border-radius: 8px;
        }

        button {
            width: 105%;
            padding: 10px;
            margin-top: 12px;
            background: gold;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }

        .forgot {
            width: 100%;
            padding: 10px;
            margin-top: 12px;
            background: rgb(97, 95, 226);
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            float: left;
            text-align: center;
            text-decoration: none;
            margin-bottom: 10px;
        }

        .msg {
            text-align: center;
            margin-top: 12px;
            color: tomato;
            font-size: 14px;
        }

        .demo-info {
            background: #222;
            padding: 10px;
            border-radius: 8px;
            margin-top: 20px;
            font-size: 13px;
        }

        .dashboard {
            display: none;
            text-align: center;
            padding: 40px;
        }

        .dashboard h2 {
            color: gold;
        }

        .logout {
            margin-top: 20px;
            padding: 8px 16px;
            background: #444;
            border: none;
            border-radius: 8px;
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <header>
        <h1>🌐 Digital Product Demo</h1>
        <p>Showcasing User & Admin demo login</p>
    </header>

    <div class="container" id="loginBox">
        <h2>Demo Login</h2>
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
            <input type="email" id="email" name="email" placeholder="Enter Username/Email">
            <input type="password" id="password" name="password" placeholder="Enter Password">
            <button type="submit" class="btn btn-primary">Login</button>
            <a href="{{ route('register.form') }}" class="forgot">Register</a>
            <p class="msg" id="msg"></p>
        </form>

        <div class="demo-info">
            <strong>Demo Credentials:</strong><br><br>
            👤 User Email → user@gmail.com<br>
            👤 User Password → user<br><hr>

            🔑 Admin Email→ admin@gmail.com<br>
            🔑 Admin Password→ admin
        </div>
    </div>
</body>

</html>
