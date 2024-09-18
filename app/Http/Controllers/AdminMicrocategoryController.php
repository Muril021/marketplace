<?php

namespace App\Http\Controllers;

use App\DataTables\MicrocategoryDataTable;
use App\Models\Category;
use App\Models\Microcategory;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Str;

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
    // dd($request->all());
    $request->validate([
      'category_id' => ['required'],
      'subcategory_id' => ['required'],
      'name' => ['required', 'max:200', 'unique:microcategories,name'],
      'status' => ['required'],
    ]);

    $microcategory = new Microcategory;

    $microcategory->category_id = $request->category_id;
    $microcategory->subcategory_id = $request->subcategory_id;
    $microcategory->name = $request->name;
    $microcategory->slug = Str::slug($request->name);
    $microcategory->status = $request->status;
    $microcategory->save();

    toastr('Cadastrado com sucesso.', 'success');
    return redirect()->route('microcategory.index');
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

  public function changeStatus(Request $request)
  {
    $microcategory = Microcategory::findOrFail($request->id);

    $microcategory->status = $request->status == 'true' ? 1 : 0;
    $microcategory->save();

    return response([
      'message' => 'Status atualizado com sucesso.'
    ]);
  }
}
