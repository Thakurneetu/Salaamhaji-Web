<?php

namespace App\DataTables;

use App\Models\Vendor;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('status', 'layouts.includes.status')
            ->addColumn('action', 'vendors.action')
            ->rawColumns(['action','status'])
            ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Vendor $model): QueryBuilder
    {
        return $model->newQuery()
        ->select('vendors.*', 'countries.name as country_name', 
        DB::raw("CONCAT(vendors.address1,', ',vendors.address2,', ',vendors.city,', ',vendors.state,', ',countries.name) as address"))
        ->join('countries', 'vendors.country_id', '=', 'countries.id');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('vendors-table')
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
          Column::make('name'),
          Column::make('phone'),
          Column::make('email'),
          Column::make('services'),
          Column::make('address')->title('Address'),
          Column::make('status')
                ->exportable(false)
                ->printable(false)
                ->width('5%')
                ->addClass('text-center'),
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
        return 'Vendors_' . date('YmdHis');
    }
}
