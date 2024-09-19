<?php

namespace App\DataTables;

use App\Models\Microcategory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MicrocategoryDataTable extends DataTable
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
        href='".route('microcategory.edit', $query->id)."'
        class='btn btn-primary mr-2'
      >
        <i class='far fa-edit'></i>
      </a>";

      $delete = "<a
        href='".route('subcategory.destroy', $query->id)."'
        class='btn btn-danger delete-item'
      >
        <i class='far fa-trash-alt'></i>
      </a></div>";

      return $edit.$delete;
    })
    ->addColumn('nome', function ($query) {
      return $query->name;
    })
    ->addColumn('categoria', function ($query) {
      return $query->category ? $query->category->name : null;
    })
    ->addColumn('subcategoria', function ($query) {
      return $query->subcategory ? $query->subcategory->name : null;
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
    ->rawColumns(['nome', 'categoria', 'subcategoria', 'status', 'ações'])
    ->setRowId('id');
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(Microcategory $model): QueryBuilder
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
      Column::make('nome'),
      Column::make('categoria'),
      Column::make('subcategoria'),
      Column::make('status'),
      Column::computed('ações')
        ->exportable(false)
        ->printable(false)
        ->width(200)
        ->addClass('text-center'),
    ];
  }

  /**
   * Get the filename for export.
   */
  protected function filename(): string
  {
    return 'Microcategory_' . date('YmdHis');
  }
}
