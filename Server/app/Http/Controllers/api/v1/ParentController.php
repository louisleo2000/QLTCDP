<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Parents;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ParentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pages.parent');
    }

    public function getAllParents()
    {
        //
        return DataTables::of(Parents::all())
            ->addColumn('editbtn', function ($parent) {
                return '<button type="button" class="btn btn-danger">' . $parent->id . 'Sửa </button>';
            })
            ->editColumn('name', function ($parent) {
                return '<div class="d-flex px-2 py-1">
                            <div>
                            <img src="' . $parent->img . '" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">' . $parent->user->name . '</h6>
                            </div>
                        </div>';
            })
            ->rawColumns(['editbtn', 'name'])
            ->make(true);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Parents  $parents
     * @return \Illuminate\Http\Response
     */
    public function show(Parents $parents)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Parents  $parents
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parents $parents)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Parents  $parents
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parents $parents)
    {
        //
    }
}
