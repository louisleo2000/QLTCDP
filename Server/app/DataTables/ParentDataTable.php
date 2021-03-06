<?php

namespace App\DataTables;

use App\Models\Parents;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ParentDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query->with('user'))

            ->addColumn('image', function ($parent) {
                if ($parent->img) {
                    return '<img  src="' . $parent->img . '" width="100px" height="100px" style="object-fit: cover;">';
                } else {
                    return '<img src="https://via.placeholder.com/100x100" width="100px" height="100px">';
                }
            })
            ->editColumn('created_at', function ($customer) {
                if ($customer->created_at) {
                    return $customer->created_at->format('d/m/Y H:i:s');
                }
            })
            ->editColumn('updated_at', function ($customer) {
                if ($customer->updated_at) {
                    return $customer->updated_at->format('d/m/Y H:i:s');
                }
            })
            ->setRowId('id')
            ->rawColumns(['image']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Parents $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Parents $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('parent-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create')->editor('editor'),
                Button::make('edit')->editor('editor'),
                Button::make('remove')->editor('editor'),
                Button::make('print')->text('In'),
                Button::make('colvis')->text('C???t'),
                [
                    'extend' => 'csv',
                    'split' => ['pdf', 'excel'],
                    // 'className' => 'bg-warning',
                ]
            )
            ->select('single')
            ->language(config('app.datatableLanguage'));
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('image')->title('???nh'),
            Column::make('user.name')->title('H??? v?? t??n'),
            Column::make('user.email')->title('Email'),
            Column::make('gender')->title('Gi???i t??nh')->className('text-center text-uppercase'),
            Column::make('tel')->title('??i???n tho???i')->defaultContent('Ch??a c???p nh???t'),
            Column::make('citizen_id')->title('CCCD/CMND')->defaultContent('Ch??a c???p nh???t'),
            Column::make('adress')->title('?????a ch???')->defaultContent('Ch??a c???p nh???t'),
            Column::make('created_at')->title('Ng??y t???o')->defaultContent('Ch??a c???p nh???t'),
            Column::make('updated_at')->title('Ng??y c???p nh???t')->defaultContent('Ch??a c???p nh???t'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Parent_' . date('YmdHis');
    }
}
