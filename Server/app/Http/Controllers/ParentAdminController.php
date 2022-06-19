<?php

namespace App\Http\Controllers;

use App\DataTables\ParentDataTable;
use App\DataTables\ParentDataTableEditor;
use Illuminate\Http\Request;

class ParentAdminController extends Controller
{
    public function index(ParentDataTable $dataTable)
    {
        
        $data =['title' => 'Quản lý phụ huynh'];
        return  $dataTable->render('pages.parent',$data);
    }
    public function store(ParentDataTableEditor $editor)
    {
        //
        return $editor->process(request());
    }
}
