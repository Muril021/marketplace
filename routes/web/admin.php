<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])
->prefix('/admin')
->group(function () {
  Route::get('/dashboard', [
    AdminController::class,
    'dashboard'
  ])->name('admin.dashboard');
});
