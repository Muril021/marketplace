<?php

use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'vendor'])
->prefix('/vendor')
->group(function () {
  Route::get('/dashboard', [
    VendorController::class,
    'dashboard'
  ])->name('vendor.dashboard');
});
