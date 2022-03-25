<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Child;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChildController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Child::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $d1 = new DateTime();
        $d1 =$d1->format('U');
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'parent_id'=> ['required'],
            'gender' => ['required'],
            'weight' => ['required'],
            'height'=> ['required'],
            'dob'=> ['required'],
            'health_nsurance_id'=> ['required']
        ]);
        if ($request->hasFile('img')) {
            //get name and port of server
            $serverName = "http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'];
            //get file name
            $fileName = $request['name'] .$request['dob'] .$d1. "." . $request->file('img')->getClientOriginalExtension();
            //save img in storage public/img
            $request->file('img')->storeAs('public/img', $fileName);
            $path = $serverName . "/storage" . '/img/' . $fileName;
            // return response()->json(['success' => $path],200);
            $img = $path;
        }
        else{
            // return response()->json(['error' => 'File not found'],404);
            $img = null;
        }

        $child = Child::create([
            'name' => $request->name,
            'parent_id'=> $request->parent_id,
            'gender'=>  $request->gender,
            'weight' => $request->weight,
            'height'=> $request->height,
            'dob'=> $request->dob,
            'img' => $img,
            'health_nsurance_id' => $request->health_nsurance_id
        ]);

        return response()->json(['success' =>$child ],200);
    }




    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \App\Http\Requests\StoreChildRequest  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(StoreChildRequest $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Child::find($id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function getMy()
    {
        //
        return Child::where('parent_id','=',Auth::user()->id)->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function del($id)
    {
        //
        return Child::find($id)->delete();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Child  $child
     * @return \Illuminate\Http\Response
     */
    public function edit(Child $child)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateChildRequest  $request
     * @param  \App\Models\Child  $child
     * @return \Illuminate\Http\Response
     */
    // public function update(UpdateChildRequest $request, Child $child)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Child  $child
     * @return \Illuminate\Http\Response
     */
    public function destroy(Child $child)
    {
        //
    }
}
