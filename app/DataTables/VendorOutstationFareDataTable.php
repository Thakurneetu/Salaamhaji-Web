<?php

namespace App\DataTables;

use App\Models\VendorOutstation;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorOutstationFareDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', 'vendor_fares.outstation_fare.action')
        ->editColumn('fares', function ($outstation) {
          $price = '';
          foreach ($outstation->fares as $key => $fare) {
            $price.= $fare->cab->type.': '.$fare->price;
            if($key+1 < count($outstation->fares)){
              $price.= ', ';
            }
          }
          return $price;
        })
        ->rawColumns(['action', 'fares'])
        ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(VendorOutstation $model): QueryBuilder
    {
        return $model->newQuery()->where('vendor_id', $this->id)->with('origin:id,name','destination:id,name');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('outstation-table')
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
        Column::make('DT_RowIndex')->title('Sl No.')->width('8%')->addClass('text-center')->sortable(false)->searchable(false),
        Column::make('origin.name')->title('Origin')->width('25%')->sortable(false),
        Column::make('destination.name')->title('Destination')->width('25%')->sortable(false),
        Column::make('fares')->width('32%')->sortable(false)->searchable(false),
        Column::computed('action')
              ->exportable(false)
              ->printable(false)
              ->width('10%')
              ->addClass('text-center'),
      ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Outstation_' . date('YmdHis');
    }
}
