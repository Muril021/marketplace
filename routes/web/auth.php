<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard',function () {
  return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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
