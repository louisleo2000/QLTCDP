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
            ->eloquent($query)
            ->addColumn('name', function ($schedule) {
                return $schedule->vaccine->name;
            })
            ->editColumn('created_at', function ($schedule) {
                return $schedule->created_at->format('d/m/Y');
            })
            ->editColumn('updated_at', function ($schedule) {
                return $schedule->updated_at->format('d/m/Y');
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
                Button::make('export'),
                Button::make('print'),
                // Button::make('reset'),
                // Button::make('reload')
            )
            ->select('id', 'name', 'status', 'date_time', 'created_at', 'updated_at')
            ->orderBy(3,'asc')
            ->language([
                "decimal" => "",
                "emptyTable" => "Không có dữ liệu phù hợp",
                "info" => "Đang xem từ _START_ đến _END_ trên tổng _TOTAL_ ",
                "infoEmpty" => "Đang xem từ 0 đến 0 trên tổng 0 ",
                "infoFiltered" => "(lọc trong _MAX_ total)",
                "infoPostFix" => "",
                "thousands" => ",",
                "lengthMenu" => "Hiển thị _MENU_ ",
                "loadingRecords" => "Đang tải...",
                "processing" => "Đang xử lý...",
                "search" => "Tìm kiếm:",
                "zeroRecords" => "Không tìm thấy dữ liệu phù hợp",
                "paginate" => [
                    "first" => "Đầu tiên",
                    "last" => "Cuối",
                    "next" => "▶",
                    "previous" => "◀"
                ],
                "aria" => [
                    "sortAscending" => "=> sắp xếp tăng dần",
                    "sortDescending" => "=> sắp xép giảm dần"
                ]
            ]);
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
            Column::make('id')->addClass('text-center')->width(60),
            Column::make('name')->title('Tên Vắc-xin')->addClass('text-center'),
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
