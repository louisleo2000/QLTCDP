<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Http\Requests\StoreChildRequest;
use App\Http\Requests\UpdateChildRequest;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;

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
            'birthday'=> ['required']
        ]);
        if ($request->hasFile('img')) {
            //get name and port of server
            $serverName = "http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'];
            //get file name
            $fileName = $request['name'] .$request['birthday'] .$d1. "." . $request->file('img')->getClientOriginalExtension();
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

        // if($request->img)
        // {
        //     $img  = $request->img;
        // }
        // else
        // {
        //     $img = null;
        // }
        $child = Child::create([
            'name' => $request->name,
            'parent_id'=> $request->parent_id,
            'gender'=>  $request->gender,
            'weight' => $request->weight,
            'height'=> $request->height,
            'birthday'=> $request->birthday,
            'img' => $img
        ]);

        return response()->json(['success' =>$child ],200);
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreChildRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChildRequest $request)
    {
        //
    }

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
    public function getMy($id)
    {
        //
        return Child::where('parent_id','=',$id)->get();
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
    public function update(UpdateChildRequest $request, Child $child)
    {
        //
    }

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
