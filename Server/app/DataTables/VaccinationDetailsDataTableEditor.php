<?php

namespace App\DataTables;

use App\Models\VaccinationDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTablesEditor;

class VaccinationDetailsDataTableEditor extends DataTablesEditor
{
    protected $model = VaccinationDetails::class;

    /**
     * Get create action validation rules.
     *
     * @return array
     */
    public function createRules()
    {
        return [
            // 'email' => 'required|email|unique:' . $this->resolveModel()->getTable(),
            // 'name'  => 'required',
        ];
    }
    public function creating(Model $model, array $data)
    {

        $model->staff_id = Auth::user()->info->id;
        return $data;
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
            // 'email' => 'sometimes|required|email|' . Rule::unique($model->getTable())->ignore($model->getKey()),
            // 'name'  => 'sometimes|required',
        ];
    }
    public function updating(Model $model, array $data)
    {
        $model->staff_id = Auth::user()->info->id;
        return $data;
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
}
