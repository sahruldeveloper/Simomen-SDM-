<?php

namespace App\Models;

use DB;
use App\Models\Dosen;

use App\Models\Pangkat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class jabatan extends Model
{
    protected $table = "jabatan";
    protected $fillable = [
        'kode_jabatan',
        'nama_jabatan',
    ];
    protected $primaryKey = 'kode_jabatan';
    public $incrementing = false;


    public static function kodeJabatan()
    {

        $kode = DB::table('jabatan')->count();

        $addNol = '';
        $kode = str_replace("JBT", "", $kode);
        $kode = (int) $kode + 1;

        $incrementKode = $kode;

        if ($kode) {
            $addNol = "00";
        }

        $kodeBaru = "JBT" . $addNol . $incrementKode;
        return $kodeBaru;
    }

    public function dosen()
    {
        //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY 
        return $this->hasMany(Dosen::class, 'kode_jabatan', 'kode_jabatan');
    }

    public function pangkat()
    {
        //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY parent_id
        return $this->hasMany(Pangkat::class, 'kode_jabatan', 'kode_jabatan');
    }



    // public function pegawai()
    // {
    //     //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY 
    //     return $this->hasMany(pegawai::class, 'kode_jabatan', 'kode_jabatan');
    // }

    // public function pangkat()
    // {
    //     //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY 
    //     return $this->hasMany(Pangkat::class, 'kode_jabatan', 'kode_jabatan');
    // }
}