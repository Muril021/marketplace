<?php

namespace App\Http\Controllers;

use App\DataTables\SliderDataTable;
use App\Models\Slider;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;

use function Termwind\render;

class AdminSliderController extends Controller
{
  use UploadImageTrait;
  /**
   * Display a listing of the resource.
   */
  public function index(SliderDataTable $dataTable)
  {
    // return view('admin.slider.index');
    return $dataTable->render('admin.slider.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('admin.slider.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    // dd($request->all());
    $request->validate([
      'banner' => ['required', 'image', 'max:2048'],
      'title_one' => ['required', 'string', 'max:200'],
      'title_two' => ['required', 'max:200'],
      'starting_price' => ['max:200'],
      'link' => ['url'],
      'serial' => ['required', 'integer'],
      'status' => ['required']
    ]);

    $slider = new Slider;

    $imagePath = $this->uploadImage($request, 'banner', 'uploads');

    $slider->banner = $imagePath;
    $slider->title_one = $request->title_one;
    $slider->title_two = $request->title_two;
    $slider->starting_price = $request->starting_price;
    $slider->link = $request->link;
    $slider->serial = $request->serial;
    $slider->status = $request->status;
    $slider->save();

    toastr()->success('Cadastrado com sucesso.');
    return redirect()->route('slider.index');
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $slider = Slider::findOrFail($id);

    return view('admin.slider.edit', compact('slider'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    // dd($request->all());
    $request->validate([
      'banner' => ['nullable', 'image', 'max:2048'],
      'title_one' => ['required', 'string', 'max:200'],
      'title_two' => ['required', 'max:200'],
      'starting_price' => ['max:200'],
      'link' => ['url'],
      'serial' => ['required', 'integer'],
      'status' => ['required']
    ]);

    $slider = Slider::findOrFail($id);

    $imagePath = $this->updateImage(
      $request, 'banner', 'uploads', $slider->banner
    );

    $slider->banner = empty(!$imagePath) ?
      $imagePath : $slider->banner;
    $slider->title_one = $request->title_one;
    $slider->title_two = $request->title_two;
    $slider->starting_price = $request->starting_price;
    $slider->link = $request->link;
    $slider->serial = $request->serial;
    $slider->status = $request->status;
    $slider->save();

    toastr('Atualizado com sucesso.', 'success');
    return redirect()->route('slider.index');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $slider = Slider::findOrFail($id);
    $this->deleteImage($slider->banner);
    $slider->delete();

    return response([
      'status' => 'success',
      'message' => 'Excluído com sucesso.'
    ]);
  }
}
