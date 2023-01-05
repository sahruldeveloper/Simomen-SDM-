<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dosenKontrak extends Model
{
    protected $fillable = [
        'id',
        'nama',
        'email',
        'tgl_lahir',
        'tmp_lahir',
        'jenis_kelamin',
        'start_tanggal_sk_kontrak',
        'end_tanggal_sk_kontrak',

    ];
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
}