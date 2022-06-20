<?php

namespace App\DataTables;

use App\Models\VaccinationDetails;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VaccinationDetailsDataTable extends DataTable
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
            ->eloquent($query->with('medicalStaff', 'vaccine', 'child', 'user'))
            ->setrowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\VaccinationDetail $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(VaccinationDetails $model)
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
            ->setTableId('vaccinationdetails-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            // ->orderBy(1)
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
            Column::make('id')->className('text-center'),
            Column::make('child.id')->title('ID trẻ')->className('text-center'),
            Column::make('child.health_nsurance_id')->title('Số bảo hiểm y tế')->className('text-center'),
            Column::make('child.name')->title('Tên trẻ')->className('text-center'),
            Column::make('user.name')->title('Nhân viên y tế')->className('text-center'),
            Column::make('vaccine.name')->title('Tên vaccine')->className('text-center'),
            Column::make('lot_number')->title('Số lô')->className('text-center'),
            Column::make('number_injections')->title('Số lượt điều trị')->className('text-center'),
            Column::make('created_at')->title('Ngày điều trị')->className('text-center'),
            Column::make('updated_at')->title('Ngày cập nhật')->className('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'VaccinationDetails_' . date('YmdHis');
    }
}
