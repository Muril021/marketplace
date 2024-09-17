<?php

namespace App\Http\Controllers;

use App\DataTables\SubcategoryDataTable;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Str;

class AdminSubcategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(SubcategoryDataTable $dataTable)
  {
    return $dataTable->render('admin.subcategory.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $categories = Category::all();

    return view('admin.subcategory.create', compact('categories'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    // dd($request->all());
    $request->validate([
      'category_id' => ['required'],
      'name' => ['required', 'unique:subcategories,name', 'max:200'],
      'status' => ['required']
    ]);

    $subcategory = new Subcategory;

    $subcategory->category_id = $request->category_id;
    $subcategory->name = $request->name;
    $subcategory->status = $request->status;
    $subcategory->slug = Str::slug($request->name);
    $subcategory->save();

    toastr('Cadastrado com sucesso', 'success');
    return redirect()->route('subcategory.index');
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
    $categories = Category::all();
    $subcategory = Subcategory::findOrFail($id);

    return view('admin.subcategory.edit', compact('subcategory', 'categories'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    // dd($request->all());
    $request->validate([
      'category_id' => ['required'],
      'name' => ['required', 'unique:subcategories,name,'.$id, 'max:200'],
      'status' => ['required']
    ]);

    $subcategory = Subcategory::findOrFail($id);

    $subcategory->category_id = $request->category_id;
    $subcategory->name = $request->name;
    $subcategory->status = $request->status;
    $subcategory->slug = Str::slug($request->name);
    $subcategory->save();

    toastr('Atualizado com sucesso', 'success');
    return redirect()->route('subcategory.index');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $subcategory = Subcategory::findOrFail($id);
    $subcategory->delete();

    return response([
      'status' => 'success',
      'message' => 'Excluído com sucesso.'
    ]);
  }

  public function changeStatus(Request $request)
  {
    $subcategory = Subcategory::findOrFail($request->id);

    $subcategory->status = $request->status == 'true' ? 1 : 0;
    $subcategory->save();

    return response([
      'message' => 'Status atualizado com sucesso.'
    ]);
  }
}