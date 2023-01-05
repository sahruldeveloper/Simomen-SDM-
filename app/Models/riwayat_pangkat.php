<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class riwayat_pangkat extends Model
{
    protected $table = "riwayat_pangkat";

    protected $fillable = [
        'kode_riwayat',
        'npk',
        'nama_pangkat',
        'nama_golongan',

    ];
    // protected $appends = ['umur', 'masa_jabatan'];

    protected $primaryKey = 'kode-riwayat';
    public $incrementing = false;
    // protected $keyType = 'string';

    public static function kodeRiwayatPangkat()
    {

        $kode = DB::table('riwayat_pangkat')->count();

        $addNol = '';
        $kode = str_replace("RWT", "", $kode);
        $kode = (int) $kode + 1;

        $incrementKode = $kode;

        if ($kode) {
            $addNol = "00";
        }

        $kodeBaru = "RWT" . $addNol . $incrementKode;
        return $kodeBaru;
    }
}