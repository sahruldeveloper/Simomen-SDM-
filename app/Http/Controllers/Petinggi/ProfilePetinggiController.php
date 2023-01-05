<?php

namespace App\Http\Controllers\Petinggi;

use App\Models\Pegawai;
use App\Models\PetinggiYLPI;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProfilePetinggiController extends Controller
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
        $user = PetinggiYLPI::with('pegawai')->find($id);

        return view('pages.petinggi.profile-petinggi', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $npk = $request->npk;

        if ($request->kategori == 'Pegawai YLPI') {
            $validator = Validator::make($request->all(), [
                'nama' => 'required|min:3',
                'email' => 'required|min:3',


            ], [
                'min' => 'Masukan :attribute minimal :min',
                'max' => 'Masukan :attribute minimal :max',
                'required' => ':attribute harus diisi',
                'unique' => ':attribute yang dimasukan sudah ada'
            ]);


            if (!$validator->passes()) {
                return response()->json(['code' => 0, 'errors' => $validator->errors()->toArray()]);
            } else {

                $query = PetinggiYLPI::where('id', $id)->update(
                    [
                        'email' =>  $request->email,
                        'password' => bcrypt($request->password),
                    ]
                );


                // $item = PetinggiYLPI::find($id);
                // $item->email = $request->email;
                // $item->password = bcrypt($request->password);

                // $query = $item->update();

                Pegawai::where('npk', $npk)->update(
                    [
                        'nama' =>  $request->nama,
                    ]
                );


                if ($query) {
                    return response()->json(['status' => 1, 'msg' => 'Data Petinggi Berhasil diperbaharui']);
                } else {
                    return redirect('/')->with('error', 'Data Petinggi gagal di perbaharui');
                }
            }
        } else {
            $validator = Validator::make($request->all(), [
                'nama' => 'required|min:3',
                'email' => 'required|min:3',
                'password' => 'required|min:8',

            ], [
                'min' => 'Masukan :attribute minimal :min',
                'max' => 'Masukan :attribute minimal :max',
                'required' => ':attribute harus diisi',
                'unique' => ':attribute yang dimasukan sudah ada'
            ]);


            if (!$validator->passes()) {
                return response()->json(['code' => 0, 'errors' => $validator->errors()->toArray()]);
            } else {

                $item = PetinggiYLPI::find($id);
                $item->nama = $request->nama_petinggi;
                $item->email = $request->email;
                $item->password = bcrypt($request->password);

                $query = $item->update();


                if ($query) {
                    return response()->json(['status' => 1, 'msg' => 'Data Petinggi Berhasil diperbaharui']);
                } else {
                    return redirect('/')->with('error', 'Data Petinggi gagal di perbaharui');
                }
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
        //
    }
}