<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Validator;
use App\Models\StaffAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StaffAdministratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd($request);
        $staff  = StaffAdmin::where([
            ['role', 'admin'],
        ])->get();

        //  if (request('search')) {
        //      $petinggi = PetinggiYLPI::where('nama_petinggi', 'LIKE', '%' . request('search') . '%');
        //  }
        // $staff = $staff->paginate(10);


        return view('pages.admin.staffAdmin.index', compact('staff'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'nama' => 'required|min:5|',
            'email' => 'required|min:10|unique:staff-admin',
            'password' => 'required|min:8|',

        ], [
            'min' => 'Masukan :attribute minimal :min',
            'max' => 'Masukan :attribute minimal :max',
            'required' => ':attribute harus diisi',
            'unique' => ':attribute yang dimasukan sudah ada'
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'errors' => $validator->errors()->toArray()]);
        } else {
            $post   =   StaffAdmin::Create(
                [

                    'nama' => $request->nama,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'role' => 'admin',

                ]
            );
            if ($post) {
                return response()->json(['status' => 1, 'msg' => 'Data Staff Berhasil disimpan']);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $staff = StaffAdmin::find($id);
        return response()->json(['staff' => $staff]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * 
     */
    public function updateStaff(Request $request)
    {
        $id = $request->id;

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required',
        ], [
            'min' => 'Masukan :attribute minimal :min',
            'max' => 'Masukan :attribute maksimal :max',
            'required' => ':attribute harus diisi',
            'unique' => ':attribute yang dimasukan sudah ada'
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {


            $staff = StaffAdmin::find($id);

            $staff->id = $request->id;

            $staff->nama = $request->nama;
            $staff->email = $request->email;
            $staff->password = bcrypt($request->password);

            $query = $staff->update();


            if ($query) {
                return response()->json(['code' => 1, 'msg' => 'Staff have Been updated']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            }
        }
    }
    public function update(Request $request, $id)
    {


        $staff = StaffAdmin::find($id);


        $validator = Validator::make($request->all(), [

            'nama' => 'required|min:3|',
            'email' => 'required|min:3|',

        ], [
            'min' => 'Masukan :attribute minimal :min',
            'max' => 'Masukan :attribute minimal :max',
            'required' => ':attribute harus diisi',
            'unique' => ':attribute yang dimasukan sudah ada'
        ]);


        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'errors' => $validator->errors()->toArray()]);
        } else {

            $staff->nama = $request->nama;
            $staff->email = $request->email;
            $staff->password = bcrypt($request->password);



            $query = $staff->update();


            if ($query) {
                return response()->json(['code' => 1, 'msg' => 'Data staff berhasil diperbarui']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $staff = StaffAdmin::find($id);

        $staff->delete();
        return response()->json(['code' => 1, 'msg' => 'Data Staff Berhasil dihapus!']);
    }
}