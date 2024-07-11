<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

foreach (
  File::allFiles(__DIR__.'/web') as
  $route_file
) {
  require $route_file->getPathname();
}

require __DIR__.'/auth.php';

Route::get('/admin/login', [
  AdminController::class,
  'login'
  ])->name('admin.login');
