<?php

namespace App\Models;

use App\Models\Jurusan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fakultas extends Model
{
    protected $table = "fakultas";

    protected $fillable = [
        'kode_fakultas',
        'nama_fakultas',
    ];
    protected $primaryKey = 'kode_fakultas';
    public $incrementing = false;
    protected $keyType = 'string';

    public static function kode_fakultas()
    {

        $cek = fakultas::count();
        if ($cek == 0) {
            $urut = 1001;
            $id = 'FK'  . $urut;
            return $id;
        } else {
            $ambil = Fakultas::all()->last();
            $urut = (int)substr($ambil->kode_fakultas, -4) + 1;
            $id = 'FK'  . $urut;
            return $id;
        }
    }

    public function dosen()
    {
        //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY 
        return $this->hasMany(dosen::class, 'kode_fakultas', 'kode_fakultas');
    }
    public function jurusan()
    {
        //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY 
        return $this->hasMany(Jurusan::class, 'kode_fakultas', 'kode_fakultas');
    }
}