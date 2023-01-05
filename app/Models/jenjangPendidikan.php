<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenjangPendidikan extends Model
{
    protected $table = "jenjangpendidikan";

    protected $fillable = [
        'id',
        'sd',
        'smp',
        'sma',
        'pendidikan_strata',
        'pendidikan_magister',
        'pendidikan_doctor',

    ];
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';




    public function dosen()
    {
        //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY 
        return $this->hasMany(dosen::class, 'id', 'id');
    }
}