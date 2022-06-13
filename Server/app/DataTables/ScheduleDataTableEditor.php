<?php

namespace App\DataTables;

use App\Models\Schedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTablesEditor;

class ScheduleDataTableEditor extends DataTablesEditor
{
    protected $model = Schedule::class;

    /**
     * Get create action validation rules.
     *
     * @return array
     */
    public function createRules()
    {
        return [
            'vaccine_id' => 'required',
            'status'  => 'required',
        ];
    }

    /**
     * Get edit action validation rules.
     *
     * @param Model $model
     * @return array
     */
    public function editRules(Model $model)
    {
        return [
            'vaccine_id' => 'required',
            'status'  => 'required',
            'date_time' => 'required',
        ];
    }

    /**
     * Get remove action validation rules.
     *
     * @param Model $model
     * @return array
     */
    public function removeRules(Model $model)
    {
        return [];
    }
     /**
     * Get remove action validation rules.
     *
     * @param Model $model
     * @return array
     */
    public function creating(Model $model, array $data)
    {
        $model->vaccine_id = $data['vaccine_id'];
        $model->status = $data['status'];

        return $data;
    }
 
}
