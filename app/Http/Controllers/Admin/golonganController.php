<?php

namespace App\Http\Controllers\Admin;

use App\Models\jabatan;
use App\Models\Pangkat;
use App\Models\golongan;
use Illuminate\Http\Request;
use Yajra\DataTables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class golonganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pangkat = Pangkat::all();
        $golongan = golongan::with(['pangkat']);
        $id = golongan::kodeGolongan();

        // Mengirim kondisi melalui ajax
        if ($request->ajax()) {
            return datatables()->of($golongan)
                ->addColumn('action', function ($data) {
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-kode_golongan="' . $data->kode_golongan . '" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post-golongan"><i class="far fa-edit"></i> Edit</a>';
                    $button .= '&nbsp;&nbsp;';

                    $button .= ' <button class="btn btn-sm btn-danger" data-id="' . $data->kode_golongan . '" id="deleteGolonganBtn"><i class="fa-regular fa-trash-can"></i> Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }


        return view('pages.admin.golongan.index', compact('pangkat', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $golongan = golongan::all();
        // return view('pages.golongan.index', compact('golongan'));
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
            'kode_golongan' => 'required|max:10|min:3|unique:golongan,kode_golongan',
            'kode_pangkat' => 'required|max:10|min:3|unique:golongan,kode_pangkat',
            'nama_golongan' => 'required|max:36|min:3',
            'keterangan' => 'required|max:36|min:3',

        ], [
            'min' => 'Masukan :attribute minimal :min',
            'max' => 'Masukan :attribute minimal :max',
            'required' => ':attribute harus diisi',
            'unique' => ':attribute yang dimasukan sudah ada'
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'errors' => $validator->errors()->toArray()]);
        } else {

            $post   =   golongan::Create(

                [
                    'kode_golongan' => $request->kode_golongan,
                    'kode_pangkat' => $request->kode_pangkat,
                    'nama_golongan' => $request->nama_golongan,
                    'keterangan' => $request->keterangan,
                ]
            );


            if ($post) {
                return response()->json(['status' => 1, 'msg' => 'Data Berhasil disimpan']);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     */
    //GET GOLONGAN DETAILS
    public function getGolonganDetails(Request $request)
    {

        $kode_golongan = $request->kode_golongan;
        $pangkat = Pangkat::all();

        $golonganDetails = golongan::with('pangkat')->find($kode_golongan);

        return response()->json(['pangkat' => $pangkat, 'details' => $golonganDetails]);
    }

    public function updateGolonganDetails(Request $request)
    {
        $kode_golongan = $request->kode_golongan_id;

        $validator = Validator::make($request->all(), [
            'kode_golongan' => 'required|max:10|min:3|unique:golongan,kode_golongan,' . $kode_golongan . ',kode_golongan',
            'kode_pangkat' => 'required|max:10|min:3|unique:golongan,kode_pangkat,' . $kode_golongan . ',kode_golongan',
            'nama_golongan' => 'required|max:36|min:3|',
            'keterangan' => 'required|max:36|min:3',

        ], [
            'min' => 'Masukan :attribute minimal :min',
            'max' => 'Masukan :attribute maksimal :max',
            'required' => ':attribute harus diisi',
            'unique' => ':attribute yang dimasukan sudah ada'
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            // golongan::where('kode_golongan', $request->kode_golongan)->update([
            //     'kode_golongan' => $request->kode_golongan,
            //     'nama_golongan' => $request->nama_golongan,
            // ]);

            // $query =  DB::table('golongan')->where('kode_golongan', $request->kode_golongan)->update($update);

            $golongan = golongan::find($kode_golongan);

            // $golongan->kode_golongan = $request->kode_golongan;
            $golongan->kode_pangkat = $request->kode_pangkat;

            $golongan->nama_golongan = $request->nama_golongan;
            $golongan->keterangan = $request->keterangan;


            $query = $golongan->update();


            if ($query) {
                // return response()->json(['code' => 1, 'msg' => 'Country Details have Been updated']);
                return response()->json(['mantul', $query]);
            } else {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            }
        }
    }

    public function deleteGolongan(Request $request)
    {
        $kode_golongan = $request->kode_golongan;
        $query = golongan::withCount(['pangkat'])->find($kode_golongan);

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
    public function edit(Request $request)

    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $post)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}