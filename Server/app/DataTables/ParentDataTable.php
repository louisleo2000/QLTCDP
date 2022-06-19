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
                    return '<img  src="' . $parent->img . '" width="100px" height="100px" style="object-fit: contain;">';
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
                Button::make('colvis')->text('Cột'),
                [
                    'extend' => 'csv',
                    'split' => ['pdf', 'excel'],
                    // 'className' => 'bg-warning',
                ]
            )
            ->select('id', 'name', 'img', 'created_at', 'updated_at')
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
            Column::make('image')->title('Ảnh'),
            Column::make('user.name')->title('Họ và tên'),
            Column::make('gender')->title('Giới tính')->className('text-center text-uppercase'),
            Column::make('tel')->title('Điện thoại')->defaultContent('Chưa cập nhật'),
            Column::make('citizen_id')->title('CCCD/CMND')->defaultContent('Chưa cập nhật'),
            Column::make('adress')->title('Địa chỉ')->defaultContent('Chưa cập nhật'),
            Column::make('created_at')->title('Ngày tạo')->defaultContent('Chưa cập nhật'),
            Column::make('updated_at')->title('Ngày cập nhật')->defaultContent('Chưa cập nhật'),
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
