<?php

namespace App\DataTables;

use App\Models\VendorLaundryService;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorLaundryServiceDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', 'vendor_laundry_service.action')
        ->rawColumns(['status','action'])
        ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(VendorLaundryService $model): QueryBuilder
    {
        return $model->newQuery()
        ->select('vendor_laundry_services.*', 'loundry_categories.name as category')
        ->join('loundry_categories', 'vendor_laundry_services.category_id', '=', 'loundry_categories.id')
        ->where('vendor_id', $this->id);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('vendorlaundryservice-table')
                    ->columns($this->getColumns())
                    ->responsive(true)
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
          Column::make('DT_RowIndex')->title('Sl No.')->width(50)->addClass('text-center')->sortable(false)->searchable(false),
          Column::make('name'),
          Column::make('category')->title('Category'),
          Column::make('price'),
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
        return 'VendorLaundryService_' . date('YmdHis');
    }
}
