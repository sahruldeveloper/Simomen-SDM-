<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notifPensiun extends Model
{
    protected $table = "notifpensiun";

    protected $fillable = [

        'kode_penerima',
        'npk',
        'status',
    ];
    // protected $primaryKey = 'kode_notif_pensiun';
    public $incrementing = false;
    protected $keyType = 'string';

    // public static function kodeNotifPensiun()
    // {

    //     $kode = DB::table('notifPensiun')->count();

    //     $addNol = '';
    //     $kode = str_replace("NTP", "", $kode);
    //     $kode = (int) $kode + 1;

    //     $incrementKode = $kode;

    //     if ($kode) {
    //         $addNol = "00";
    //     }

    //     $kodeBaru = "PKT" . $addNol . $incrementKode;
    //     return $kodeNotifPensiun;
    // }

    // public function fakultas()
    // {
    //     //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY 
    //     return $this->belongsTo(Fakultas::class, 'kode_fakultas', 'kode_fakultas');
    // }

    // public function dosen()
    // {
    //     //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY 
    //     return $this->hasMany(dosen::class, 'kode_jurusan', 'kode_jurusan');
    // }
}