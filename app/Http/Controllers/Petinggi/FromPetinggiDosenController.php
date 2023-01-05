<?php

namespace App\Http\Controllers\Petinggi;

use DB;
use Auth;
use Carbon\Carbon;
use App\Models\Dosen;
use App\Models\golongan;

use App\Models\notifPangkat;
use App\Models\notifPensiun;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\dosen\NotifPensiunDosen;



class FromPetinggiDosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $npk = Auth::guard('petinggi')->user()->npk;


        // $dataPensiun = notifPensiun::where('created_at', '<', Carbon::now()->subMinute(2))->delete();

        // $dataPangkat = notifPangkat::where('created_at', '<', Carbon::now()->subDays(2))->delete();

        $keyword = request('search');



        return view('pages.petinggi.dosen.index', compact('keyword'));
    }

    public function readDataDosenSectionPetinggi(Request $request)
    {

        // dd($request->input('date'));
        $dosen = Dosen::query()->with('pegawai', 'jurusan', 'fakultas', 'jenjangPendidikan')
            ->where(function ($query) use ($request) {
                if ($request->input('search')) {
                    $search_text = $request->input('search');
                    $query->where('npk', 'Like', '%' . $search_text . '%')
                        ->orWhere('nidn', 'Like', '%' . $search_text . '%')
                        ->orWhereHas('pegawai', function ($query2) use ($search_text) {
                            $query2->where('nama', 'Like', '%' . $search_text . '%');
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
            return view('pages.petinggi.dosen.read', compact('dosen'))->render();
        }
        return view('pages.petinggi.dosen.read', compact('dosen'));
    }

    // public function notifPensiunDosen(Request $request)
    // {
    //     // $id = notifPensiun::kodeNotifPensiun();
    //     $npk = Auth::guard('petinggi')->user()->npk;
    //     $nidn = $request->nidn;

    //     $sendDosen = Dosen::find($nidn);
    //     // dd($sendDosen);
    //     Mail::to($sendDosen->email)->send(
    //         new  NotifPensiunDosen($sendDosen)
    //     );

    //     $sendDosen   =   notifPensiun::Create(
    //         [

    //             'npk' => $npk,
    //             'kode_penerima' => $sendDosen->nidn,
    //             'status' => 'Terkirim',
    //         ]
    //     );

    //     return redirect('petinggi/halaman-dosen-petinggi')->with('success', 'Pesan Terikirim');
    // }



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
        $dosenDetails = Dosen::with('pegawai', 'fakultas', 'jurusan', 'jenjangPendidikan')->find($id);
        // dd($dosenDetails);

        return view('pages.petinggi.dosen.detail-dosen', [
            'dosenDetails' => $dosenDetails
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