<?php

namespace App\DataTables;

use App\Models\MedicalStaff;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTablesEditor;

class MedicalStaffDataTableEditor extends DataTablesEditor
{
    protected $model = MedicalStaff::class;

    /**
     * Get create action validation rules.
     *
     * @return array
     */
    public function createRules()
    {
        return [
            'user.email' => 'required|email',
            'user.name'  => 'required',
        ];
    }
    public function creating(Model $model, array $data)
    {
        $user = User::create([
            'name' => $data['user']['name'],
            'email' => $data['user']['email'],
            'role' => 2,
            'password' => Hash::make($data['user']['password']),
        ]);

        $model->user_id = $user->id;
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
            'user.name'  => 'required|max:255',
            'tel'  => 'nullable|regex:/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/|max:11|min:10',
            'user.email' => 'required|email',
            'user.password' => 'nullable|min:8',
            'adress'  => 'nullable|max:255|min:5',
            'citizen_id'  => 'nullable|max:12|min:9|regex:/^[0-9]*$/',
            'gender' => 'required'
        ];
    }
    public function updating(Model $model, array $data)
    {
        $user = $model->user;
        $user->email =  $data['user']['email'];
        $user->name = $data['user']['name'];
        if($data['user']['password'] !=null)
        {
            $user->password = Hash::make($data['user']['password']);
        }
        
        $user->save();
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
