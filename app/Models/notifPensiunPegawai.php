<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notifPensiunPegawai extends Model
{
    protected $table = "notifpensiunpegawai";

    protected $fillable = [
        'npk',
        'npk_petinggi',
        'status',
    ];
    // protected $primaryKey = 'kode_notif_pensiun';
    public $incrementing = false;
    protected $keyType = 'string';
}