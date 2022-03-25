<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\MedicalStaff;
use App\Http\Requests\StoreMedicalStaffRequest;
use App\Http\Requests\UpdateMedicalStaffRequest;

class MedicalStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMedicalStaffRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMedicalStaffRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MedicalStaff  $medicalStaff
     * @return \Illuminate\Http\Response
     */
    public function show(MedicalStaff $medicalStaff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MedicalStaff  $medicalStaff
     * @return \Illuminate\Http\Response
     */
    public function edit(MedicalStaff $medicalStaff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMedicalStaffRequest  $request
     * @param  \App\Models\MedicalStaff  $medicalStaff
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMedicalStaffRequest $request, MedicalStaff $medicalStaff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MedicalStaff  $medicalStaff
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicalStaff $medicalStaff)
    {
        //
    }
}
