<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;



Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Dashboard route for Super Admin
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'role:Super Admin'])
    ->name('dashboard');

// Admin-only route
Route::get('/admin', function () {
    return 'Welcome Admin!';
})->middleware(['auth', 'role:Super Admin|admin']);

// Editor or Admin route
Route::get('/editor', function () {
    return 'Welcome Editor!';
})->middleware(['auth', 'role:Super Admin|editor|admin']);


//test route
Route::get('/test-permissions', function () {
    $user = auth()->user();

    if (!$user) {
        return redirect('/login');
    }

    return view('test-permissions', [
        'user' => $user,
        'roles' => $user->getRoleNames(),
        'permissions' => $user->getAllPermissions()->pluck('name'),
    ]);
})->middleware('auth');
