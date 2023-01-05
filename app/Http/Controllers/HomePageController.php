<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index(Request $request)
    {


        $data_pegawai = Pegawai::orderBy('tgl_sk_yayasan', 'DESC')->paginate(2);
        $total_aktif_pegawai = Pegawai::where('status', 'Aktif')->count();
        $total_pensiun_pegawai = Pegawai::where('status', 'PENSIUN')->count();
        $total_pensiun_dosen = Pegawai::where([
            ['status', 'PENSIUN'],
            ['kategori', 'Pegawai Akademik(Dosen)']
        ])->count();
        $total_aktif_dosen = Pegawai::where([
            ['status', 'Aktif'],
            ['kategori', 'Pegawai Akademik(Dosen)']
        ])->count();

        return view('index', compact('total_aktif_pegawai', 'total_pensiun_pegawai', 'total_aktif_dosen', 'total_pensiun_dosen'));
    }
}