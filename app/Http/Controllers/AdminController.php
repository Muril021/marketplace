<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
  public function dashboard()
  {
    return view('admin.dashboard');
  }

  public function login()
  {
    return view('admin.auth.login');
  }
}
