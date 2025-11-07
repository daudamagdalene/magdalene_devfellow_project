<!DOCTYPE html>
<html>
<head>
    <title>Permission Test</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .success { color: green; }
        .fail { color: red; }
        ul { list-style: none; }
    </style>
</head>
<body>
    <h1>Permission Testing for {{ $user->name }}</h1>

    <h2>Roles:</h2>
    <ul>
        @foreach($roles as $role)
            <li>✓ {{ $role }}</li>
        @endforeach
    </ul>

    <h2>All Permissions ({{ $permissions->count() }}):</h2>
    <ul>
        @foreach($permissions as $permission)
            <li>✓ {{ $permission }}</li>
        @endforeach
    </ul>

    <h2>Permission Checks:</h2>
    <ul>
        <li class="{{ auth()->user()->can('view users') ? 'success' : 'fail' }}">
            {{ auth()->user()->can('view users') ? '✅' : '❌' }} View Users
        </li>
        <li class="{{ auth()->user()->can('create users') ? 'success' : 'fail' }}">
            {{ auth()->user()->can('create users') ? '✅' : '❌' }} Create Users
        </li>
        <li class="{{ auth()->user()->can('edit users') ? 'success' : 'fail' }}">
            {{ auth()->user()->can('edit users') ? '✅' : '❌' }} Edit Users
        </li>
        <li class="{{ auth()->user()->can('delete users') ? 'success' : 'fail' }}">
            {{ auth()->user()->can('delete users') ? '✅' : '❌' }} Delete Users
        </li>
    </ul>

    @role('Super Admin')
        <div style="background: #d4edda; padding: 10px; margin: 20px 0;">
            <strong>🔑 You have Super Admin access!</strong>
        </div>
    @endrole
</body>
</html>
