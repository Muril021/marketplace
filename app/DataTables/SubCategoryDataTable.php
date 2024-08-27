<?php

namespace App\DataTables;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SubCategoryDataTable extends DataTable
{
  /**
   * Build the DataTable class.
   *
   * @param QueryBuilder $query Results from query() method.
   */
  public function dataTable(QueryBuilder $query): EloquentDataTable
  {
    return (new EloquentDataTable($query))
    ->addColumn('ações', function ($query) {
      $edit = "<div class='d-flex justify-content-center'>
      <a
        href='".route('category.edit', $query->id)."'
        class='btn btn-primary mr-2'
      >
        <i class='far fa-edit'></i>
      </a>";

      $delete = "<a
        href='".route('category.destroy', $query->id)."'
        class='btn btn-danger delete-item'
      >
        <i class='far fa-trash-alt'></i>
      </a></div>";

      return $edit.$delete;
    })
    ->addColumn('icon', function ($query) {
      return "<i class='".$query->icon."' style='font-size: 18px;'></i>";
    })
    ->addColumn('status', function ($query) {

      $checkedButton = '<label class="custom-switch mt-2">
        <input type="checkbox" name="custom-switch-checkbox" data-id="'.$query->id.'"
          class="custom-switch-input change-status" checked
        >
        <span class="custom-switch-indicator"></span>
      </label>';

      $uncheckedButton = '<label class="custom-switch mt-2">
        <input type="checkbox" name="custom-switch-checkbox" data-id="'.$query->id.'"
          class="custom-switch-input change-status"
        >
        <span class="custom-switch-indicator"></span>
      </label>';

      return $query->status == 1 ? $checkedButton : $uncheckedButton;
    })
    ->rawColumns(['icon', 'name', 'status', 'ações'])
    ->setRowId('id');
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(SubCategory $model): QueryBuilder
  {
    return $model->newQuery();
  }

  /**
   * Optional method if you want to use the html builder.
   */
  public function html(): HtmlBuilder
  {
    return $this->builder()
    ->setTableId('category-table')
    ->columns($this->getColumns())
    ->minifiedAjax()
    //->dom('Bfrtip')
    ->orderBy(1)
    ->selectStyleSingle()
    ->language([
      'url' => asset('backend/assets/traducao-datatable-brasil/pt-BR.json')
    ])
    ->buttons([
      Button::make('excel'),
      Button::make('csv'),
      Button::make('pdf'),
      Button::make('print'),
      Button::make('reset'),
      Button::make('reload')
    ]);
  }

  /**
   * Get the dataTable columns definition.
   */
  public function getColumns(): array
  {
    return [
      Column::make('id'),
      Column::make('icon'),
      Column::make('name'),
      Column::make('status'),
      Column::computed('ações')
        ->exportable(false)
        ->printable(false)
        ->width(60)
        ->addClass('text-center'),
    ];
  }

  /**
   * Get the filename for export.
   */
  protected function filename(): string
  {
    return 'Category_' . date('YmdHis');
  }
}
