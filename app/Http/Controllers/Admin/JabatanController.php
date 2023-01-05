<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use App\Models\jabatan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;




class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jabatan = jabatan::all();
        $id = jabatan::kodeJabatan();


        // Mengirim kondisi melalui ajax
        if ($request->ajax()) {
            return datatables()->of($jabatan)
                ->addColumn('action', function ($data) {
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-kode_jabatan="' . $data->kode_jabatan . '" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post-jabatan"><i class="far fa-edit"></i> Edit</a>';
                    $button .= '&nbsp;&nbsp;';


                    $button .= ' <button class="btn btn-sm btn-danger" data-id="' . $data->kode_jabatan . '" id="deleteJabatanBtn"><i class="fa-regular fa-trash-can"></i> Delete</button>';
                    return $button;
                })

                ->rawColumns(['action'])
                // ->addColumn('golongan', function ($data) {
                //     return $data->golongan->nama_golongan;
                // })
                ->addIndexColumn()
                ->make(true);
        }


        return view('pages.admin.jabatan.index', compact('id'));
    }

    public function getGolonganJabatan(Request $request)
    {
        $golongan = golongan::all();
        // return response()->json($golongan);
        return view("pages.jabatan.edit-jabatan", compact('golongan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $golongan = golongan::all();
        // return view('pages.jabatan.create', compact('golongan'));
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
            'kode_jabatan' => 'required|max:10|min:3|unique:jabatan,kode_jabatan',
            'nama_jabatan' => 'required|max:36|min:3|unique:jabatan,nama_jabatan',

        ], [
            'min' => 'Masukan :attribute minimal :min',
            'max' => 'Masukan :attribute minimal :max',
            'required' => ':attribute harus diisi',
            'unique' => ':attribute yang dimasukan sudah ada'
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'errors' => $validator->errors()->toArray()]);
        } else {

            $post   =   jabatan::Create(

                [
                    'kode_jabatan' => $request->kode_jabatan,
                    'nama_jabatan' => $request->nama_jabatan,

                ]
            );


            if ($post) {
                return response()->json(['status' => 1, 'msg' => 'Data Berhasil disimpan']);
            }
        }
    }

    public function getJabatanDetails(Request $request)
    {

        $kode_jabatan = $request->kode_jabatan;

        $jabatanDetails = jabatan::find($kode_jabatan);

        return response()->json(['details' => $jabatanDetails]);
    }

    public function updateJabatanDetails(Request $request)
    {
        $kode_jabatan = $request->kode_jabatan_id;


        $validator = Validator::make($request->all(), [
            'kode_jabatan' => 'required|max:10|min:3|unique:jabatan,kode_jabatan,' . $kode_jabatan . ',kode_jabatan',
            'nama_jabatan' => 'required|max:36|min:3|unique:jabatan,nama_jabatan,' . $kode_jabatan . ',kode_jabatan',

        ],  [
            'min' => 'Masukan :attribute minimal :min',
            'max' => 'Masukan :attribute maksimal :max',
            'required' => ':attribute harus diisi',
            'unique' => ':attribute yang dimasukan sudah ada'
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $jabatan = jabatan::find($kode_jabatan);

            $jabatan->kode_jabatan = $request->kode_jabatan;

            $jabatan->nama_jabatan = $request->nama_jabatan;


            $query = $jabatan->update();


            if ($query) {
                return response()->json(['code' => 1, 'msg' => 'Jabatan Details have Been updated']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
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
    public function edit($kode_jabatan)
    {
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
     * 
     */
    public function deleteJabatan(Request $request)
    {
        $kode_jabatan = $request->kode_jabatan;
        $query = jabatan::withCount(['pangkat'])->find($kode_jabatan);

        // dd($query);
        if ($query->pangkat_count == null) {
            $query->delete();
            if ($query) {
                return response()->json(['code' => 1, 'msg' => 'Data berhasil dihapus!']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            }
        }
        return response()->json(['code' => 0, 'msg' => 'Data Berelasi!']);
    }
    public function destroy(Request $request)
    {
    }
}