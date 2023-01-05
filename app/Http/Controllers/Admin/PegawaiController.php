<?php

namespace App\Http\Controllers\Admin;


use PDF;
use File;
use DateTime;
use Carbon\Carbon;
use App\Models\Dosen;
use App\Models\Pangkat;
use App\Models\Pegawai;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\SendEmailPensiun;
use App\Models\riwayat_pangkat;
use App\Models\jenjangPendidikan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailNotifPangkatPegawai;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pangkat = Pangkat::with('golongan')->get();

        $cek = Pegawai::count();
        if ($cek == 0) {
            $urut = 100001;
            $id = 'SDM'  . $urut;
        } else {
            $ambil = Pegawai::all()->last();
            $urut = (int)substr($ambil->id, -6) + 1;
            $id = 'SDM'  . $urut;
        }


        return view('pages.admin.pegawai.index', compact('pangkat', 'id'));
    }

    public function readDataPegawai(Request $request)
    {

        $pegawai = Pegawai::with('dosen', 'pangkat', 'golongan', 'notifPensiunPegawai', 'riwayatPangkatPegawai')->orderBy('created_at', 'DESC');


        $pegawai = Pegawai::query()->with('pangkat', 'golongan', 'dosen')->orderBy('created_at', 'ASC')
            ->where(function ($query) use ($request) {
                if ($request->input('search')) {
                    $search_text = $request->input('search');
                    $query->where('nama', 'Like', '%' . $search_text . '%')
                        ->orWhere('status', 'Like', '%' . $search_text . '%')
                        ->orWhere('kategori', 'Like', '%' . $search_text . '%')
                        ->orWhere('tgl_sk_yayasan', 'Like', '%' . $search_text . '%')
                        ->orWhereHas('pangkat', function ($query2) use ($search_text) {
                            $query2->where('nama_pangkat', 'Like', '%' . $search_text . '%');
                        })

                        ->orWhereHas('golongan', function ($query2) use ($search_text) {
                            $query2->where('nama_golongan', 'Like', '%' . $search_text . '%');
                        });
                }
            });

        $pegawai = $pegawai->paginate(6);
        if ($request->ajax()) {
            // $pegawai = $pegawai->paginate(6);
            return view('pages.admin.pegawai.read', compact('pegawai'))->render();
        }

        return view('pages.admin.pegawai.read', compact('pegawai'));
    }



    // public function getDataPegawai()
    // {

    //     $pegawai = Pegawai::with('jabatan', 'golongan')->get();

    //     return response()->json(['pegawai' => $pegawai]);
    // }

    public function getPangkatFromJabatan(Request $request)
    {

        $kode_jabatan = $request->kode_jabatan;

        $data = DB::table('pangkat')->where('kode_jabatan', $kode_jabatan)->get();
        return response()->json($data);
    }


    public function getGolonganFromPangkat(Request $request)
    {

        $kode_pangkat = $request->kode_pangkat;

        $data = DB::table('golongan')->where('kode_pangkat', $kode_pangkat)->get();
        return response()->json($data);
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
        if ($request->status == "Kontrak") {
            $validator_pegawai_kontrak = Validator::make($request->all(), [
                'jenis_kelamin' => 'required',
                'nama' => 'required|min:3|',
                'sd' => 'required|min:2|',
                'smp' => 'required|min:2|',
                'email' => 'required|min:3|unique:pegawai,email',
                'tmp_lahir' => 'required|min:3|',
                'tgl_lahir' => 'required|min:3|',
                'status' => 'required',
                'foto' => 'required|image|mimes:png,jpeg,jpg',
                'start_tgl_sk_kontrak' => 'required',
                'end_tgl_sk_kontrak' => 'required',
            ], [
                'min' => 'Masukan :attribute minimal :min',
                'max' => 'Masukan :attribute minimal :max',
                'required' => ':attribute harus diisi',
                'unique' => ':attribute yang dimasukan sudah ada'
            ]);
            if (!$validator_pegawai_kontrak->passes()) {
                return response()->json(['status' => 0, 'errors' => $validator_pegawai_kontrak->errors()->toArray()]);
            } else {
                if ($request->hasFile('foto')) {
                    $file = $request->file('foto');
                    $filename = time() . Str::slug($request->nama) . '.' . $file->getClientOriginalExtension();
                    $file->storeAs(
                        'public/assets/foto',
                        $filename
                    );

                    $post_pegawai = Pegawai::Create(
                        [
                            'id' => $request->id,
                            'npk' => $request->npk,
                            'nama' => $request->nama,
                            'email' => $request->email,
                            'tmp_lahir' => $request->tmp_lahir,
                            'tgl_lahir' => $request->tgl_lahir,
                            'tgl_sk_yayasan' => $request->tgl_sk_yayasan,
                            'start_tgl_sk_kontrak' => $request->start_tgl_sk_kontrak,
                            'end_tgl_sk_kontrak' => $request->end_tgl_sk_kontrak,
                            'status' => $request->status,
                            'kode_golongan' => $request->kode_golongan,
                            'kode_pangkat' => $request->kode_pangkat,
                            'verif_data_pangkat' => '',
                            'foto' => $filename,
                            'jenis_kelamin' => $request->jenis_kelamin,
                            'kategori' => 'Pegawai Non Akademik',
                        ]
                    );


                    jenjangPendidikan::Create(
                        [

                            'id' => $request->id,
                            'sd' => $request->sd,
                            'smp' => $request->smp,
                            'sma' => $request->sma,
                            'pendidikan_strata' => $request->pendidikan_strata,
                            'pendidikan_magister' => $request->pendidikan_magister,
                            'pendidikan_doctor' => $request->pendidikan_doctor,
                        ]
                    );


                    if ($post_pegawai) {
                        return response()->json(['status' => 1, 'msg' => 'Data Pegawai Berhasil disimpan']);
                    }
                }
            }
        } else if ($request->status == "Aktif") {
            $validator_pegawai_aktif = Validator::make($request->all(), [
                'npk' => 'required|unique:dosen,npk',
                'kode_pangkat' => 'required',
                'kode_golongan' => 'required',
                'nama' => 'required|min:3|',
                'email' => 'required|min:3|unique:pegawai,email',
                'tmp_lahir' => 'required|min:3|',
                'tgl_lahir' => 'required',
                'tgl_sk_yayasan' => 'required',
                'jenis_kelamin' => 'required',
                'status' => 'required',
                'verif_data_pangkat' => 'required',
                'foto' => 'required|image|mimes:png,jpeg,jpg'
            ], [
                'min' => 'Masukan :attribute minimal :min',
                'max' => 'Masukan :attribute minimal :max',
                'required' => ':attribute harus diisi',
                'unique' => ':attribute yang dimasukan sudah ada'
            ]);
            if (!$validator_pegawai_aktif->passes()) {
                return response()->json(['status' => 0, 'errors' => $validator_pegawai_aktif->errors()->toArray()]);
            } else {
                if ($request->hasFile('foto')) {
                    $file = $request->file('foto');
                    $filename = time() . Str::slug($request->nama) . '.' . $file->getClientOriginalExtension();
                    $file->storeAs(
                        'public/assets/foto',
                        $filename
                    );
                    $simpan_pegawai   =
                        Pegawai::Create(
                            [
                                'id' => $request->id,
                                'npk' => $request->npk,
                                'nama' => $request->nama,
                                'email' => $request->email,
                                'tmp_lahir' => $request->tmp_lahir,
                                'tgl_lahir' => $request->tgl_lahir,
                                'tgl_sk_yayasan' => $request->tgl_sk_yayasan,
                                'start_tgl_sk_kontrak' => $request->start_tgl_sk_kontrak,
                                'end_tgl_sk_kontrak' => $request->end_tgl_sk_kontrak,
                                'status' => $request->status,
                                'kode_golongan' => $request->kode_golongan,
                                'kode_pangkat' => $request->kode_pangkat,
                                'verif_data_pangkat' => $request->verif_data_pangkat,
                                'foto' => $filename,
                                'jenis_kelamin' => $request->jenis_kelamin,
                                'kategori' => 'Pegawai Non Akademik',

                            ]
                        );


                    $simpan_jenjangPendidikan = jenjangPendidikan::Create(
                        [

                            'id' => $request->id,
                            'sd' => $request->sd,
                            'smp' => $request->smp,
                            'sma' => $request->sma,
                            'pendidikan_strata' => $request->pendidikan_strata,
                            'pendidikan_magister' => $request->pendidikan_magister,
                            'pendidikan_doctor' => $request->pendidikan_doctor,
                        ]
                    );

                    if ($simpan_pegawai && $simpan_jenjangPendidikan) {
                        return response()->json(['status' => 1, 'msg' => 'Data Pegawai Berhasil disimpan']);
                    } else {
                        return response()->json(['status' => 0, 'msg' => 'Data Pegawai gagal disimpan']);
                    }
                }
            }
        }
    }

    public function getPegawaiDetails(Request $request)
    {

        $id = $request->id;
        $pangkat = Pangkat::all();

        $pegawaiDetails = Pegawai::with('dosen', 'jabatan', 'pangkat', 'golongan', 'jenjangPendidikanPegawai')->find($id);

        return response()->json(['pangkat' => $pangkat, 'details' => $pegawaiDetails]);
    }

    public function updatePegawaiDetails(Request $request)
    {
        // dd($request->sd);
        $id = $request->id;
        $npk = $request->npk;
        $email = $request->email;

        $pegawai = Pegawai::find($id);
        $filename = $pegawai->foto; //SIMPAN SEMENTARA NAMA FILE IMAGE SAAT INI
        // dd($pegawai->foto);

        if ($request->status == "Aktif" || $request->status == "Pensiun") {
            $validator = Validator::make($request->all(), [
                'npk' => 'required|max:10|min:3|unique:dosen,npk,' . $npk . ',npk',
                'kode_pangkat' => 'required',
                'kode_golongan' => 'required',
                'nama' => 'required|min:3|',
                'email' => 'required|min:3|unique:pegawai,email,' . $email . ',email',
                'tmp_lahir' => 'required|min:3|',
                'tgl_lahir' => 'required',
                'tgl_sk_yayasan' => 'required',
                'jenis_kelamin' => 'required',
                'status' => 'required',
                'verif_data_pangkat' => 'required',
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
                    $filename = time() . Str::slug($request->nama) . '.' . $file->getClientOriginalExtension();
                    // MAKA UPLOADA FILE TERSEBUT
                    $file->storeAs(
                        'public/assets/foto',
                        $filename

                    );
                    File::delete(public_path('storage/assets/foto/' . $pegawai->foto));
                }

                $dosen = Dosen::where('id', $id)->update(
                    [
                        'npk' =>  $request->npk,
                    ]
                );

                $query = Pegawai::where('id', $id)->update(
                    [
                        'id' => $request->id,
                        'npk' =>  $request->npk,
                        'kode_pangkat' =>  $request->kode_pangkat,
                        'kode_golongan' =>  $request->kode_golongan,
                        'nama' =>  $request->nama,
                        'email' =>  $request->email,
                        'jenis_kelamin' =>  $request->jenis_kelamin,
                        'tmp_lahir' =>  $request->tmp_lahir,
                        'tgl_lahir' =>  $request->tgl_lahir,
                        'tgl_sk_yayasan' =>  $request->tgl_sk_yayasan,
                        'foto' =>  $filename,
                        'status' =>  $request->status,
                        'verif_data_pangkat' =>  $request->verif_data_pangkat,
                    ]
                );



                $jenjangPendidikan = DB::table("jenjangPendidikan")->where("id", $id)->update(['sd' => $request->pendidikan_sd]);
                $jenjangPendidikan = DB::table("jenjangPendidikan")->where("id", $id)->update(['smp' => $request->pendidikan_smp]);
                $jenjangPendidikan = DB::table("jenjangPendidikan")->where("id", $id)->update(['sma' => $request->pendidikan_sma]);
                $jenjangPendidikan = DB::table("jenjangPendidikan")->where("id", $id)->update(['pendidikan_strata' => $request->pendidikan_strata_pegawai]);
                $jenjangPendidikan = DB::table("jenjangPendidikan")->where("id", $id)->update(['pendidikan_magister' => $request->pendidikan_magister_pegawai]);
                $jenjangPendidikan = DB::table("jenjangPendidikan")->where("id", $id)->update(['pendidikan_doctor' => $request->pendidikan_doctor_pegawai]);



                if ($query) {
                    return response()->json(['code' => 1, 'msg' => 'Data pegawai berhasil diperbarui']);
                } else {
                    return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
                }
            }
        } else if ($request->status == "Kontrak") {
            $validator = Validator::make($request->all(), [
                'nama' => 'required|min:3|',
                'email' => 'required|min:3|unique:pegawai,email,' . $email . ',email',
                'tmp_lahir' => 'required|min:3|',
                'tgl_lahir' => 'required',
                'start_tgl_sk_kontrak' => 'required',
                'end_tgl_sk_kontrak' => 'required',
                'jenis_kelamin' => 'required',
                'status' => 'required',
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
                    $filename = time() . Str::slug($request->nama) . '.' . $file->getClientOriginalExtension();
                    // MAKA UPLOADA FILE TERSEBUT
                    $file->storeAs(
                        'public/assets/foto',
                        $filename

                    );
                    File::delete(public_path('storage/assets/foto/' . $pegawai->foto));
                }

                Dosen::where('id', $id)->update(
                    [
                        'npk' =>  '',
                    ]
                );

                $query = Pegawai::where('id', $id)->update(
                    [
                        'nama' =>  $request->nama,
                        'email' =>  $request->email,
                        'jenis_kelamin' =>  $request->jenis_kelamin,
                        'tmp_lahir' =>  $request->tmp_lahir,
                        'tgl_lahir' =>  $request->tgl_lahir,
                        'foto' =>  $filename,
                        'status' =>  $request->status,
                        'start_tgl_sk_kontrak' =>  $request->start_tgl_sk_kontrak,
                        'end_tgl_sk_kontrak' =>  $request->end_tgl_sk_kontrak,
                        'kode_pangkat' =>  '',
                        'kode_golongan' =>  '',
                        'npk' =>  '',
                        'tgl_sk_yayasan' =>  null,
                        'verif_data_pangkat' =>  '',

                    ]
                );

                $jenjangPendidikan = DB::table("jenjangPendidikan")->where("id", $id)->update(['sd' => $request->pendidikan_sd]);
                $jenjangPendidikan = DB::table("jenjangPendidikan")->where("id", $id)->update(['smp' => $request->pendidikan_smp]);
                $jenjangPendidikan = DB::table("jenjangPendidikan")->where("id", $id)->update(['sma' => $request->pendidikan_sma]);
                $jenjangPendidikan = DB::table("jenjangPendidikan")->where("id", $id)->update(['pendidikan_strata' => $request->pendidikan_strata_pegawai]);
                $jenjangPendidikan = DB::table("jenjangPendidikan")->where("id", $id)->update(['pendidikan_magister' => $request->pendidikan_magister_pegawai]);
                $jenjangPendidikan = DB::table("jenjangPendidikan")->where("id", $id)->update(['pendidikan_doctor' => $request->pendidikan_doctor_pegawai]);



                if ($query) {
                    return response()->json(['code' => 1, 'msg' => 'Data pegawai berhasil diperbarui']);
                } else {
                    return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
                }
            }
        }
    }

    public function pegawaiReport()
    {
        //INISIASI 30 HARI RANGE SAAT INI JIKA HALAMAN PERTAMA KALI DI-LOAD
        //KITA GUNAKAN STARTOFMONTH UNTUK MENGAMBIL TANGGAL 1
        $start = Carbon::now()->startOfYear()->format('Y-m-d H:i:s');
        //DAN ENDOFMONTH UNTUK MENGAMBIL TANGGAL TERAKHIR DIBULAN YANG BERLAKU SAAT INI
        $end = Carbon::now()->endOfYear()->format('Y-m-d H:i:s');

        //JIKA USER MELAKUKAN FILTER MANUAL, MAKA PARAMETER DATE AKAN TERISI
        if (request()->date != '') {
            //MAKA FORMATTING TANGGALNYA BERDASARKAN FILTER USER
            $date = explode(' - ', request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
            $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';
        }

        //BUAT QUERY KE DB MENGGUNAKAN WHEREBETWEEN DARI TANGGAL FILTER
        $pegawai = Pegawai::with(['pangkat', 'golongan'])
            ->where('status', 'Pensiun')
            ->whereBetween('updated_at', [$start, $end])->get();
        //KEMUDIAN LOAD VIEW
        return view('pages.admin.pegawai.report-pegawai-view', compact('pegawai'));
    }

    public function pegawaiReportPdf($daterange)
    {
        $date = explode('+', $daterange); //EXPLODE TANGGALNYA UNTUK MEMISAHKAN START & END
        //DEFINISIKAN VARIABLENYA DENGAN FORMAT TIMESTAMPS
        $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
        $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

        //KEMUDIAN BUAT QUERY BERDASARKAN RANGE CREATED_AT YANG TELAH DITETAPKAN RANGENYA DARI $START KE $END
        $pegawai = Pegawai::with(['pangkat', 'golongan'])
            ->where('status', 'Pensiun')
            ->whereBetween('updated_at', [$start, $end])->get();
        //KEMUDIAN LOAD VIEW
        //LOAD VIEW UNTUK PDFNYA DENGAN MENGIRIMKAN DATA DARI HASIL QUERY
        $pdf = \PDF::loadView('pages.admin.pegawai.report-pegawai-pdf', compact('pegawai', 'date'));
        //GENERATE PDF-NYA
        return $pdf->stream();
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $pegawaiDetails = Pegawai::with('dosen', 'pangkat', 'golongan', 'jenjangPendidikanPegawai')->find($id);
        // dd($pegawaiDetails);

        return view('pages.admin.pegawai.detail-pegawai', [
            'pegawaiDetails' => $pegawaiDetails
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
    }

    public function deletePegawai(Request $request)
    {
        $id = $request->id;


        $pegawai = Pegawai::find($id);
        // dd($pegawai->foto);
        // File::delete(storage_path('storage/assets/foto/' . $pegawai->foto));
        if (File::exists(public_path('storage/assets/foto/' . $pegawai->foto))) {
            File::delete(public_path('storage/assets/foto/' . $pegawai->foto));
        } else {
            dd('File does not exists.');
        }
        $pegawai->delete();
        DB::table("jenjangPendidikan")->where("id", $id)->delete();
        DB::table("dosen")->where("id", $id)->delete();
        return response()->json(['code' => 1, 'msg' => 'Data Pegawai Berhasil dihapus!']);
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