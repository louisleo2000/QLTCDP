<?php

namespace App\Http\Controllers\api\v1;

use App\DataTables\MedicalStaffDataTable;
use App\DataTables\MedicalStaffDataTableEditor;
use App\Http\Controllers\Controller;
use App\Models\MedicalStaff;
use App\Http\Requests\StoreMedicalStaffRequest;
use App\Http\Requests\UpdateMedicalStaffRequest;

class MedicalStaffController extends Controller
{
    public function index(MedicalStaffDataTable $dataTable)
    {
        
        $data =['title' => 'Quản lý nhân viên'];
        return  $dataTable->render('pages.medical-staff',$data);
    }
    public function store(MedicalStaffDataTableEditor $editor)
    {
        //
        return $editor->process(request());
    }
}
