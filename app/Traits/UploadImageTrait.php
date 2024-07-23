<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait UploadImageTrait
{
  public function uploadImage(
    Request $request,
    $inputName,
    $path
  )
  {
    if ($request->hasFile($inputName)) {
      $image = $request->{$inputName};
      $extension = $image->getClientOriginalExtension();
      $day = date('d');
      $month = date('m');
      $year = date('Y');
      $imageName = uniqid().$day.'-'.$month.'-'.$year.'.'.$extension;
      $image->move(public_path($path), $imageName);

      return $path.'/'.$imageName;
    }
  }
}
