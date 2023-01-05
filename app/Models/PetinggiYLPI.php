<?php

namespace App\Models;

use DateTime;
use Carbon\Carbon;
use App\Models\Pegawai;
use App\Mail\SendEmailPensiun;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PetinggiYLPI extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "petinggiylpi";

    protected $fillable = [
        'id',
        'npk',
        'nama',
        'password',
        'email',
        'tgl_lahir',
        'tmp_lahir',
        'jabatan_struktural',
        'jenis_kelamin',
        'pendidikan',
        'foto',
        'kategori'
    ];
    protected $primaryKey = 'id';
    public $incrementing = false;


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function pangkat()
    {
        //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY 
        return $this->belongsTo(Pangkat::class, 'kode_pangkat', 'kode_pangkat');
    }

    public function pegawai()
    {
        //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY 
        return $this->belongsTo(Pegawai::class, 'npk', 'npk');
    }
    public function golongan()
    {
        //MENGGUNAKAN RELASI ONE TO MANY DENGAN FOREIGN KEY 
        return $this->belongsTo(golongan::class, 'kode_golongan', 'kode_golongan');
    }

    public function getUmurAttribute()
    {
        $now = \Carbon\Carbon::now(); // Tanggal sekarang
        $b_day = \Carbon\Carbon::parse($this->tgl_lahir); // Tanggal Lahir
        $age = $b_day->diffInYears($now);  // Menghitung umur
        $diff  = date_diff($now, $b_day);

        $batas_pensiun = 50;
        $masa_jabatan = $batas_pensiun - $age;
        $masa_jabatan_parse = \Carbon\Carbon::parse($masa_jabatan);
        return $diff->y . ' tahun, ' . $diff->m . ' bulan ' . $diff->d . ' hari';
    }



    public function getMasaJabatanAttribute()
    {
        $now = \Carbon\Carbon::now(); // Tanggal sekarang
        $b_day = \Carbon\Carbon::parse($this->tgl_lahir); // Tanggal Lahir
        $age = $b_day->diffInYears($now);  // Menghitung umur
        $diff  = date_diff($now, $b_day);

        $batas_pensiun = 50;
        $masa_jabatan = $batas_pensiun - $age;
        $masa_jabatan_parse = \Carbon\Carbon::parse($masa_jabatan);

        // Menghtung Tanggal Pensiun

        $joining_date = $this->tgl_lahir;
        $timeToAdd = "+ 50 years";
        $objDateTime = DateTime::createFromFormat("Y-m-d", $joining_date);
        $objDateTime->modify($timeToAdd);
        // $retire_date = date('d-m-Y', strtotime($joining_date));
        $sekarang = date('Y');
        $bulan = date('m');
        $hari = date('d');
        $sisa_tahun = $objDateTime->format('Y') - $sekarang;
        $sisa_bulan = $objDateTime->format('m') - $bulan;
        $sisa_hari = $objDateTime->format('d') - $hari;

        $status = $this->status;


        if ($age >= $batas_pensiun) {
            // echo '<span class="badge bg-secondary">Pensiun</span>';  
            // if ($sisa_hari == 0 && $status == 'aktif') {
            //     Mail::to($this->email)->send(
            //         new SendEmailPensiun($this->email)
            //     );
            //     $Change = Pegawai::all();
            //     $Change = $status = 'Pensiun';
            //     $Change->save();
            // }

            return 'Pensiun';
        } else {
            if ($sisa_bulan < 0) {
                return $sisa_tahun . ' tahun, 0 bulan,' . $sisa_hari . ' hari';
            } else {
                return $sisa_tahun . ' tahun, ' . $sisa_bulan . ' bulan,' . $sisa_hari . ' hari';
            }
            // return $sisa_tahun . ' tahun, ' . $sisa_bulan . ' bulan,' . $sisa_hari . ' hari';
        }
    }
}