<?php

namespace App\Models;

use App\Models\jabatan;
use App\Models\golongan;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pangkat extends Model
{
    protected $table = "pangkat";

    protected $fillable = [

        'kode_pangkat',
        'kode_jabatan',


        'nama_pangkat',
    ];
    protected $primaryKey = 'kode_pangkat';
    public $incrementing = false;
    protected $keyType = 'string';

    public static function kodePangkat()
    {

        $cek = Pangkat::count();
        if ($cek == 0) {
            $urut = 1001;
            $id = 'PKT'  . $urut;
            return $id;
        } else {
            $ambil = Pangkat::all()->last();
            $urut = (int)substr($ambil->kode_pangkat, -4) + 1;
            $id = 'PKT'  . $urut;
            return $id;
        }

        // $kode = DB::table('pangkat')->count();

        // $addNol = '';
        // $kode = str_replace("PKT", "", $kode);
        // $kode = (int) $kode + 1;

        // $incrementKode = $kode;

        // if ($kode == 0) {
        //     $addNol = "00";
        // } else {
        //     $kodeBaru = "PKT" . $addNol . $incrementKode;
        // }


        // return $kodeBaru;
    }

    public function jabatan()
    {
        //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY 
        return $this->belongsTo(jabatan::class, 'kode_jabatan', 'kode_jabatan');
    }

    public function golongan()
    {
        //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY 
        return $this->belongsTo(golongan::class, 'kode_golongan', 'kode_golongan');
    }
}