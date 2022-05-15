<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Parents;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
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
        //check request
        $request->validate([ 
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required'],
            'gender' => 'required',
            'citizen_id' => 'required',
            'tel' => 'required'
        ]);
        $p = Parents::where('citizen_id', $request->citizen_id)->orWhere('tel', $request->tel)->first();
        $u = User::where('email', $request->email)->first();
        //create new user
        if($u != null)
        {
            return response()->json(['status' => 'error','message' => 'Email đã tồn tại'], 200);
        }

        if ($p == null ) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 3,
            ]);

            event(new Registered($user));
            //find parent by user_id
            $parent = Parents::where('user_id', $user->id)->first();
            //create new parent
            $parent->user_id = $user->id;
            $parent->gender = $request->gender;
            $parent->citizen_id = $request->citizen_id;
            $parent->img = $request->img;
            $parent->tel = $request->tel;
            $parent->adress = $request->adress;
            $parent->save();
            return response()->json(['status' => 'success', 'success' => $user, 'info' => $parent], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Số điện thoại hoặc CMND/CCCD đã có người sử dụng'], 200);
        }
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
        //update parent
        $parent = Parents::find($request->id);
        $parent->gender = $request->gender;
        $parent->citizen_id = $request->citizen_id;
        $parent->img = $request->img;
        $parent->tel = $request->tel;
        $parent->adress = $request->adress;
        $parent->save();
        return response()->json(['status' => 'success', 'success' => $parent], 200);
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
