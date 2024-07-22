<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AdminSliderController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])
->prefix('/admin')
->group(function () {
  Route::get('/dashboard', [
    AdminController::class,
    'dashboard'
  ])->name('admin.dashboard');

  Route::get('/profile', [
    AdminProfileController::class,
    'index'
  ])->name('admin.profile');

  Route::post('/profile/update', [
    AdminProfileController::class,
    'update'
  ])->name('admin.profile.update');

  Route::post('/profile/update_password', [
    AdminProfileController::class,
    'updatePassword'
  ])->name('admin.profile.password');

  Route::resource(
    '/slider',
    AdminSliderController::class
  );
});
