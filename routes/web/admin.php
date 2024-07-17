<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])
->prefix('/admin')
->group(function () {
  Route::get('/dashboard', [
    AdminController::class,
    'dashboard'
  ])->name('admin.dashboard');

  Route::get('/profile', [
    ProfileController::class,
    'index'
  ])->name('admin.profile');

  Route::post('/profile/update', [
    ProfileController::class,
    'update'
  ])->name('admin.profile.update');

  Route::post('/profile/update_password', [
    ProfileController::class,
    'updatePassword'
  ])->name('admin.profile.password');
});
