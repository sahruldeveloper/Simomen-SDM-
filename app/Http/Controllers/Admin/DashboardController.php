<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dosen;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
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



        $bulan_data_pegawai_aktif = Pegawai::select(DB::raw("MONTHNAME(tgl_sk_yayasan) as bulan"))
            ->where('tgl_sk_yayasan', '!=', 'null')
            ->where('status', 'Aktif')
            ->GroupBy(DB::raw("MONTHNAME(tgl_sk_yayasan)"))
            ->pluck('bulan');
        // dd($bulan_data_pegawai_aktif);



        $bulan_data_pegawai_pensiun = Pegawai::select(DB::raw("MONTHNAME(created_at) as bulan"))
            ->GroupBy(DB::raw("MONTHNAME(created_at)"))
            ->pluck('bulan');




        $pegawai_pensiun = Pegawai::select(DB::raw("COUNT(*) as count"))
            ->where('status', 'PENSIUN')
            ->whereYear('updated_at', date('Y'))
            ->groupBy(DB::raw("Month(updated_at)"))
            ->orderByDesc('updated_at')
            ->pluck('count');

        $pegawai_aktif = Pegawai::select(DB::raw("COUNT(*) as count"))
            ->where('status', 'aktif')
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(tgl_sk_yayasan)"))

            ->pluck('count');
        // dd($pegawai_aktif);

        // $bulan_data_dosen = Pegawai::select(DB::raw("MONTHNAME(created_at) as bulan"))
        //     ->GroupBy(DB::raw("MONTHNAME(created_at)"))
        //     ->pluck('bulan');
        $bulan_data_dosen_aktif = Dosen::select(DB::raw("MONTHNAME(tgl_sk_uir) as bulan"))
            ->GroupBy(DB::raw("MONTHNAME(tgl_sk_uir)"))
            ->pluck('bulan');
        $dosen = Dosen::all();
        foreach ($dosen as $bulan) {
            $bulan_dosen_aktif = $bulan_data_dosen_aktif;
        }
        // dd($bulan_dosen_aktif);

        // $bulan_data_dosen_pensiun = Pegawai::select(DB::raw("MONTHNAME(updated_at) as bulan"))
        //     ->GroupBy(DB::raw("MONTHNAME(updated_at)"))
        //     ->pluck('bulan');
        $bulan_data_dosen_pensiun = Pegawai::select(DB::raw("MONTHNAME(updated_at) as bulan"))
            ->GroupBy(DB::raw("MONTHNAME(updated_at)"))
            ->where('status', 'PENSIUN')
            ->where('kategori', 'Pegawai Akademik(Dosen)')
            ->pluck('bulan');






        $dosen_pensiun = Pegawai::select(DB::raw("COUNT(*) as count"))
            ->where([['status', 'Pensiun'], ['kategori', 'Pegawai Akademik(Dosen)']])
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->orderByDesc('created_at')
            ->pluck('count');

        $dosen_aktif = Pegawai::select(DB::raw("COUNT(*) as count"))
            ->where([['status', 'aktif'], ['kategori', 'Pegawai Akademik(Dosen)']])
            // ->whereYear('tgl_lahir', date('Y'))
            // ->groupBy(DB::raw("Month(tgl_lahir)"))

            ->pluck('count');






        return view('pages.dashboard-admin', compact([
            'total_aktif_pegawai',
            'total_aktif_dosen',
            'total_pensiun_pegawai',
            'total_pensiun_dosen',
            'bulan_data_pegawai_aktif',
            'bulan_data_pegawai_pensiun',
            'bulan_data_dosen_pensiun',
            'bulan_dosen_aktif',
            'pegawai_pensiun', 'pegawai_aktif',
            'dosen_pensiun', 'dosen_aktif'
        ]));
    }
}