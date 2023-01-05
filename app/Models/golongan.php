<?php

namespace App\Models;

use App\Models\jabatan;
use App\Models\Pangkat;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class golongan extends Model
{
    protected $table = "golongan";

    protected $fillable = [
        'kode_golongan',
        'kode_pangkat',
        'nama_golongan',
        'keterangan',
    ];
    protected $primaryKey = 'kode_golongan';
    public $incrementing = false;
    protected $keyType = 'string';

    public static function kodeGolongan()
    {

        $cek = golongan::count();
        if ($cek == 0) {
            $urut = 1001;
            $id = 'GOL'  . $urut;
            return $id;
        } else {
            $ambil = golongan::all()->last();
            $urut = (int)substr($ambil->kode_golongan, -4) + 1;
            $id = 'GOL'  . $urut;
            return $id;
        }

        // $kode = DB::table('golongan')->count();

        // $addNol = '';
        // $kode = str_replace("GOL", "", $kode);
        // $kode = (int) $kode + 1;

        // $incrementKode = $kode;

        // if ($kode) {
        //     $addNol = "00";
        // }

        // $kodeBaru = "GOL" . $addNol . $incrementKode;
        // return $kodeBaru;
    }

    public function pangkat()
    {
        //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY 
        return $this->belongsTo(Pangkat::class, 'kode_pangkat', 'kode_pangkat');
    }
}