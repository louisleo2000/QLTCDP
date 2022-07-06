<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Child;
use App\Models\VaccinationDetails;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

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
    public function indexWeb()
    {
        //
        return view('pages.childrent');
    }
    public function getAllChild()
    {
        //
        return DataTables::of(Child::all())
            ->addColumn('editbtn', function ($child) {
                return '<button type="button" class="btn btn-danger">' . $child->id . 'Sửa </button>';
            })
            ->editColumn('name', function ($child) {
                return '<div class="d-flex px-2 py-1">
                            <div>
                            <img src="' . $child->img . '" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">' . $child->name . '</h6>
                            </div>
                        </div>';
            })
            ->editColumn('dob', function ($child) {
                $date = date_create($child->dob);
                return date_format($date, "d-m-Y");
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
    public function create(Request $request)
    {
        //
        $request->validate([
            'name' => ['required', 'string', 'max:70'],
            'gender' => ['required'],
            'weight' => ['required'],
            'height' => ['required'],
            'dob' => ['required'],
            'health_nsurance_id' => ['required']
        ]);
        //verify if the child is already in the database
        $child = Child::where('name', $request->name)->where('dob', $request->dob)->where('gender', $request->gender)->first();
        if ($child) {
            return response()->json(['message' => 'Thông tin trẻ em này đã có trong kho dữ liệu'], 400);
        }
        $child = Child::where('health_nsurance_id', $request->health_nsurance_id)->first();
        if ($child) {
            return response()->json(['message' => 'Số bảo hiểm y tế đã được sử dụng'], 400);
        }

        if ($request->hasFile('img')) {
            //get name and port of server
            $serverName = "http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'];
            //get file name
            $fileName = Auth::user()->info->id . $request['dob'] . "." . $request->file('img')->getClientOriginalExtension();
            $img = Image::make($request->file('img')->path());
            $img->resize(350, 400, function ($const) {
                $const->aspectRatio();
            })->save(public_path('storage/img') . '/' . $fileName);
            //save img in storage public/img
            // $request->file('img')->storeAs('public/img', $fileName);
            $path = $serverName . "/storage" . '/img/' . $fileName;
            // return response()->json(['success' => $path],200);
            $img = $path;
        } else {
            // return response()->json(['error' => 'File not found'],404);
            $img = null;
        }



        $child = Child::create([
            'name' => $request->name,
            'parent_id' => Auth::user()->info->id,
            'gender' =>  $request->gender,
            'weight' => $request->weight,
            'height' => $request->height,
            'dob' => $request->dob,
            'img' => $img,
            'health_nsurance_id' => $request->health_nsurance_id
        ]);

        return response()->json(['success' => $child], 200);
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
        $childs = Child::where('parent_id', '=', Auth::user()->info->id)->get();
        //for each child get the vaccination details
        foreach ($childs as $child) {
            $child->vaccination_details = VaccinationDetails::where('child_id', $child->id)->with('vaccine')->get();
        }
        // $childs = Child::where('parent_id', '=', Auth::user()->info->id)->with('vaccine','vaccinations')->get();
        return $childs;
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


    public function edit(Request $request)
    {
        //
        // dd($request->all());

        $request->validate([
            'child_id' => ['required'],
            'name' => ['required', 'string', 'max:70'],
            'gender' => ['required'],
            'weight' => ['required'],
            'height' => ['required'],
            'dob' => ['required'],
            'health_nsurance_id' => ['required']
        ]);
        //verify if the child is already in the database
        $child = Child::find($request->child_id);
        if ($child) {

            if ($request->hasFile('img')) {
                //get name and port of server
                $serverName = "http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'];
                //get file name
                $fileName = Auth::user()->info->id . $request['dob'] . "." . $request->file('img')->getClientOriginalExtension();
                $img = Image::make($request->file('img')->path());
                $img->resize(350, 400, function ($const) {
                    $const->aspectRatio();
                })->save(public_path('storage/img') . '/' . $fileName);
                //save img in storage public/img
                // $request->file('img')->storeAs('public/img', $fileName);
                $path = $serverName . "/storage" . '/img/' . $fileName;
                // return response()->json(['success' => $path],200);
                $img = $path;
            } else if ($request->img == null) {
                $img = $child->img;
            } else {
                // return response()->json(['error' => 'File not found'],404);
                $img = null;
            }

            $child->update([
                'name' => $request->name,
                'parent_id' => Auth::user()->info->id,
                'gender' =>  $request->gender,
                'weight' => $request->weight,
                'height' => $request->height,
                'dob' => $request->dob,
                'img' => $img,
                'health_nsurance_id' => $request->health_nsurance_id
            ]);

            return response()->json(['success' => $child], 200);
        } else {
            return response()->json(['message' => 'Không tìm thấy trẻ'], 400);
        }
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
