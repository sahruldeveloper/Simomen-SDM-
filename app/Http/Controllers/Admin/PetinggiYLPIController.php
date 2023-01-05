<?php

namespace App\Http\Controllers\Admin;

use File;
use App\Models\Pangkat;
use App\Models\golongan;
use Illuminate\Support\Str;
use App\Models\PetinggiYLPI;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PetinggiYLPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd($request);
        $petinggi = PetinggiYLPI::with('pegawai')->orderBy('created_at', 'DESC');

        if (request('search')) {
            $petinggi = PetinggiYLPI::where('nama', 'LIKE', '%' . request('search') . '%');
        }
        $petinggi = $petinggi->paginate(10);

        $pangkat = Pangkat::all();

        return view('pages.admin.petinggiYLPI.index', compact('pangkat', 'petinggi'));
    }

    public function store(Request $request)
    {
        if ($request->kategori == 'Pegawai YLPI') {
            $validator = Validator::make($request->all(), [
                'npk' => 'required|min:5',
                'nama' => 'required|min:5',
                'email' => 'required|min:10|unique:petinggiYLPI',
                'password' => 'required|min:8|',
                'pendidikan' => 'min:2|',
                'tmp_lahir' => 'min:3|',
                'tgl_lahir' => 'min:3|',
                'jenis_kelamin' => 'min:3|',
                'jabatan_struktural' => 'required',
                'foto' => 'required|image|mimes:png,jpeg,jpg'
            ], [
                'min' => 'Masukan :attribute minimal :min',
                'max' => 'Masukan :attribute minimal :max',
                'required' => ':attribute harus diisi',
                'unique' => ':attribute yang dimasukan sudah ada'
            ]);

            if (!$validator->passes()) {
                return response()->json(['status' => 0, 'errors' => $validator->errors()->toArray()]);
            } else {

                if ($request->hasFile('foto')) {
                    $file = $request->file('foto');
                    $filename = time() . Str::slug($request->nama) . '.' . $file->getClientOriginalExtension();

                    $file->storeAs(
                        'public/assets/foto',
                        $filename

                    );

                    $post   =   PetinggiYLPI::Create(
                        [

                            'npk' => $request->npk,
                            'nama' => $request->nama,
                            'email' => $request->email,
                            'password' => bcrypt($request->password),
                            'tmp_lahir' => $request->tmp_lahir,
                            'tgl_lahir' => $request->tgl_lahir,
                            'tgl_sk' => $request->tgl_sk,
                            'jenis_kelamin' => $request->jenis_kelamin,
                            'jabatan_struktural' => $request->jabatan_struktural,
                            'pendidikan' => $request->pendidikan,
                            'foto' => $filename,
                            'kategori' => $request->kategori,
                        ]
                    );
                    if ($post) {
                        return response()->json(['status' => 1, 'msg' => 'Data Petinggi Berhasil disimpan']);
                    }
                }
            }
        } else {
            $validator = Validator::make($request->all(), [
                'nama' => 'required|min:5',
                'email' => 'required|min:10|unique:petinggiYLPI',
                'password' => 'required|min:8|',
                'pendidikan' => 'min:2|',
                'tmp_lahir' => 'min:3|',
                'tgl_lahir' => 'min:3|',
                'jenis_kelamin' => 'min:3|',
                'jabatan_struktural' => 'required',
                'foto' => 'required|image|mimes:png,jpeg,jpg'
            ], [
                'min' => 'Masukan :attribute minimal :min',
                'max' => 'Masukan :attribute minimal :max',
                'required' => ':attribute harus diisi',
                'unique' => ':attribute yang dimasukan sudah ada'
            ]);

            if (!$validator->passes()) {
                return response()->json(['status' => 0, 'errors' => $validator->errors()->toArray()]);
            } else {

                if ($request->hasFile('foto')) {
                    $file = $request->file('foto');
                    $filename = time() . Str::slug($request->nama) . '.' . $file->getClientOriginalExtension();

                    $file->storeAs(
                        'public/assets/foto',
                        $filename

                    );

                    $post   =   PetinggiYLPI::Create(
                        [

                            'npk' => $request->npk,
                            'nama' => $request->nama,
                            'email' => $request->email,
                            'password' => bcrypt($request->password),
                            'tmp_lahir' => $request->tmp_lahir,
                            'tgl_lahir' => $request->tgl_lahir,
                            'tgl_sk' => $request->tgl_sk,
                            'jenis_kelamin' => $request->jenis_kelamin,
                            'jabatan_struktural' => $request->jabatan_struktural,
                            'pendidikan' => $request->pendidikan,
                            'foto' => $filename,
                            'kategori' => $request->kategori,
                        ]
                    );
                    if ($post) {
                        return response()->json(['status' => 1, 'msg' => 'Data Petinggi Berhasil disimpan']);
                    }
                }
            }
        }
    }

    public function getPetinggiDetails(Request $request)
    {

        $id = $request->id;
        $pangkat = Pangkat::all();

        $petinggiDetails = PetinggiYLPI::with('pegawai', 'golongan', 'pangkat')->find($id);

        return response()->json(['pangkat' => $pangkat, 'details' => $petinggiDetails]);
    }

    public function updatePetinggiDetails(Request $request)
    {
        // dd($request);
        $id = $request->id;
        $npk = $request->npk;

        $petinggiylpi = PetinggiYLPI::find($id);
        $filename = $petinggiylpi->foto; //SIMPAN SEMENTARA NAMA FILE IMAGE SAAT INI
        // dd($pegawai->foto);

        $validator = Validator::make($request->all(), [
            'npk' => 'required|max:10|min:3|unique:petinggiylpi,npk,' . $npk . ',npk',
            'nama' => 'required|min:3|',
            'email' => 'required|min:3|',
            // 'password' => 'required|min:3|',
            'pendidikan' => 'required',
            'tmp_lahir' => 'required|min:3|',
            'tgl_lahir' => 'required|min:3|',
            'jenis_kelamin' => 'required|min:3|',
            'foto' => 'nullable|image|mimes:png,jpeg,jpg'
        ], [
            'min' => 'Masukan :attribute minimal :min',
            'max' => 'Masukan :attribute minimal :max',
            'required' => ':attribute harus diisi',
            'unique' => ':attribute yang dimasukan sudah ada'
        ]);


        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'errors' => $validator->errors()->toArray()]);
        } else {

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = time() . Str::slug($request->nama_petinggi) . '.' . $file->getClientOriginalExtension();
                // MAKA UPLOADA FILE TERSEBUT
                $file->storeAs(
                    'public/assets/foto',
                    $filename

                );
                File::delete(public_path('storage/assets/foto/' . $petinggiylpi->foto));
            }

            $petinggiylpi->npk = $request->npk;
            $petinggiylpi->nama = $request->nama;
            $petinggiylpi->email = $request->email;
            // $petinggiylpi->password = bcrypt($request->password);
            $petinggiylpi->pendidikan = $request->pendidikan;
            $petinggiylpi->tmp_lahir = $request->tmp_lahir;
            $petinggiylpi->tgl_lahir = $request->tgl_lahir;
            $petinggiylpi->jenis_kelamin = $request->jenis_kelamin;

            $petinggiylpi->foto = $filename;


            $query = $petinggiylpi->update();


            if ($query) {
                return response()->json(['code' => 1, 'msg' => 'Data petinggi berhasil diperbarui']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            }
        }
    }

    public function deletePetinggi(Request $request)
    {
        $id = $request->id;
        // dd($id);
        $petinggi = PetinggiYLPI::findOrFail($id);

        // File::delete(storage_path('storage/assets/foto/' . $petinggi->foto));
        if (File::exists(public_path('storage/assets/foto/' . $petinggi->foto))) {
            File::delete(public_path('storage/assets/foto/' . $petinggi->foto));
        } else {
            dd('File does not exists.');
        }
        $petinggi->delete();
        return response()->json(['code' => 1, 'msg' => 'Data Petinggi Berhasil dihapus!']);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $petinggiYlpi = PetinggiYLPI::all();
        return view('pages.admin.petinggiYLPI.index', compact('petinggiYlpi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($npk)
    {
        $petinggiDetails = PetinggiYLPI::with('pangkat', 'golongan')->find($npk);
        // dd($petinggiDetails);

        return view('pages.admin.petinggiYLPI.detail-petinggi', [
            'petinggiDetails' => $petinggiDetails
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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