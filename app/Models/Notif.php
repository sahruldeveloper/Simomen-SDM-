<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notif extends Model
{
    protected $table = "notif";

    protected $fillable = [
        'npk',
        'kode_penerima',
        'keterangan',
        'status',
    ];
    // protected $primaryKey = 'kode_notif_pensiun';
    public $incrementing = false;
    protected $keyType = 'string';
}