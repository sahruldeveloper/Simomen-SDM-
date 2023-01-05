<?php

namespace App\Http\Controllers\Admin;

use App\Models\Jurusan;
use App\Models\jabatan;
use App\Models\Fakultas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jurusan = Jurusan::all();
        $fakultas = Fakultas::all();
        $id = Jurusan::kode_jurusan();

        // Mengirim kondisi melalui ajax
        if ($request->ajax()) {
            return datatables()->of($jurusan)
                ->addColumn('action', function ($data) {
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-kode_jurusan="' . $data->kode_jurusan . '" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post-jurusan"><i class="far fa-edit"></i> Edit</a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= ' <button class="btn btn-sm btn-danger" data-id="' . $data->kode_jurusan . '" id="deleteJurusanBtn"><i class="fa-regular fa-trash-can"></i> Delete</button>';
                    return $button;
                })

                ->rawColumns(['action'])
                // ->addColumn('fakultas', function ($data) {
                //     return $data->golon->nama_golongan;
                // })
                ->addIndexColumn()
                ->make(true);
        }
        return view('pages.admin.jurusan.index', compact('fakultas', 'id'));
    }

    public function getJurusanDetails(Request $request)
    {

        $kode_jurusan = $request->kode_jurusan;
        $fakultas = fakultas::all();

        $jurusanDetails = jurusan::with('fakultas')->find($kode_jurusan);

        return response()->json(['fakultas' => $fakultas, 'details' => $jurusanDetails]);
    }

    public function updateJurusanDetails(Request $request)
    {
        $kode_jurusan = $request->kode_jurusan_id;


        $validator = Validator::make($request->all(), [
            'kode_jurusan' => 'required|max:10|min:3|unique:jurusan,kode_jurusan,' . $kode_jurusan . ',kode_jurusan',
            'nama_jurusan' => 'required|max:36|min:3|unique:jurusan,nama_jurusan,' . $kode_jurusan . ',kode_jurusan',
            'kode_fakultas' => 'required',
        ],  [
            'min' => 'Masukan :attribute minimal :min',
            'max' => 'Masukan :attribute maksimal :max',
            'required' => ':attribute harus diisi',
            'unique' => ':attribute yang dimasukan sudah ada'
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $jurusan = jurusan::find($kode_jurusan);

            $jurusan->kode_jurusan = $request->kode_jurusan;

            $jurusan->nama_jurusan = $request->nama_jurusan;
            $jurusan->kode_fakultas = $request->kode_fakultas;

            $query = $jurusan->update();


            if ($query) {
                return response()->json(['code' => 1, 'msg' => 'Jurusan Details have Been updated']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            }
        }
    }

    public function deleteJurusan(Request $request)
    {
        $kode_jurusan = $request->kode_jurusan;
        $query = jurusan::withCount(['dosen'])->find($kode_jurusan);

        // dd($query);
        if ($query->dosen_count == null) {
            $query->delete();
            if ($query) {
                return response()->json(['code' => 1, 'msg' => 'Data berhasil dihapus!']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            }
        }
        return response()->json(['code' => 0, 'msg' => 'Data Berelasi!']);
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
        $validator = Validator::make($request->all(), [
            'kode_jurusan' => 'required|max:10|min:3|unique:jurusan,kode_jurusan',
            'nama_jurusan' => 'required|max:86|min:3|unique:jurusan,nama_jurusan',
            'kode_fakultas' => 'required',
        ], [
            'min' => 'Masukan :attribute minimal :min',
            'max' => 'Masukan :attribute minimal :max',
            'required' => ':attribute harus diisi',
            'unique' => ':attribute yang dimasukan sudah ada'
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'errors' => $validator->errors()->toArray()]);
        } else {

            $post   =   jurusan::Create(

                [
                    'kode_jurusan' => $request->kode_jurusan,
                    'nama_jurusan' => $request->nama_jurusan,
                    'kode_fakultas' => $request->kode_fakultas,
                ]
            );


            if ($post) {
                return response()->json(['status' => 1, 'msg' => 'Data Jurusan Berhasil disimpan']);
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