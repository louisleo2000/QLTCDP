<?php

namespace App\Http\Controllers;

use App\Models\Vaccine;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateVaccineRequest;
use Yajra\DataTables\Facades\DataTables;

class VaccineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pages.vaccine');
    }
    public function getAllVaccine()
    {
        //
        return DataTables::of(Vaccine::all())
            ->addColumn('action', function ($vaccine) {
                return '
                <div>
                <button  type="button" class="btn btn-success">Sửa </button>
                <button  type="button" onClick=delVaccine('.$vaccine->id.') class="btn btn-danger">Xóa </button>
                </div>';
            })
            ->addColumn('age', function ($vaccine) {
                return $vaccine->age_distance . ' ' . $vaccine->age_type;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => ['required'],
            'age_distance' => ['required'],
            'age_type' => ['required'],
            'description' => ['required'],
        ]);
        $vaccine = Vaccine::create($request->all());
        return response()->json(['status' => 'success', 'success' => $vaccine], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vaccine  $vaccine
     * @return \Illuminate\Http\Response
     */
    public function show(Vaccine $vaccine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vaccine  $vaccine
     * @return \Illuminate\Http\Response
     */
    public function edit(Vaccine $vaccine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVaccineRequest  $request
     * @param  \App\Models\Vaccine  $vaccine
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVaccineRequest $request, Vaccine $vaccine)
    {
        //
    }


    public function delete($id)
    {
        //
        Vaccine::find($id)->delete();
        return response()->json(['status' => 'success','message'=>'Xóa thành công'], 200);
    }
}
