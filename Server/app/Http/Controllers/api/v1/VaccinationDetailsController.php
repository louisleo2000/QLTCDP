<?php

namespace App\Http\Controllers\api\v1;

use App\DataTables\VaccinationDetailsDataTable;
use App\DataTables\VaccinationDetailsDataTableEditor;
use App\Http\Controllers\Controller;
use App\Models\VaccinationDetails;
use App\Http\Requests\StoreVaccinationDetailsRequest;
use App\Http\Requests\UpdateVaccinationDetailsRequest;
use App\Models\Child;
use App\Models\Vaccine;

class VaccinationDetailsController extends Controller
{
    public function index(VaccinationDetailsDataTable $dataTable)
    {
        $childs = Child::all();
        $vaccines = Vaccine::all();
        $data =['title' => 'Quản lý mũi tiêm', 'childs' => $childs, 'vaccines' => $vaccines];
        return  $dataTable->render('pages.vaccination-details',$data);
    }
    public function store(VaccinationDetailsDataTableEditor $editor)
    {
        //
        return $editor->process(request());
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

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \App\Http\Requests\StoreVaccinationDetailsRequest  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(StoreVaccinationDetailsRequest $request)
    // {
    //     //
    // }

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
