<?php

namespace App\DataTables;

use App\Models\Vaccine;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VaccineDataTable extends DataTable
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
            ->setRowId('id')
            ->editColumn('age_distance', function ($vaccine) {
                return $vaccine->age_distance . ' ' . $vaccine->age_type;
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
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Vaccine $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Vaccine $model)
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
            ->setTableId('vaccine-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
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
            Column::make('id')->className('text-center'),
            Column::make('name')->title('Tên Vaccine'),
            Column::make('age_distance')->title('Độ tuổi')->className('text-center'),
            Column::make('description')->title('Mô tả')->className('text-wrap'),
            Column::make('created_at')->title('Ngày tạo')->className('text-center'),
            Column::make('updated_at')->title('Ngày cập nhật')->className('text-center'),
            Column::make('age_type')->searchable(true)->visible(false)->title(''),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Vaccine_' . date('YmdHis');
    }
}
