<?php

namespace App\Http\Controllers;

use App\DataTables\ChildrentDataTable;
use App\DataTables\ChildrentDataTableEditor;
use Illuminate\Http\Request;

class ChildrentController extends Controller
{
    public function index(ChildrentDataTable $dataTable)
    {
        
        $data =['title' => 'Quản lý thông tin trẻ em'];
        return  $dataTable->render('pages.childrent',$data);
    }
    public function store(ChildrentDataTableEditor $editor)
    {
        //
        return $editor->process(request());
    }
}
