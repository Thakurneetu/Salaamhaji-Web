<?php

namespace App\DataTables;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrdersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
      return (new EloquentDataTable($query))
        ->addColumn('action', 'order.action')
        ->rawColumns(['status','action'])
        ->editColumn('created_at', function($data){
          return date('d/m/Y', strtotime($data->created_at));
        })
        ->editColumn('service_date', function($data){
          return $data->service_date != '' ? date('d/m/Y', strtotime($data->service_date)) : '';
        })
        ->editColumn('slot', function($data){
          return $data->start != '' ? date('H:i', strtotime($data->start)).'-'.date('H:i', strtotime($data->end)) : '';
        })
        ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
        return $model->newQuery()
        // ->select('orders.*', 
        //   'customers.name as customer_name', 
        //   'customers.email as email',
        //   'customers.phone as phone'
        // )
        // ->join('customers', 'orders.customer_id', '=', 'customers.id')
        ->where('type', $this->type)
        ->with('customer:id,name,email,phone');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('orders-table')
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
        $columns = [
          Column::make('id')->visible(false),
          Column::make('DT_RowIndex')->title('Sl No.')->width(50)->addClass('text-center')->sortable(false)->searchable(false),
          Column::make('uuid')->title('Order ID'),
          Column::make('customer.name')->title('Customer')->sortable(true),
          Column::make('customer.email')->sortable(true),
          Column::make('customer.phone')->sortable(true),
          Column::make('created_at')->title('Order Date'),
          Column::make('service_date')->title('Service Date'),
          Column::make('slot')->title('Time Slot')->sortable(false)->searchable(false),
          Column::make('status'),
          Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')
        ];

        return $columns;
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Orders_' . date('YmdHis');
    }
}
