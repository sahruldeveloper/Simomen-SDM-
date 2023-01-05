<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetinggiDashboardController extends Controller
{
    public function index(Request $request)
    {

        $data_dosen = Dosen::with('pegawai')->paginate(2);
        $data_pegawai = Pegawai::orderBy('tgl_sk_yayasan', 'DESC')->paginate(2);
        $total_aktif_pegawai = Pegawai::where('status', 'aktif')->count();
        $total_pensiun_pegawai = Pegawai::where('status', 'PENSIUN')->count();
        $total_pensiun_dosen = Pegawai::where([
            ['status', 'PENSIUN'],
            ['kategori', 'Pegawai Akademik(Dosen)']
        ])->count();
        $total_aktif_dosen = Pegawai::where([
            ['status', 'Aktif'],
            ['kategori', 'Pegawai Akademik(Dosen)']
        ])->count();
        // $total_aktif_dosen = Dosen::where('status', 'aktif')->count();



        $bulan = Pegawai::select(DB::raw("MONTHNAME(created_at) as bulan"))
            ->GroupBy(DB::raw("MONTHNAME(created_at)"))
            ->pluck('bulan');

        $pegawai_pensiun = Pegawai::select(\DB::raw("COUNT(*) as count"))
            ->where('status', 'PENSIUN')
            ->whereYear('created_at', date('Y'))
            ->groupBy(\DB::raw("Month(created_at)"))
            ->orderByDesc('created_at')
            ->pluck('count');

        $pegawai_aktif = Pegawai::select(\DB::raw("COUNT(*) as count"))
            ->where('status', 'aktif')
            ->whereYear('created_at', date('Y'))
            ->groupBy(\DB::raw("Month(created_at)"))

            ->pluck('count');

        $bulan_data_dosen = Dosen::select(DB::raw("MONTHNAME(created_at) as bulan"))
            ->GroupBy(DB::raw("MONTHNAME(created_at)"))
            ->pluck('bulan');

        $dosen_pensiun = Pegawai::select(\DB::raw("COUNT(*) as count"))
            ->where([
                ['status', 'PENSIUN'],
                ['kategori', 'Pegawai Akademik(Dosen)']
            ])
            ->whereYear('created_at', date('Y'))
            ->groupBy(\DB::raw("Month(created_at)"))
            ->orderByDesc('created_at')
            ->pluck('count');

        $dosen_aktif = Pegawai::select(\DB::raw("COUNT(*) as count"))
            ->where([
                ['status', 'aktif'],
                ['kategori', 'Pegawai Akademik(Dosen)']
            ])
            ->whereYear('created_at', date('Y'))
            ->groupBy(\DB::raw("Month(created_at)"))

            ->pluck('count');


        return view('pages.dashboard-petinggi',  compact('dosen_aktif', 'dosen_pensiun', 'data_dosen', 'data_pegawai', 'total_aktif_pegawai', 'total_pensiun_pegawai', 'total_pensiun_dosen', 'total_aktif_dosen', 'bulan', 'pegawai_pensiun', 'pegawai_aktif'));
    }

    public function welcome()
    {
        // $data_petinggi = Auth::guard('petinggi')->user();
        return view('pages.welcome-petinggi');
    }
}