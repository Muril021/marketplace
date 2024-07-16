<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
  public function index()
  {
    return view('admin.profile.index');
  }

  public function update(Request $request)
  {
    // dd($request->all());
    $request->validate([
      'name' => ['required', 'max:100'],
      'email' => [
        'required',
        'email',
        'unique:users,email,'.Auth::user()->id
      ]
    ]);

    $user = Auth::user();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->save();

    return redirect()->back()->with(
      'success',
      'Dados atualizados com sucesso.'
    );
  }
}
