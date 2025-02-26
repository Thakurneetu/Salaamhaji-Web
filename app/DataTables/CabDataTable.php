<?php

namespace App\DataTables;

use App\Models\Cab;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CabDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', 'cab.action')
        ->editColumn('icon', function ($cab) {
          if($cab->icon) {
            return "<img style='width:50px' src='" . asset($cab->icon) . "' alt='Icon'>";
          }
          return '';
        })
        ->rawColumns(['status','action','icon'])
        ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Cab $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('cab-table')
                    ->columns($this->getColumns())
                    ->responsive(true)
                    ->orderBy([0,'desc'])
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('create'),
                        Button::make('export'),
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
        Column::make('id')->visible(false),
        Column::make('DT_RowIndex')->title('Sl No.')->width(50)->addClass('text-center')->sortable(false)->searchable(false),
        Column::make('type')->title('CAB Type'),
        Column::make('seats'),
        Column::make('icon')->width('15%')->orderable(false)->defaultContent(''),
        Column::computed('action')
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
        return 'Cab_' . date('YmdHis');
    }
}
