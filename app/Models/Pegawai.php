<?php

namespace App\Models;

use Mail;
use DateTime;
use Carbon\Carbon;
use App\Models\Dosen;
use App\Models\jabatan;

use App\Models\golongan;
use App\Models\jenjangPendidikan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Pegawai extends Model
{


    protected $table = "pegawai";

    protected $fillable = [
        'id',
        'npk',
        'kode_pangkat',
        'kode_golongan',
        'kode_jabatan',
        'nama',
        'email',
        'tgl_lahir',
        'tmp_lahir',
        'tgl_sk_yayasan',
        'jenis_kelamin',
        'foto',
        'status',
        'kategori',
        'verif_data_pangkat',
        'start_tgl_sk_kontrak',
        'end_tgl_sk_kontrak',
        'pendidikan_terakhir'




    ];
    // protected $appends = ['umur', 'masa_jabatan'];


    protected $primaryKey = 'id';
    public $incrementing = false;
    // protected $keyType = 'string';

    // public function dosen()
    // {
    //     //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY 
    //     return $this->belongsTo(Dosen::class, 'npk', 'npk');
    // }
    public function jenjangPendidikanPegawai()
    {
        //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY 
        return $this->belongsTo(jenjangPendidikan::class, 'id', 'id');
    }
    public function jabatan()
    {
        //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY 
        return $this->belongsTo(jabatan::class, 'kode_jabatan', 'kode_jabatan');
    }

    public function pangkat()
    {
        //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY 
        return $this->belongsTo(pangkat::class, 'kode_pangkat', 'kode_pangkat');
    }
    public function dosen()
    {
        //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY 
        return $this->belongsTo(Dosen::class, 'id', 'id');
    }

    public function golongan()
    {
        //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY 
        return $this->belongsTo(golongan::class, 'kode_golongan', 'kode_golongan');
    }

    public function notifPensiunPegawai()
    {
        //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY 
        return $this->belongsTo(notifPensiun::class, 'npk', 'kode_penerima');
    }


    public function notifPangkatPegawai()
    {
        //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY 
        return $this->belongsTo(notifPangkat::class, 'id', 'kode_penerima');
    }

    public function riwayatPangkatPegawai()
    {
        //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY 
        return $this->belongsTo(riwayat_pangkat::class, 'npk', 'npk');
    }

    public function getUmurAttribute()
    {
        $now = \Carbon\Carbon::now(); // Tanggal sekarang
        $b_day = \Carbon\Carbon::parse($this->tgl_lahir); // Tanggal Lahir
        $age = $b_day->diffInYears($now);  // Menghitung umur
        $diff  = date_diff($now, $b_day);

        $batas_pensiun = 50;
        $masa_jabatan = $batas_pensiun - $age;
        $masa_jabatan_parse = \Carbon\Carbon::parse($masa_jabatan);
        return $diff->y . ' tahun, ' . $diff->m . ' bulan ' . $diff->d . ' hari';
    }



    public function getMasaJabatanAttribute()
    {

        $now = \Carbon\Carbon::now(); // Tanggal sekarang
        $b_day = \Carbon\Carbon::parse($this->tgl_lahir); // Tanggal Lahir
        $sk = \Carbon\Carbon::parse($this->tgl_sk_yayasan); // Tanggal Lahir
        $age = $b_day->diffInYears($now);  // Men   ghitung umur

        $diff  = date_diff($now, $b_day);

        // untuk pegawai kontrak
        $start_kontrak = \Carbon\Carbon::parse($this->start_tgl_sk_kontrak); // Tanggal Lahir
        $end_kontrak = \Carbon\Carbon::parse($this->end_tgl_sk_kontrak); // Tanggal Lahir
        $interval = $start_kontrak->diffInYears($end_kontrak);  // Menghitung umur
        $hasil  = date_diff($start_kontrak, $end_kontrak);
        if ($this->status == "Kontrak") {
            // return $sisa_tahun_kontrak . ' tahun, ' . $sisa_bulan_kontrak . ' bulan,' . $sisa_hari_kontrak . ' hari';
            return "$hasil->y  tahun. $hasil->m bulan $hasil->d hari";
        }
        // untuk pegawai kontrak

        // dosen
        $batas_pensiun_dosen = 65;
        $batas_pensiun_guru_besar = 70;
        $hari_masa_kerja  = date_diff($now, $sk)->format("%a");
        $batas_pensiun = 50;


        // Menghtung Tanggal Pensiun

        $joining_date = $this->tgl_lahir;
        $timeToAdd = "+ 50 years";
        $objDateTime = DateTime::createFromFormat("Y-m-d", $joining_date);
        $objDateTime->modify($timeToAdd);

        // dosen
        $joining_date_dosen = $this->tgl_lahir;
        $timeToAdd_dosen = "+ 65 years";
        $timeToAdd_guru_besar = "+ 70 years";
        $objDateTime_guru_besar = DateTime::createFromFormat("Y-m-d", $joining_date_dosen);
        $objDateTime_guru_besar->modify($timeToAdd_guru_besar);
        $objDateTime_dosen = DateTime::createFromFormat("Y-m-d", $joining_date_dosen);
        $objDateTime_dosen->modify($timeToAdd_dosen);


        // dosen

        // $retire_date = date('d-m-Y', strtotime($joining_date));
        $sekarang = date('Y');
        $bulan = date('m');
        $hari = date('d');

        // dosen
        $sisa_tahun_dosen = $objDateTime_dosen->format('Y') - $sekarang;
        $sisa_bulan_dosen = $objDateTime_dosen->format('m') - $bulan;
        $sisa_hari_dosen = $objDateTime_dosen->format('d') - $hari;
        $sisa_tahun_guru_besar = $objDateTime_guru_besar->format('Y') - $sekarang;
        $sisa_bulan_guru_besar = $objDateTime_guru_besar->format('m') - $bulan;
        $sisa_hari_guru_besar = $objDateTime_guru_besar->format('d') - $hari;
        // dosen

        $sisa_tahun = $objDateTime->format('Y') - $sekarang;
        $sisa_bulan = $objDateTime->format('m') - $bulan;
        $sisa_hari = $objDateTime->format('d') - $hari;

        $status = $this->status;
        // dd($this->dosen->kode_jabatan);
        // kondisi untuk dosen
        if ($age >= $batas_pensiun_dosen && $this->kategori == 'Pegawai Akademik(Dosen)' && $this->kode_jabatan == 'JBT001') {
            return "Pensiun";
        } else if ($age >= $batas_pensiun_dosen && $this->kategori == 'Pegawai Akademik(Dosen)' && $this->kode_jabatan == 'JBT002') {
            return "Pensiun";
        } else if ($age >= $batas_pensiun_dosen && $this->kategori == 'Pegawai Akademik(Dosen)' && $this->kode_jabatan == 'JBT003') {
            return "Pensiun";
        } else if ($age >= $batas_pensiun_guru_besar && $this->kategori == 'Pegawai Akademik(Dosen)' && $this->kode_jabatan == 'JBT004') {
            return "Pensiun";
        } else if ($age < $batas_pensiun_guru_besar && $this->kategori == 'Pegawai Akademik(Dosen)' && $this->kode_jabatan == "JBT004") {
            if ($sisa_bulan_guru_besar < 1) {
                return " $sisa_tahun_guru_besar tahun, 0 bulan, $sisa_hari_guru_besar hari";
            } else {
                return " $sisa_tahun_guru_besar tahun, $sisa_bulan_guru_besar bulan, $sisa_hari_guru_besar hari";
            }
        } else if ($age < $batas_pensiun_dosen && $this->kategori == 'Pegawai Akademik(Dosen)') {
            if ($sisa_bulan_dosen < 0) {
                return " $sisa_tahun_dosen tahun, 0 bulan, $sisa_hari_dosen hari";
            } else {
                return " $sisa_tahun_dosen tahun, $sisa_bulan_dosen bulan, $sisa_hari_dosen hari";
            }
        }
        // kondisi untuk dosen

        if ($age >= $batas_pensiun && $this->kategori == 'Pegawai Non Akademik') {

            return "Pensiun";
        } else if ($age < $batas_pensiun && $this->kategori == 'Pegawai Non Akademik') {
            if ($sisa_bulan < 0) {
                return " $sisa_tahun tahun, 0 bulan, $sisa_hari hari";
            } else {
                return " $sisa_tahun tahun, $sisa_bulan bulan, $sisa_hari hari";
            }
            // return $sisa_tahun . ' tahun, ' . $sisa_bulan . ' bulan,' . $sisa_hari . ' hari';
        }
    }

    public function getTanggalPensiunAttribute()
    {
        $now = \Carbon\Carbon::now(); // Tanggal sekarang
        $b_day = \Carbon\Carbon::parse($this->tgl_lahir); // Tanggal Lahir
        $sk = \Carbon\Carbon::parse($this->tgl_sk_yayasan); // Tanggal Lahir
        $age = $b_day->diffInYears($now);  // Men   ghitung umur

        $diff  = date_diff($now, $b_day);
        $batas_pensiun = 50;
        $batas_pensiun_dosen = 65;
        $batas_pensiun_guru_besar = 70;
        $joining_date = $this->tgl_lahir;
        $timeToAdd = "+ 50 years";
        $objDateTime = DateTime::createFromFormat("Y-m-d", $joining_date);
        $objDateTime->modify($timeToAdd);

        // dosen
        $joining_date_dosen = $this->tgl_lahir;
        $timeToAdd_dosen = "+ 65 years";
        $objDateTime_dosen = DateTime::createFromFormat("Y-m-d", $joining_date_dosen);
        $objDateTime_dosen->modify($timeToAdd_dosen);

        $timeToAdd_guru_besar = "+ 70 years";
        $objDateTime_guru_besar = DateTime::createFromFormat("Y-m-d", $joining_date_dosen);
        $objDateTime_guru_besar->modify($timeToAdd_guru_besar);

        $tanggal_pensiun_pegawai =  $objDateTime->format('d-m-Y');
        $tanggal_pensiun_dosen =  $objDateTime_dosen->format('d-m-Y');
        $tanggal_pensiun_guru_besar =  $objDateTime_guru_besar->format('d-m-Y');

        if ($this->kategori == "Pegawai Non Akademik") {
            return $tanggal_pensiun_pegawai;
        } else if ($this->status == "Aktif" && $this->kode_jabatan == 'JBT004') {
            return $tanggal_pensiun_guru_besar;
        } else if ($this->kategori == "Pegawai Akademik(Dosen)") {
            return $tanggal_pensiun_dosen;
        }
    }
}