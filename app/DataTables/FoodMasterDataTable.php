<?php

namespace App\DataTables;

use App\Models\FoodMaster;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FoodMasterDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', 'food_master.action')
        ->editColumn('serves', function($data){
          return $data->serves.' People';
        })
        ->editColumn('thumbnail', function ($data) {
          if($data->thumbnail){
            return "<img class='rounded' style='width:50px' src='" . asset($data->thumbnail) . "' alt='thumb'>";
          }elseif($data->image){
            return "<img style='width:50px' src='" . asset($data->image) . "' alt='thumb'>";
          }else{
            return '';
          }
        })
        ->rawColumns(['status','action','thumbnail'])
        ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(FoodMaster $model): QueryBuilder
    {
        return $model->newQuery()
        ->select('food_masters.*', 'food_categories.name as category')
        ->join('food_categories', 'food_masters.category_id', '=', 'food_categories.id');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('foodmaster-table')
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
          Column::make('name')->title('item'),
          Column::make('category')->title('Category'),
          Column::make('price'),
          Column::make('serves'),
          Column::make('thumbnail')->width('15%')->orderable(false)->addClass('text-center')->defaultContent(''),
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
        return 'FoodMaster_' . date('YmdHis');
    }
}
