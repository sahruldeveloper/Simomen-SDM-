<?php

namespace App\Http\Controllers\Admin;

use App\Models\jabatan;
use App\Models\Pangkat;
use App\Models\golongan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\Environment\Console;

class PangkatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pangkat = Pangkat::with(['jabatan'])->orderBy('kode_jabatan', 'ASC');

        $jabatan =  jabatan::all();
        $golongan =  golongan::all();

        $id = Pangkat::kodePangkat();

        // Mengirim kondisi melalui ajax
        if ($request->ajax()) {
            return datatables()->of($pangkat)
                ->addColumn('action', function ($data) {
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-kode_pangkat="' . $data->kode_pangkat . '" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post-pangkat"><i class="far fa-edit"></i> Edit</a>';
                    $button .= '&nbsp;&nbsp;';


                    $button .= ' <button class="btn btn-sm btn-danger" data-id="' . $data->kode_pangkat . '" id="deletePangkatBtn"><i class="fa-regular fa-trash-can"></i> Delete</button>';
                    return $button;
                })

                ->rawColumns(['action'])
                ->addColumn('jabatan', function ($data) {

                    if ($data->jabatan == null) {
                        return '-';
                    } else {
                        return $data->jabatan->nama_jabatan;
                    }
                })
                // ->addColumn('golongan', function ($data) {
                //     return $data->golongan->nama_golongan;
                // })
                ->addIndexColumn()
                ->make(true);
        }


        return view('pages.admin.pangkat.index', compact('jabatan', 'id', 'golongan'));
    }

    public function getPangkatDetails(Request $request)
    {
        $kode_pangkat = $request->kode_pangkat;
        $jabatan = jabatan::all();
        $golongan = golongan::all();

        $pangkatDetails = Pangkat::with('jabatan', 'golongan')->find($kode_pangkat);
        // dd($jurusanDetails);

        return response()->json(['jabatan' => $jabatan, 'golongan' => $golongan,  'details' => $pangkatDetails]);
    }

    public function updatePangkatDetails(Request $request)
    {
        $kode_pangkat = $request->kode_pangkat_id;

        $validator = Validator::make($request->all(), [
            'kode_pangkat' => 'required|max:10|min:3|unique:pangkat,kode_pangkat,' . $kode_pangkat . ',kode_pangkat',
            'nama_pangkat' => 'required|max:36|min:3|unique:pangkat,nama_pangkat,' . $kode_pangkat . ',kode_pangkat',
            'kode_jabatan' => 'nullable',

        ],  [
            'min' => 'Masukan :attribute minimal :min',
            'max' => 'Masukan :attribute maksimal :max',
            'required' => ':attribute harus diisi',
            'unique' => ':attribute yang dimasukan sudah ada'
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $pangkat = Pangkat::find($kode_pangkat);

            $pangkat->kode_pangkat = $request->kode_pangkat;
            $pangkat->kode_jabatan = $request->kode_jabatan;


            $pangkat->nama_pangkat = $request->nama_pangkat;


            $query = $pangkat->update();


            if ($query) {
                return response()->json(['code' => 1, 'msg' => 'Data Pangkat have Been updated']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            }
        }
    }

    public function deletePangkat(Request $request)
    {
        $kode_pangkat = $request->kode_pangkat;
        // $query = Pangkat::withCount(['pegawai'])->find($kode_pangkat);
        $query = Pangkat::find($kode_pangkat);
        $query->delete();
        // dd($query);
        // if ($query->pegawai_count == null) {
        //     $query->delete();
        //     if ($query) {
        //         return response()->json(['code' => 1, 'msg' => 'Data berhasil dihapus!']);
        //     } else {
        //         return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        //     }
        // }
        return response()->json(['code' => 1, 'msg' => 'Data Berhasil dihapus!']);
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

            'kode_pangkat' => 'required|max:36|min:3|unique:pangkat,kode_pangkat',
            'nama_pangkat' => 'required|max:36|min:3|unique:pangkat,nama_pangkat',
            // 'kode_jabatan' => 'nullable',
        ], [
            'min' => 'Masukan :attribute minimal :min',
            'max' => 'Masukan :attribute minimal :max',
            'required' => ':attribute harus diisi',
            'unique' => ':attribute yang dimasukan sudah ada'
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'errors' => $validator->errors()->toArray()]);
        } else {

            $post   =   Pangkat::Create(

                [
                    'kode_pangkat' => $request->kode_pangkat,
                    'nama_pangkat' => $request->nama_pangkat,
                    'kode_jabatan' => $request->kode_jabatan,


                ]
            );


            if ($post) {
                return response()->json(['status' => 1, 'msg' => 'Data Pangkat Berhasil disimpan']);
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