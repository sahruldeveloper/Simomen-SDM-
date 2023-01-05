<?php

namespace App\Http\Controllers\Petinggi;

use Carbon\Carbon;
use App\Models\Pegawai;
use App\Models\golongan;
use App\Models\notifPangkat;
use App\Models\notifPensiun;
use Illuminate\Http\Request;
use App\Models\notifPangkatPegawai;
use App\Models\notifPensiunPegawai;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\pegawai\EmailPangkatPegawai;
use App\Mail\pegawai\NotifPensiunPegawaiFromPetinggi;



class FromPetinggiPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pegawai = Pegawai::with('pangkat', 'golongan', 'dosen', 'notifPangkatPegawai', 'riwayatPangkatPegawai')->orderBy('created_at', 'DESC');
        $golongan = golongan::all();

        // notifPensiun::where('created_at', '<', Carbon::now()->subMinute(4))->delete();
        notifPangkat::where('created_at', '<', Carbon::now()->subMinute(2))->delete();



        return view('pages.petinggi.pegawai.index', compact('golongan', 'pegawai'));
    }

    public function readDataPegawaiSectionPetinggi(Request $request)
    {

        // dd($request->input('date'));
        $pegawai = Pegawai::query()->with('pangkat', 'golongan', 'dosen', 'notifPangkatPegawai', 'riwayatPangkatPegawai')->orderBy('created_at', 'DESC')
            ->where(function ($query) use ($request) {
                if ($request->input('search')) {
                    $search_text = $request->input('search');
                    $query->where('nama', 'Like', '%' . $search_text . '%')
                        ->orWhere('status', 'Like', '%' . $search_text . '%')
                        ->orWhere('npk', 'Like', '%' . $search_text . '%')
                        ->orWhere('tgl_sk_yayasan', 'Like', '%' . $search_text . '%')
                        ->orWhereHas('pangkat', function ($query2) use ($search_text) {
                            $query2->where('nama_pangkat', 'Like', '%' . $search_text . '%');
                        })
                        ->orWhereHas('dosen', function ($query2) use ($search_text) {
                            $query2->where('nidn', 'Like', '%' . $search_text . '%');
                        })
                        ->orWhereHas('golongan', function ($query2) use ($search_text) {
                            $query2->where('nama_golongan', 'Like', '%' . $search_text . '%');
                        });
                } else if ($request->input('date')) {

                    $date = explode(' - ', request()->date);
                    $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
                    $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';
                    $query->whereBetween('updated_at', [$start, $end]);
                }
            });


        $pegawai = $pegawai->paginate(6);

        if ($request->ajax()) {
            // $pegawai = $pegawai->paginate(6);
            return view('pages.petinggi.pegawai.read', compact('pegawai'))->render();
        }
        return view('pages.petinggi.pegawai.read', compact('pegawai'));
    }

    // public function notifPensiunPegawai(Request $request)
    // {
    //     // $id = notifPensiun::kodeNotifPensiun();
    //     $npk = Auth::guard('petinggi')->user()->npk;
    //     $id = $request->npk;

    //     $sendPegawai = Pegawai::find($id);
    //     // return view('email.NotifValidasiBerkasPensiunPegawai', compact('sendPegawai'));
    //     // return $sendPegawai;
    //     Mail::to($sendPegawai->email)->send(
    //         new NotifPensiunPegawaiFromPetinggi($sendPegawai)
    //     );

    //     $sendPegawai   =   notifPensiun::Create(
    //         [
    //             'npk' => $npk,
    //             'kode_penerima' => $sendPegawai->npk,
    //             'status' => 'Terkirim',
    //         ]
    //     );

    //     return redirect('petinggi/halaman-pegawai-petinggi')->with('success', 'Notifikasi Pensiun Terikirim');
    // }

    public function notifPangkatPegawai(Request $request, $id)
    {

        // $id = notifPensiun::kodeNotifPensiun();
        $id_pengirim = Auth::guard('petinggi')->user()->id;

        $sendPegawai = Pegawai::find($id);

        // return view('email.NotifValidasiBerkasPensiunPegawai', compact('sendPegawai'));
        // return $sendPegawai;
        Mail::to($sendPegawai->email)->send(
            new EmailPangkatPegawai($sendPegawai)
        );

        $sendPegawai   =   notifPangkat::Create(
            [
                'kode_pengirim' => $id_pengirim,
                'kode_penerima' => $sendPegawai->id,
                'status' => 'Terkirim',
            ]
        );

        return redirect('petinggi/halaman-pegawai-petinggi')->with('success', 'Notifikasi Berkas Pangkat Terikirim');
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
        $pegawaiDetails = Pegawai::with('dosen', 'pangkat', 'golongan', 'jenjangPendidikanPegawai')->find($id);
        // dd($pegawaiDetails);

        return view('pages.petinggi.pegawai.detail-pegawai', [
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