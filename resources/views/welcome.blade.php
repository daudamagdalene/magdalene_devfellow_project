<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Laravel</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .header {
            max-width: 1200px;
            margin: 0 auto 30px;
            text-align: right;
        }
        .header a, .header button {
            display: inline-block;
            padding: 10px 20px;
            margin-left: 10px;
            background: white;
            color: #667eea;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }
        .header a:hover, .header button:hover {
            background: #f0f0f0;
        }
        .header .register {
            background: #28a745;
            color: white;
        }
        .header .register:hover {
            background: #218838;
        }
        .header .logout {
            background: #dc3545;
            color: white;
        }
        .header .logout:hover {
            background: #c82333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        h1 {
            color: #667eea;
            margin-bottom: 20px;
            font-size: 2.5em;
        }
        p {
            color: #666;
            line-height: 1.8;
            margin-bottom: 20px;
        }
        .links {
            list-style: none;
            margin: 30px 0;
        }
        .links li {
            padding: 15px;
            background: #f8f9fa;
            margin-bottom: 10px;
            border-radius: 5px;
            border-left: 4px solid #667eea;
        }
        .links a {
            color: #667eea;
            text-decoration: none;
            font-weight: bold;
        }
        .links a:hover {
            text-decoration: underline;
        }
        .welcome-box {
            background: #e7f3ff;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        @auth
            <a href="{{ url('/dashboard') }}">Dashboard</a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}" class="register">Register</a>
        @endauth
    </div>

    <div class="container">
        <h1>Welcome to Laravel!</h1>

        @auth
            <div class="welcome-box">
                <strong>Hello, {{ auth()->user()->name }}!</strong><br>
                You are logged in. Visit your <a href="{{ url('/dashboard') }}">dashboard</a> to get started.
            </div>
        @else
            <div class="welcome-box">
                <strong>Get Started</strong><br>
                Please <a href="{{ route('login') }}">login</a> or <a href="{{ route('register') }}">create an account</a> to continue.
            </div>
        @endguest

        <p>Laravel has an incredibly rich ecosystem. We suggest starting with the following:</p>

        <ul class="links">
            <li>📖 Read the <a href="https://laravel.com/docs" target="_blank">Documentation</a></li>
            <li>🎥 Watch video tutorials at <a href="https://laracasts.com" target="_blank">Laracasts</a></li>
            <li>🚀 <a href="https://cloud.laravel.com" target="_blank">Deploy your application</a></li>
        </ul>

        <p><strong>Quick Access:</strong></p>
        <ul class="links">
            <li><a href="{{ route('login') }}">Login to your account</a></li>
            <li><a href="{{ route('register') }}">Create a new account</a></li>
            <li><a href="/test-permissions">Test Permissions (requires login)</a></li>
        </ul>
    </div>
</body>
</html>
