<?php

namespace App\Http\Controllers\api\v1;

use App\DataTables\ScheduleDataTable;
use App\DataTables\ScheduleDataTableEditor;
use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Vaccine;
use Yajra\DataTables\Facades\DataTables;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ScheduleDataTable $dataTable)
    {
        
        $data =['vaccines' => Vaccine::all()];
        return  $dataTable->render('pages.schedule',$data);
    }
    public function indexAPI(ScheduleDataTable $dataTable)
    {
        //get schedules with vaccines
        $data =['schedules' => Schedule::where('status','<>','Đang chuẩn bị')->where('status','<>','Đã kết thúc')->where('status','<>','Đã hủy')-> orderBy('date_time', 'ASC')->with('vaccine')->get()];
        // dd($data['vaccines']);
        return response()->json(['data' => $data]);
    }
    // {
    //     //
    //     // return view('pages.schedule');
    // }
    public function getSchedule()
    {
        //
        // return DataTables::of(Schedule::all())
        //     ->addColumn('action', function ($schedule) {
        //         return '
        //         <div>
        //         <button  type="button" class="btn btn-success">Sửa </button>
        //         <button  type="button" onClick=delVaccine('.$schedule->id.') class="btn btn-danger">Xóa </button>
        //         </div>';
        //     })
        //     ->addColumn('name', function ($schedule) {
        //         return $schedule->vaccine->name;
        //     })
        //     ->rawColumns(['action'])
        //     ->make(true);
    }


    public function store(ScheduleDataTableEditor $editor)
    {
        //
        return $editor->process(request());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateScheduleRequest  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}
