<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = "jurusan";

    protected $fillable = [
        'kode_jurusan',
        'nama_jurusan',
        'kode_fakultas',
    ];
    protected $primaryKey = 'kode_jurusan';
    public $incrementing = false;
    protected $keyType = 'string';

    public static function kode_jurusan()
    {

        $cek = Jurusan::count();
        if ($cek == 0) {
            $urut = 1001;
            $id = 'JRS'  . $urut;
            return $id;
        } else {
            $ambil = Jurusan::all()->last();
            $urut = (int)substr($ambil->kode_jurusan, -4) + 1;
            $id = 'JRS'  . $urut;
            return $id;
        }
    }

    public function fakultas()
    {
        //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY 
        return $this->belongsTo(Fakultas::class, 'kode_fakultas', 'kode_fakultas');
    }

    public function dosen()
    {
        //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY 
        return $this->hasMany(dosen::class, 'kode_jurusan', 'kode_jurusan');
    }
}