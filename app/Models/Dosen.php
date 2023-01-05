<?php

namespace App\Models;

use DateTime;
use App\Models\Notif;

use App\Models\Jurusan;
use App\Models\golongan;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dosen extends Model
{
    protected $table = "dosen";

    protected $fillable = [
        'id',
        'npk',
        'nidn',
        'kode_jurusan',
        'kode_fakultas',
        'tgl_sk_uir',

    ];
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';


    public function jenjangPendidikan()
    {
        //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY 
        return $this->belongsTo(jenjangPendidikan::class, 'id', 'id');
    }


    public function pegawai()
    {
        //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY 
        return $this->belongsTo(Pegawai::class, 'id', 'id');
    }

    public function dosenKontrak()
    {
        //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY 
        return $this->belongsTo(dosenKontrak::class, 'id', 'id');
    }
    // public function pangkat()
    // {
    //     //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY 
    //     return $this->belongsTo(Pangkat::class, 'kode_pangkat', 'kode_pangkat');
    // }
    // public function golongan()
    // {
    //     //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY 
    //     return $this->belongsTo(golongan::class, 'kode_golongan', 'kode_golongan');
    // }

    public function fakultas()
    {
        //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY 
        return $this->belongsTo(fakultas::class, 'kode_fakultas', 'kode_fakultas');
    }

    public function jurusan()
    {
        //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY 
        return $this->belongsTo(Jurusan::class, 'kode_jurusan', 'kode_jurusan');
    }

    public function notifPensiunDosen()
    {
        //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY 
        return $this->belongsTo(notifPensiun::class, 'nidn', 'kode_penerima');
    }




    // public function getUmurAttribute()
    // {
    //     $now = \Carbon\Carbon::now(); // Tanggal sekarang
    //     $b_day = \Carbon\Carbon::parse($this->tgl_lahir); // Tanggal Lahir
    //     $age = $b_day->diffInYears($now);  // Menghitung umur
    //     $diff  = date_diff($now, $b_day);

    //     $batas_pensiun = 65;
    //     $batas_pensiun_guru_besar = 70;
    //     $masa_jabatan = $batas_pensiun - $age;
    //     $masa_jabatan_guru_besar = $batas_pensiun_guru_besar - $age;
    //     $masa_jabatan_parse = \Carbon\Carbon::parse($masa_jabatan);
    //     $masa_jabatan_parse_2 = \Carbon\Carbon::parse($masa_jabatan_guru_besar);
    //     return $diff->y . ' tahun, ' . $diff->m . ' bulan ' . $diff->d . ' hari';
    // }



    // public function getMasaJabatanAttribute()
    // {
    //     $sekarang = date('Y');
    //     $bulan = date('m');
    //     $hari = date('d');
    //     // dosen kontrak

    //     $start_kontrak = \Carbon\Carbon::parse($this->start_tgl_sk_kontrak); // Tanggal Lahir
    //     $end_kontrak = \Carbon\Carbon::parse($this->end_tgl_sk_kontrak); // Tanggal Lahir
    //     $interval = $start_kontrak->diffInYears($end_kontrak);  // Menghitung umur
    //     $hasil  = date_diff($start_kontrak, $end_kontrak);
    //     if ($this->kategori_dosen == "Dosen Kontrak") {
    //         // return $sisa_tahun_kontrak . ' tahun, ' . $sisa_bulan_kontrak . ' bulan,' . $sisa_hari_kontrak . ' hari';
    //         return $hasil->y . ' tahun, ' . $hasil->m . ' bulan ' . $hasil->d . ' hari';
    //     }

    //     $now = \Carbon\Carbon::now(); // Tanggal sekarang
    //     $b_day = \Carbon\Carbon::parse($this->tgl_lahir); // Tanggal Lahir
    //     $age = $b_day->diffInYears($now);  // Menghitung umur
    //     $diff  = date_diff($now, $b_day);

    //     $batas_pensiun = 65;
    //     $batas_pensiun_guru_besar = 70;
    //     $masa_jabatan = $batas_pensiun - $age;
    //     $masa_jabatan_guru_besar = $batas_pensiun_guru_besar - $age;
    //     $masa_jabatan_parse = \Carbon\Carbon::parse($masa_jabatan);
    //     $masa_jabatan_parse_2 = \Carbon\Carbon::parse($masa_jabatan_guru_besar);

    //     // Menghtung Tanggal Pensiun

    //     $joining_date = $this->tgl_lahir;
    //     $timeToAdd = "+ 65 years";
    //     $timeToAdd_guru_besar = "+ 70 years";
    //     $objDateTime = DateTime::createFromFormat("Y-m-d", $joining_date);
    //     $objDateTime->modify($timeToAdd);
    //     $objDateTime2 = DateTime::createFromFormat("Y-m-d", $joining_date);
    //     $objDateTime2->modify($timeToAdd_guru_besar);
    //     // $retire_date = date('d-m-Y', strtotime($joining_date));

    //     $sisa_tahun = $objDateTime->format('Y') - $sekarang;
    //     $sisa_bulan = $objDateTime->format('m') - $bulan;
    //     $sisa_hari = $objDateTime->format('d') - $hari;
    //     $sisa_tahun_guru_besar = $objDateTime2->format('Y') - $sekarang;
    //     $sisa_bulan_guru_besar = $objDateTime2->format('m') - $bulan;
    //     $sisa_hari_guru_besar = $objDateTime2->format('d') - $hari;

    //     $status = $this->status;




    //     if ($age >= $batas_pensiun_guru_besar && $this->kode_jabatan == 'JBT004') {

    //         return 'Pensiun';
    //     } else if ($age >= $batas_pensiun && $this->kode_jabatan == 'JBT001') {

    //         return 'Pensiun';
    //     } else if ($age >= $batas_pensiun && $this->kode_jabatan == 'JBT002') {

    //         return 'Pensiun';
    //     } else if ($age >= $batas_pensiun && $this->kode_jabatan == 'JBT003') {

    //         return 'Pensiun';
    //     } else if ($this->kode_jabatan = 'JBT004') {

    //         if ($sisa_bulan_guru_besar < 0 || $sisa_hari_guru_besar < 0) {
    //             return $sisa_tahun_guru_besar . ' tahun, 0 bulan, 0 hari';
    //         } else {
    //             return $sisa_tahun_guru_besar . ' tahun, ' . $sisa_bulan_guru_besar . ' bulan'  . $sisa_hari_guru_besar . ' hari';
    //         }
    //         // return $sisa_tahun . ' tahun, ' . $sisa_bulan . ' bulan,' . $sisa_hari . ' hari';
    //     } else {
    //         if ($sisa_bulan < 0) {
    //             return $sisa_tahun . ' tahun, 0 bulan,' . $sisa_hari . ' hari';
    //         } else {
    //             return $sisa_tahun . ' tahun, ' . $sisa_bulan . ' bulan,' . $sisa_hari . ' hari';
    //         }
    //         // return $sisa_tahun . ' tahun, ' . $sisa_bulan . ' bulan,' . $sisa_hari . ' hari';
    //     }
    // }
    // public function getTanggalPensiunAttribute()
    // {
    //     $now = \Carbon\Carbon::now(); // Tanggal sekarang
    //     $b_day = \Carbon\Carbon::parse($this->tgl_lahir); // Tanggal Lahir
    //     $age = $b_day->diffInYears($now);  // Menghitung umur
    //     $diff  = date_diff($now, $b_day);

    //     $batas_pensiun = 65;
    //     $batas_pensiun_guru_besar = 70;
    //     $masa_jabatan = $batas_pensiun - $age;
    //     $masa_jabatan_guru_besar = $batas_pensiun_guru_besar - $age;
    //     $masa_jabatan_parse = \Carbon\Carbon::parse($masa_jabatan);
    //     $masa_jabatan_parse_2 = \Carbon\Carbon::parse($masa_jabatan_guru_besar);

    //     // Menghtung Tanggal Pensiun

    //     $joining_date = $this->tgl_lahir;
    //     $timeToAdd = "+ 65 years";
    //     $timeToAdd_guru_besar = "+ 70 years";
    //     $objDateTime = DateTime::createFromFormat("Y-m-d", $joining_date);
    //     $objDateTime->modify($timeToAdd);
    //     $objDateTime2 = DateTime::createFromFormat("Y-m-d", $joining_date);
    //     $objDateTime2->modify($timeToAdd_guru_besar);

    //     if ($this->kode_jabatan == 'JBT004') {
    //         return $objDateTime2->format('d-m-Y');
    //     } else {
    //         return $objDateTime->format('d-m-Y');
    //     }
    // }

    // pencarian
    // public function scopeFilter($query, array $filters)
    // {
    //     // if (isset($filters['search']) ? $filters['search'] : false) {
    //     //     return $query->where('nama_dosen', 'like', '%' . $filters['search'] . '%');
    //     // }

    //     $query->when($filters['search'] ?? false, function ($query, $search) {
    //         return $query->where('nama_dosen', 'like', '%' . $search . '%')
    //             ->Orwhere('nidn', 'like', '%' . $search . '%')
    //             ->with(['pangkat' => function ($query) use ($search) {
    //                 $query->where('nama_pangkat', 'like', '%' . $search . '%');
    //             }]);
    //     });
    // }
    // pencarian
}