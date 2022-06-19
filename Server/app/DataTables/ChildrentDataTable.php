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
            ->eloquent($query)
            ->setRowId('id');
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
            Column::make('name')->title('Họ tên'),
            Column::make('dob')->title('Ngày sinh'),
            Column::make('created_at')->title('Ngày tạo'),
            Column::make('updated_at')->title('Ngày cập nhật'),
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
