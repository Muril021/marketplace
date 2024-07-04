<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard',function () {
  return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('/profile')
->group(function () {
  Route::get('', [
    ProfileController::class,
    'edit'
  ])->name('profile.edit');

  Route::patch('', [
    ProfileController::class,
    'update'
  ])->name('profile.update');

  Route::delete('', [
    ProfileController::class,
    'destroy'
  ])->name('profile.destroy');
})->middleware('auth');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'admin'])
->prefix('/admin')
->group(function () {
  Route::get('/dashboard', [
    AdminController::class,
    'dashboard'
  ])->name('admin.dashboard');
});

Route::middleware(['auth', 'vendor'])
->prefix('/vendor')
->group(function () {
  Route::get('/dashboard', [
    VendorController::class,
    'dashboard'
  ])->name('vendor.dashboard');
});
