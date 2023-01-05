<?php

namespace App\Http\Controllers\Admin;


use File;
use Carbon\Carbon;
use App\Models\Dosen;
use App\Models\jabatan;
use App\Models\Pangkat;
use App\Models\Pegawai;
use App\Models\fakultas;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Str;
use App\Models\dosenKontrak;
use Illuminate\Http\Request;
use App\Models\jenjangPendidikan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dosen = Dosen::with('pegawai.pangkat', 'jurusan', 'fakultas')->orderBy('created_at', 'DESC');
        $jabatan = jabatan::all();
        $pangkat = pangkat::all();
        $fakultas = fakultas::all();
        $now = Carbon::now();
        // $thnBulan = $now->year . $now->month;
        $cek = Pegawai::count();
        if ($cek == 0) {
            $urut = 100001;
            $id = 'SDM'  . $urut;
        } else {
            $ambil = Pegawai::all()->last();
            $urut = (int)substr($ambil->id, -6) + 1;
            $id = 'SDM'  . $urut;
        }


        $dosen = $dosen->paginate(6);


        // return response()->json($dosen);
        return view('pages.admin.dosen.index', compact('jabatan', 'pangkat', 'dosen', 'fakultas', 'id'));
    }

    public function readDataDosen(Request $request)
    {
        // $dosen = Dosen::with('pangkat', 'jabatan', 'jurusan', 'fakultas')->orderBy('created_at', 'DESC');

        // if (request('search')) {
        //     $dosen = Dosen::where('nama_dosen', 'LIKE', '%' . request('search') . '%');
        // }
        $dosen = Dosen::query()->with('pegawai', 'jurusan', 'fakultas', 'jenjangPendidikan')
            ->where(function ($query) use ($request) {
                if ($request->input('search')) {
                    $search_text = $request->input('search');
                    $query->where('npk', 'Like', '%' . $search_text . '%')
                        ->orWhere('nidn', 'Like', '%' . $search_text . '%')
                        ->orWhereHas('pegawai', function ($query2) use ($search_text) {
                            $query2->where('nama', 'Like', '%' . $search_text . '%');
                            $query2->where('status', 'Like', '%' . $search_text . '%');
                        })
                        ->orWhereHas('pegawai.pangkat', function ($query2) use ($search_text) {
                            $query2->where('nama_pangkat', 'Like', '%' . $search_text . '%');
                        })
                        ->orWhereHas('jurusan', function ($query2) use ($search_text) {
                            $query2->where('nama_jurusan', 'Like', '%' . $search_text . '%');
                        })
                        ->orWhereHas('fakultas', function ($query2) use ($search_text) {
                            $query2->where('nama_fakultas', 'Like', '%' . $search_text . '%');
                        });
                }
            });

        $dosen = $dosen->paginate(6);

        if ($request->ajax()) {
            // $pegawai = $pegawai->paginate(6);
            return view('pages.admin.dosen.read', compact('dosen'))->render();
        }

        return view('pages.admin.dosen.read', compact('dosen'));
    }

    public function getJurusanFromFakultas(Request $request)
    {
        $kode_fakultas = $request->kode_fakultas;
        $data = DB::table('jurusan')->where('kode_fakultas', $kode_fakultas)->get();
        return response()->json($data);
    }

    public function dosenReport()
    {
        //INISIASI 30 HARI RANGE SAAT INI JIKA HALAMAN PERTAMA KALI DI-LOAD
        //KITA GUNAKAN STARTOFMONTH UNTUK MENGAMBIL TANGGAL 1
        $start = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        //DAN ENDOFMONTH UNTUK MENGAMBIL TANGGAL TERAKHIR DIBULAN YANG BERLAKU SAAT INI
        $end = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        //JIKA USER MELAKUKAN FILTER MANUAL, MAKA PARAMETER DATE AKAN TERISI

        if (request()->date != '') {
            //MAKA FORMATTING TANGGALNYA BERDASARKAN FILTER USER
            $date = explode(' - ', request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
            $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';
        }
        $pensiun = "Pensiun";

        //BUAT QUERY KE DB MENGGUNAKAN WHEREBETWEEN DARI TANGGAL FILTER
        $dosen = Dosen::with(['pegawai.pangkat', 'pegawai.jabatan', 'jurusan', 'fakultas'])
            ->orWhereHas('pegawai', function ($query2) use ($pensiun) {
                $query2->where('status', 'Pensiun');
            })->whereBetween('updated_at', [$start, $end])->get();
        //KEMUDIAN LOAD VIEW
        return view('pages.admin.dosen.report-dosen-view', compact('dosen'));
    }

    public function dosenReportPdf($daterange)
    {
        $date = explode('+', $daterange); //EXPLODE TANGGALNYA UNTUK MEMISAHKAN START & END

        //DEFINISIKAN VARIABLENYA DENGAN FORMAT TIMESTAMPS
        $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
        $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';

        //KEMUDIAN BUAT QUERY BERDASARKAN RANGE CREATED_AT YANG TELAH DITETAPKAN RANGENYA DARI $START KE $END
        $pensiun = "Pensiun";

        //BUAT QUERY KE DB MENGGUNAKAN WHEREBETWEEN DARI TANGGAL FILTER
        $dosen = Dosen::with(['pegawai.pangkat', 'pegawai', 'jurusan', 'fakultas'])
            ->orWhereHas('pegawai', function ($query2) use ($pensiun) {
                $query2->where('status', 'Pensiun');
            })->whereBetween('updated_at', [$start, $end])->get();
        //KEMUDIAN LOAD VIEW
        //LOAD VIEW UNTUK PDFNYA DENGAN MENGIRIMKAN DATA DARI HASIL QUERY
        $pdf = \PDF::loadView('pages.admin.dosen.report-dosen-pdf', compact('dosen', 'date'));
        //GENERATE PDF-NYA
        return $pdf->stream();
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

    public function getGolonganFromPangkatDosen(Request $request)
    {
        $kode_pangkat = $request->kode_pangkat;

        $data = DB::table('golongan')->where('kode_pangkat', $kode_pangkat)->get();
        return response()->json($data);
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
        if ($request->status == "Kontrak") {
            $validator_dosen_kontrak = Validator::make($request->all(), [
                'jenis_kelamin' => 'required',
                'kode_fakultas' => 'required',
                'kode_jurusan' => 'required',
                'nama' => 'required|min:3|',
                'sd' => 'required|min:2|',
                'smp' => 'required|min:2|',
                'sma' => 'required|min:2|',
                'pendidikan_strata' => 'required|min:2|',
                'pendidikan_magister' => 'required|min:2|',
                'start_tgl_sk_kontrak' => 'required',
                'end_tgl_sk_kontrak' => 'required',
                'email' => 'required|min:3|unique:pegawai,email',
                'tmp_lahir' => 'required|min:3|',
                'tgl_lahir' => 'required|min:3|',

                'status' => 'required',
                'foto' => 'required|image|mimes:png,jpeg,jpg'
            ], [
                'min' => 'Masukan :attribute minimal :min',
                'max' => 'Masukan :attribute minimal :max',
                'required' => ':attribute harus diisi',
                'unique' => ':attribute yang dimasukan sudah ada'
            ]);
            if (!$validator_dosen_kontrak->passes()) {
                return response()->json(['status' => 0, 'errors' => $validator_dosen_kontrak->errors()->toArray()]);
            } else {
                if ($request->hasFile('foto')) {
                    $file = $request->file('foto');
                    $filename = time() . Str::slug($request->nama) . '.' . $file->getClientOriginalExtension();
                    $file->storeAs(
                        'public/assets/foto',
                        $filename
                    );
                    $post_dosen   =
                        Dosen::Create(
                            [
                                'id' => $request->id,
                                'npk' => $request->npk,
                                'nidn' => $request->nidn,
                                'tgl_sk_uir' => $request->tgl_sk_yayasan,
                                'start_tgl_sk_kontrak' => $request->start_tgl_sk_kontrak,
                                'end_tgl_sk_kontrak' => $request->end_tgl_sk_kontrak,
                                'kode_jabatan' => $request->kode_jabatan,
                                'kode_fakultas' => $request->kode_fakultas,
                                'kode_jurusan' => $request->kode_jurusan,
                            ]
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
                            'verif_data_pangkat' => $request->verif_data_pangkat,
                            'foto' => $filename,
                            'jenis_kelamin' => $request->jenis_kelamin,
                            'kategori' => 'Pegawai Akademik(Dosen)',
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

                    if ($post_dosen) {
                        return response()->json(['status' => 1, 'msg' => 'Data Dosen Berhasil disimpan']);
                    }
                    if ($post_pegawai) {
                        return response()->json(['status' => 1, 'msg' => 'Data Pegawai Berhasil disimpan']);
                    }
                }
            }
        } else if ($request->status == "Aktif") {
            $validator_dosen_aktif = Validator::make($request->all(), [
                'nidn' => 'required|unique:dosen,nidn',
                'npk' => 'required|unique:dosen,npk',
                'npk' => 'required|unique:pegawai,npk',
                'kode_fakultas' => 'required',
                'kode_jurusan' => 'required',
                'kode_pangkat' => 'required',
                'kode_golongan' => 'required',
                'kode_jabatan' => 'required',
                'nama' => 'required|min:3|',
                'sd' => 'required|min:2|',
                'smp' => 'required|min:2|',
                'sma' => 'required|min:2|',
                'pendidikan_strata' => 'required|min:2|',
                'pendidikan_magister' => 'required|min:2|',
                'email' => 'required|min:3|unique:pegawai,email',
                'tmp_lahir' => 'required|min:3|',
                'tgl_lahir' => 'required',
                'tgl_sk_uir' => 'required',
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
            if (!$validator_dosen_aktif->passes()) {
                return response()->json(['status' => 0, 'errors' => $validator_dosen_aktif->errors()->toArray()]);
            } else {
                if ($request->hasFile('foto')) {
                    $file = $request->file('foto');
                    $filename = time() . Str::slug($request->nama) . '.' . $file->getClientOriginalExtension();
                    $file->storeAs(
                        'public/assets/foto',
                        $filename
                    );
                    $post   =
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
                                'kode_jabatan' => $request->kode_jabatan,
                                'verif_data_pangkat' => $request->verif_data_pangkat,
                                'foto' => $filename,
                                'jenis_kelamin' => $request->jenis_kelamin,
                                'kategori' => 'Pegawai Akademik(Dosen)',

                            ]
                        );
                    Dosen::Create(
                        [
                            'id' => $request->id,
                            'npk' => $request->npk,
                            'nidn' => $request->nidn,
                            'tgl_sk_uir' => $request->tgl_sk_yayasan,
                            'start_tgl_sk_kontrak' => $request->start_tgl_sk_kontrak,
                            'end_tgl_sk_kontrak' => $request->end_tgl_sk_kontrak,
                            'kode_fakultas' => $request->kode_fakultas,
                            'kode_jurusan' => $request->kode_jurusan,
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

                    if ($post) {
                        return response()->json(['status' => 1, 'msg' => 'Data Pegawai Berhasil disimpan']);
                    } else {
                        return response()->json(['status' => 0, 'msg' => 'Data Pegawai gagal disimpan']);
                    }
                }
            }
        }
    }

    public function getDosenDetails(Request $request)
    {

        $nidn = $request->id;

        $jabatan = jabatan::all();

        $fakultas = Fakultas::all();
        $jenjangPendidikan = jenjangPendidikan::all();

        $dosenDetails = Dosen::with('pegawai', 'pegawai.jabatan', 'pegawai.pangkat', 'pegawai.golongan', 'fakultas', 'jurusan', 'jenjangPendidikan')->find($nidn);


        return response()->json(['jabatan' => $jabatan, 'fakultas' => $fakultas, 'details' => $dosenDetails]);
    }

    public function updateDosenDetails(Request $request)
    {


        $id = $request->id;
        $nidn = $request->nidn;
        $npk = $request->npk;
        $email = $request->email;

        $pegawai = Pegawai::find($id);

        $filename = $pegawai->foto; //SIMPAN SEMENTARA NAMA FILE IMAGE SAAT INI

        if ($request->status == "Aktif" || $request->status == "Pensiun") {
            $validator = Validator::make($request->all(), [
                'nidn' => 'required|max:10|min:3|unique:dosen,nidn,' . $nidn . ',nidn',
                'npk' => '|max:10|min:3|unique:dosen,npk,' . $npk . ',npk',
                'kode_fakultas' => 'required',
                'kode_jurusan' => 'required',
                'kode_pangkat' => 'required',
                'kode_golongan' => 'required',
                'kode_jabatan' => 'required',
                'nama' => 'required|min:3|',
                'pendidikan_strata' => 'required|min:2|',
                'pendidikan_magister' => 'required|min:2|',
                'email' => 'required|min:3|unique:pegawai,email,' . $email . ',email',
                'tmp_lahir' => 'required|min:3|',
                'tgl_lahir' => 'required',
                'tgl_sk_uir' => 'required',
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

                $query = Dosen::where('id', $id)->update(
                    [
                        'npk' =>  $request->npk,
                        'nidn' =>  $request->nidn,
                        'tgl_sk_uir' =>  $request->tgl_sk_uir,
                        'kode_jurusan' =>  $request->kode_jurusan,

                        'kode_fakultas' =>  $request->kode_fakultas,

                    ]
                );


                $pegawai = DB::table("pegawai")->where("id", $id)->update(['npk' => $request->npk]);
                $pegawai = DB::table("pegawai")->where("id", $id)->update(['kode_pangkat' => $request->kode_pangkat]);
                $pegawai = DB::table("pegawai")->where("id", $id)->update(['kode_golongan' => $request->kode_golongan]);
                $pegawai = DB::table("pegawai")->where("id", $id)->update(['kode_jabatan' => $request->kode_jabatan]);
                $pegawai = DB::table("pegawai")->where("id", $id)->update(['nama' => $request->nama]);
                $pegawai = DB::table("pegawai")->where("id", $id)->update(['email' => $request->email]);
                $pegawai = DB::table("pegawai")->where("id", $id)->update(['jenis_kelamin' => $request->jenis_kelamin]);
                $pegawai = DB::table("pegawai")->where("id", $id)->update(['tmp_lahir' => $request->tmp_lahir]);
                $pegawai = DB::table("pegawai")->where("id", $id)->update(['tgl_lahir' => $request->tgl_lahir]);
                $pegawai = DB::table("pegawai")->where("id", $id)->update(['tgl_sk_yayasan' => $request->tgl_sk_yayasan]);

                $pegawai = DB::table("pegawai")->where("id", $id)->update(['foto' => $filename]);
                $pegawai = DB::table("pegawai")->where("id", $id)->update(['status' => $request->status]);
                $pegawai = DB::table("pegawai")->where("id", $id)->update(['verif_data_pangkat' => $request->verif_data_pangkat]);


                jenjangPendidikan::where("id", $id)->update([
                    'sd' => $request->sd,
                    'smp' => $request->smp,
                    'sma' => $request->sma,
                    'pendidikan_strata' => $request->pendidikan_strata,
                    'pendidikan_magister' => $request->pendidikan_magister,
                    'pendidikan_doctor' => $request->pendidikan_doctor
                ]);



                if ($query) {
                    return response()->json(['code' => 1, 'msg' => 'Data pegawai berhasil diperbarui']);
                } else {
                    return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
                }
            }
        } else if ($request->status == "Kontrak") {
            $validator = Validator::make($request->all(), [
                'kode_fakultas' => 'required',
                'kode_jurusan' => 'required',
                'nama' => 'required|min:3|',
                'pendidikan_strata' => 'required|min:2|',
                'pendidikan_magister' => 'required|min:2|',
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

                $query = Dosen::where('id', $id)->update(
                    [

                        'npk' =>  '',
                        'nidn' =>  '',
                        'tgl_sk_uir' =>  null,
                        'kode_jurusan' =>  $request->kode_jurusan,
                        'kode_jabatan' =>  $request->kode_jabatan,
                        'kode_fakultas' =>  $request->kode_fakultas,
                    ]
                );



                $pegawai = DB::table("pegawai")->where("id", $id)->update(['nama' => $request->nama]);
                $pegawai = DB::table("pegawai")->where("id", $id)->update(['email' => $request->email]);
                $pegawai = DB::table("pegawai")->where("id", $id)->update(['jenis_kelamin' => $request->jenis_kelamin]);
                $pegawai = DB::table("pegawai")->where("id", $id)->update(['tmp_lahir' => $request->tmp_lahir]);
                $pegawai = DB::table("pegawai")->where("id", $id)->update(['tgl_lahir' => $request->tgl_lahir]);
                $pegawai = DB::table("pegawai")->where("id", $id)->update(['foto' => $filename]);
                $pegawai = DB::table("pegawai")->where("id", $id)->update(['status' => $request->status]);
                $pegawai = DB::table("pegawai")->where("id", $id)->update(['start_tgl_sk_kontrak' => $request->start_tgl_sk_kontrak]);
                $pegawai = DB::table("pegawai")->where("id", $id)->update(['end_tgl_sk_kontrak' => $request->end_tgl_sk_kontrak]);
                $pegawai = DB::table("pegawai")->where("id", $id)->update(['kode_pangkat' => '']);
                $pegawai = DB::table("pegawai")->where("id", $id)->update(['kode_golongan' => '']);
                $pegawai = DB::table("pegawai")->where("id", $id)->update(['npk' => '']);
                $pegawai = DB::table("pegawai")->where("id", $id)->update(['verif_data_pangkat' => '']);
                $pegawai = DB::table("pegawai")->where("id", $id)->update(['tgl_sk_yayasan' => null]);


                jenjangPendidikan::where("id", $id)->update([
                    'sd' => $request->sd,
                    'smp' => $request->smp,
                    'sma' => $request->sma,
                    'pendidikan_strata' => $request->pendidikan_strata,
                    'pendidikan_magister' => $request->pendidikan_magister,
                    'pendidikan_doctor' => $request->pendidikan_doctor
                ]);


                if ($query) {
                    return response()->json(['code' => 1, 'msg' => 'Data pegawai berhasil diperbarui']);
                } else {
                    return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
                }
            }
        }
    }

    public function deleteDosen(Request $request)
    {
        $id = $request->id;

        $dosen = Dosen::find($id);

        // File::delete(storage_path('storage/assets/foto/' . $dosen->foto));
        if (File::exists(public_path('storage/assets/foto/' . $dosen->foto))) {
            File::delete(public_path('storage/assets/foto/' . $dosen->foto));
        } else {
            dd('File does not exists.');
        }
        DB::table("jenjangPendidikan")->where("id", $id)->delete();
        DB::table("pegawai")->where("id", $id)->delete();
        $dosen->delete();

        return response()->json(['code' => 1, 'msg' => 'Data Dosen Berhasil dihapus!']);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nidn)
    {
        $dosenDetails = Dosen::with('pegawai', 'pegawai', 'fakultas', 'jurusan', 'jenjangPendidikan')->find($nidn);
        // dd($dosenDetails);

        return view('pages.admin.dosen.detail-dosen', [
            'dosenDetails' => $dosenDetails,
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