<?php

namespace App\DataTables;

use App\Models\Child;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ChildrentDataTable extends DataTable
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
            ->eloquent($query->with('parent','user'))
            ->setRowId('id')
            ->addColumn('c_img', function ($parent) {
                if ($parent->img) {
                    return '<img  src="' . $parent->img . '" width="100px" height="100px" style="object-fit: cover;">';
                } else {
                    return '<img src="https://via.placeholder.com/100x100" width="100px" height="100px">';
                }
            })
            ->editColumn('height', function ($parent) {
                return $parent->height . ' cm';
            })
            ->editColumn('weight', function ($parent) {
                return $parent->weight . ' kg';
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
            ->rawColumns(['c_img']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Child $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Child $model)
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
                    ->setTableId('childrent-table')
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
                    ->select('os')
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
            Column::make('id')->className('text-center'),
            Column::make('c_img')->title('Ảnh'),
            Column::make('name')->title('Họ tên'),
            Column::make('user.email')->title('Email phụ huynh'),
            Column::make('dob')->title('Ngày sinh')->className('text-center'),
            Column::make('gender')->title('Giới tính'),
            Column::make('health_nsurance_id')->title('Số bảo hiểm y tế'),
            Column::make('height')->title('Chiều cao')->className('text-center'),
            Column::make('weight')->title('Cân nặng')->className('text-center'),
            Column::make('created_at')->title('Ngày tạo')->className('text-center'),
            Column::make('updated_at')->title('Ngày cập nhật')->className('text-center'),
            // Column::make('img')->searchable(true)->visible(false)->title(''),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Childrent_' . date('YmdHis');
    }
}
