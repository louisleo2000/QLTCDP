<?php

namespace App\DataTables;

use App\Models\Schedule;
use App\Models\Vaccine;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ScheduleDataTable extends DataTable
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
            ->eloquent($query->with('vaccine'))
            // ->addColumn('name', function ($schedule) {
            //     return $schedule->vaccine->name;
            // })
          
            ->editColumn('created_at', function ($schedule) {
                return $schedule->created_at->format('d-m-Y H:i:s');
            })
            ->editColumn('updated_at', function ($schedule) {
                return $schedule->updated_at->format('d-m-Y H:i:s');
            })
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Schedule $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Schedule $model)
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
            ->setTableId('schedule-table')
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
            ->orderBy(2,'asc')
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
            // Column::computed('action')
            //       ->exportable(false)
            //       ->printable(false)
            //       ->width(60)
            //       ->addClass('text-center'),
            // Column::make('id')->addClass('text-center')->width(60),  
            Column::make('vaccine.name')->title('Tên Vắc-xin')->addClass('text-center'),
            Column::make('status')->title('Trạng thái')->addClass('text-center'),
            Column::make('date_time')->title('Thời gian')->addClass('text-center'),
            Column::make('created_at')->title('Ngày tạo')->addClass('text-center'),
            Column::make('updated_at')->title('Ngày sửa')->addClass('text-center'),
            // Column::make('vaccine')->title('vaccine')->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Schedule_' . date('YmdHis');
    }
}
