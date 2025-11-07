<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - {{ config('app.name') }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .header {
            background: white;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 { color: #333; }
        .user-info {
            background: #f8f9fa;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .card h2 {
            color: #667eea;
            margin-bottom: 15px;
        }
        .badge {
            display: inline-block;
            padding: 5px 15px;
            background: #667eea;
            color: white;
            border-radius: 20px;
            font-size: 14px;
            margin-right: 10px;
        }
        .permission-list {
            list-style: none;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 10px;
            margin-top: 15px;
        }
        .permission-list li {
            background: #f8f9fa;
            padding: 10px 15px;
            border-radius: 5px;
            border-left: 3px solid #667eea;
        }
        .logout-btn {
            padding: 10px 20px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .logout-btn:hover {
            background: #c82333;
        }
        .nav-links {
            margin-top: 20px;
        }
        .nav-links a {
            display: inline-block;
            padding: 10px 20px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 10px;
            margin-bottom: 10px;
        }
        .nav-links a:hover {
            background: #5568d3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>🎯 Dashboard</h1>
            </div>
            <div class="user-info">
                <strong>{{ auth()->user()->name }}</strong>
                <form method="POST" action="{{ route('logout') }}" style="display: inline; margin-left: 15px;">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>
        </div>

        <div class="card">
            <h2>👤 User Information</h2>
            <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
            <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
            <p><strong>User ID:</strong> {{ auth()->user()->id }}</p>
            <p style="margin-top: 15px;">
                <strong>Your Roles:</strong><br>
                @forelse(auth()->user()->getRoleNames() as $role)
                    <span class="badge">{{ $role }}</span>
                @empty
                    <span style="color: #999;">No roles assigned</span>
                @endforelse
            </p>
        </div>

        <div class="card">
            <h2>🔐 Your Permissions ({{ auth()->user()->getAllPermissions()->count() }})</h2>
            @if(auth()->user()->getAllPermissions()->count() > 0)
                <ul class="permission-list">
                    @foreach(auth()->user()->getAllPermissions() as $permission)
                        <li>✓ {{ $permission->name }}</li>
                    @endforeach
                </ul>
            @else
                <p style="color: #999;">No permissions assigned</p>
            @endif
        </div>

        <div class="card">
            <h2>🔗 Quick Links</h2>
            <div class="nav-links">
                <a href="{{ route('home') }}">Home</a>
                <a href="/test-permissions">Test Permissions</a>

                @can('view users')
                    <a href="#">Manage Users</a>
                @endcan

                @can('view roles')
                    <a href="#">Manage Roles</a>
                @endcan
            </div>
        </div>
    </div>
</body>
</html>
