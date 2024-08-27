<?php

namespace App\Http\Controllers;

use App\DataTables\SubCategoryDataTable;
use Illuminate\Http\Request;

class AdminSubCategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(SubCategoryDataTable $dataTable)
  {
    return $dataTable->render('admin.subcategory.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('admin.subcategory.create');
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
  public function show(string $id)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    return view('admin.subcategory.edit');
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
