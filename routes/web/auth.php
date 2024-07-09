<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])
->get('/dashboard',function () {
  return view('dashboard');
})->name('dashboard');

Route::middleware('auth')
->prefix('/profile')
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
});
