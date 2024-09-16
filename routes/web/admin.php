<?php

use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminMicrocategoryController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AdminSliderController;
use App\Http\Controllers\AdminSubcategoryController;
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

  // mudar status category
  Route::put(
    'category/change-status',
    [AdminCategoryController::class, 'changeStatus']
  )->name('admin.category.change-status');
  Route::resource(
    '/category',
    AdminCategoryController::class
  );

  // mudar status subcategory
  Route::put(
    'subcategory/change-status',
    [AdminSubcategoryController::class, 'changeStatus']
  )->name('admin.subcategory.change-status');
  Route::resource(
    '/subcategory',
    AdminSubcategoryController::class
  );

  // mudar status microcategory
  Route::put(
    'microcategory/change-status',
    [AdminMicrocategoryController::class, 'changeStatus']
  )->name('admin.microcategory.change-status');
  Route::get(
    'get-subcategories',
    [AdminMicrocategoryController::class, 'getSubcategories']
  )->name('admin.microcategory.get-subcategories');
  Route::resource(
    '/microcategory',
    AdminMicrocategoryController::class
  );
});
