<?php

namespace App\Http\Controllers;

use App\DataTables\MicrocategoryDataTable;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class AdminMicrocategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(MicrocategoryDataTable $dataTable)
  {
    return $dataTable->render('admin.microcategory.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $categories = Category::all();

    return view('admin.microcategory.create', compact('categories'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
      //
  }

  /**
   * Display the specified resource.
   */
  public function getSubcategories(Request $request)
  {
    $subcategories = Subcategory::where('category_id', $request->id)
      ->where('status', 1)
      ->get();

    return $subcategories;
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
      //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
      //
  }
}
