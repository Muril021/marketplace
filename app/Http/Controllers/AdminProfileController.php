<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

class AdminProfileController extends Controller
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
      ],
      'image' => ['image', 'max:2048']
    ]);

    $user = Auth::user();

    if ($request->hasFile('image')) {
      // verifica se a imagem existe e apaga
      if (File::exists(public_path($user->image))) {
        File::delete(public_path($user->image));
      }

      $image = $request->image;
      $imageName = rand().$image->getClientOriginalName();
      $image->move(public_path('uploads'), $imageName);

      $path = "/uploads/".$imageName;

      $user->image = $path;
    }

    $user->name = $request->name;
    $user->email = $request->email;
    $user->save();

    return redirect()->back()->with(
      'success',
      'Dados atualizados com sucesso.'
    );
  }

  public function updatePassword(Request $request)
  {
    // dd($request->all());
    $request->validate([
      'current_password' => ['required', 'current_password'],
      'password' => ['required', 'confirmed', 'min:8']
    ]);

    $request->user()->update([
      'password' => bcrypt($request->password)
    ]);

    return redirect()->back()->with(
      'success',
      'Senha alterada com sucesso.'
    );
  }
}
