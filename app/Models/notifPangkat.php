<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notifPangkat extends Model
{
    protected $table = "notifpangkat";

    protected $fillable = [
        'kode_pengirim',
        'kode_penerima',
        'status',
    ];
    // protected $primaryKey = 'kode_notif_pensiun';
    public $incrementing = false;
    protected $keyType = 'string';
}