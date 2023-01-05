<?php

namespace App\Http\Controllers\Admin;

use App\Models\Fakultas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fakultas = Fakultas::all();

        $id = Fakultas::kode_fakultas();
        // Mengirim kondisi melalui ajax
        if ($request->ajax()) {
            return datatables()->of($fakultas)
                ->addColumn('action', function ($data) {
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-kode_fakultas="' . $data->kode_fakultas . '" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post-fakultas"><i class="far fa-edit"></i> Edit</a>';
                    $button .= '&nbsp;&nbsp;';

                    $button .= ' <button class="btn btn-sm btn-danger" data-id="' . $data->kode_fakultas . '" id="deleteFakultasBtn"><i class="fa-regular fa-trash-can"></i>
                    Delete</button>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }


        return view('pages.admin.fakultas.index', compact('id'));
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
            'kode_fakultas' => 'required|max:10|min:3|unique:fakultas,kode_fakultas',
            'nama_fakultas' => 'required|max:50|min:3|unique:fakultas,nama_fakultas',
        ], [
            'min' => 'Masukan :attribute minimal :min',
            'max' => 'Masukan :attribute minimal :max',
            'required' => ':attribute harus diisi',
            'unique' => ':attribute yang dimasukan sudah ada'
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'errors' => $validator->errors()->toArray()]);
        } else {

            $post   =   fakultas::Create(

                [
                    'kode_fakultas' => $request->kode_fakultas,
                    'nama_fakultas' => $request->nama_fakultas,
                ]
            );


            if ($post) {
                return response()->json(['status' => 1, 'msg' => 'Data Fakultas Berhasil disimpan']);
            }
        }
    }

    public function getFakultasDetails(Request $request)
    {

        $kode_fakultas = $request->kode_fakultas;

        $fakultasDetails = Fakultas::find($kode_fakultas);

        return response()->json(['details' => $fakultasDetails]);
    }

    public function updateFakultasDetails(Request $request)
    {
        $kode_fakultas = $request->kode_fakultas_id;

        $validator = Validator::make($request->all(), [
            'kode_fakultas' => 'required|max:10|min:3|unique:fakultas,kode_fakultas,' . $kode_fakultas . ',kode_fakultas',
            'nama_fakultas' => 'required|max:50|min:3|unique:fakultas,nama_fakultas,' . $kode_fakultas . ',kode_fakultas',
        ], [
            'min' => 'Masukan :attribute minimal :min',
            'max' => 'Masukan :attribute maksimal :max',
            'required' => ':attribute harus diisi',
            'unique' => ':attribute yang dimasukan sudah ada'
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {


            $fakultas = Fakultas::find($kode_fakultas);

            $fakultas->kode_fakultas = $request->kode_fakultas;

            $fakultas->nama_fakultas = $request->nama_fakultas;

            $query = $fakultas->update();


            if ($query) {
                return response()->json(['code' => 1, 'msg' => 'Fakultas Details have Been updated']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            }
        }
    }

    public function deleteFakultas(Request $request)
    {
        $kode_fakultas = $request->kode_fakultas;
        $query = fakultas::withCount(['jurusan'])->find($kode_fakultas);

        // dd($query);
        if ($query->jurusan_count == null) {
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