<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\VaccinationDetails;
use App\Http\Requests\StoreVaccinationDetailsRequest;
use App\Http\Requests\UpdateVaccinationDetailsRequest;

class VaccinationDetailsController extends Controller
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
     * @param  \App\Http\Requests\StoreVaccinationDetailsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVaccinationDetailsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VaccinationDetails  $vaccinationDetails
     * @return \Illuminate\Http\Response
     */
    public function show(VaccinationDetails $vaccinationDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VaccinationDetails  $vaccinationDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(VaccinationDetails $vaccinationDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVaccinationDetailsRequest  $request
     * @param  \App\Models\VaccinationDetails  $vaccinationDetails
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVaccinationDetailsRequest $request, VaccinationDetails $vaccinationDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VaccinationDetails  $vaccinationDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(VaccinationDetails $vaccinationDetails)
    {
        //
    }
}
