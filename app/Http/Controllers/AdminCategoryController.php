<?php

namespace App\Http\Controllers;

use App\DataTables\CategoryDataTable;
use App\Models\Category;
use Illuminate\Http\Request;
use Str;

class AdminCategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(CategoryDataTable $dataTable)
  {
    return $dataTable->render('admin.category.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('admin.category.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    // dd($request->all());
    $request->validate([
      'icon' => ['required', 'not_in:empty'],
      'name' => ['required', 'unique:categories,name', 'max:200'],
      'status' => ['required']
    ]);

    $category = new Category;

    $category->icon = $request->icon;
    $category->name = $request->name;
    $category->status = $request->status;
    $category->slug = Str::slug($request->name);

    $category->save();

    toastr('Cadastrado com sucesso.', 'success');
    return redirect()->route('category.index');
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
    $category = Category::findOrFail($id);

    return view('admin.category.edit', compact('category'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    // dd($request->all());
    $request->validate([
      'icon' => ['required', 'not_in:empty'],
      'name' => ['required', 'unique:categories,name,'.$id, 'max:200'],
      'status' => ['required']
    ]);

    $category = Category::findOrFail($id);

    $category->icon = $request->icon;
    $category->name = $request->name;
    $category->status = $request->status;
    $category->slug = Str::slug($request->name);
    $category->save();

    toastr('Atualizado com sucesso.', 'success');
    return redirect()->route('category.index');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
      //
  }
}
