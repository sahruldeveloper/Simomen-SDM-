<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Dosen;
use App\Models\Pegawai;
use Illuminate\Console\Command;
use App\Mail\pegawai\EmailPangkatPegawaiFromSistem;
use App\Mail\pegawai\EmailPensiunPegawai;
use App\Models\riwayat_pangkat;
use Illuminate\Support\Facades\Mail;


class CronJobles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notif:pangkat-pensiun';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Berfungsi untuk Pengiriman Email secara otomatis oleh sistem';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $pegawai_2 = Pegawai::with('pangkat', 'golongan')->get();


        foreach ($pegawai_2 as $sendPegawai) {
            $now = \Carbon\Carbon::now(); // Tanggal sekarang
            $b_day = \Carbon\Carbon::parse($sendPegawai->tgl_lahir); // Tanggal Lahir
            $age = $b_day->diffInYears($now);  // Menghitung umur
            $diff  = date_diff($now, $b_day);

            $batas_pensiun = 50;
            if ($age >= $batas_pensiun && $sendPegawai->status == 'Aktif') {
                // echo '<span class="badge bg-secondary">Pensiun</span>';  
                // Mail::to($sendPegawai->email)->send(
                //     new EmailPensiunPegawai($sendPegawai)
                // );


                $sendPegawai->status = 'Pensiun';

                $sendPegawai->save();
                $this->info('Successfully sent email pensiun to pegawai.');
                // return 'Successfully sent email pensiun to pegawai';

                // return response()->json(['success' => 1, 'msg' => 'Successfully sent email pensiun to pegawai']);
            }


            $tanggal_sk = \Carbon\Carbon::parse($sendPegawai->tgl_sk_yayasan);
            $masa_kerja = $tanggal_sk->diffInYears($now);  // Hitung msa kerja bersadarkan sk
            $hari_masa_kerja  = date_diff($now, $tanggal_sk)->format("%a");

            $interval_kenaikan_pangkat = 4;
            $hari_kenaikan_pangkat = 1460;
            $id = riwayat_pangkat::kodeRiwayatPangkat();

            if ($hari_masa_kerja >= $hari_kenaikan_pangkat  && $sendPegawai->verif_data_pangkat == 'Sudah') {
                if ($sendPegawai->kode_pangkat == 'PKT001') {

                    $sendPegawai->kode_pangkat = 'PKT002'; //Juru Muda Tingkat I
                    $sendPegawai->kode_golongan = 'GOL002'; //Golongan A/b
                    $sendPegawai->verif_data_pangkat = 'Belum';

                    $sendPegawai->save();
                    $nama_pangkat = 'Juru Muda Tingkat I';
                    $nama_golongan = 'Golongan A/b';

                    riwayat_pangkat::create([
                        'kode_riwayat' => $id,
                        'npk' => $sendPegawai->npk,
                        'nama_pangkat' => $nama_pangkat,
                        'nama_golongan' => $nama_golongan,

                    ]);

                    $email  = Mail::to($sendPegawai->email)->send(
                        new EmailPangkatPegawaiFromSistem($sendPegawai, $nama_pangkat, $nama_golongan)
                    );
                    if ($email) {
                        $this->info('Successfully sent email to pegawai Juru Muda Tingkat I');
                    } else {
                        $this->info('failed sent email to pegawai Juru Muda Tingkat I');
                    }
                    // $this->info('Successfully sent email pangkat Juru Muda Tingkat I to pegawai.' . $sendPegawai->email);
                } else if ($hari_masa_kerja >= $hari_kenaikan_pangkat * 2 && $sendPegawai->kode_pangkat == 'PKT004') {
                    // echo '<span class="badge bg-secondary">Pensiun</span>';  

                    $sendPegawai->kode_pangkat = 'PKT005'; //Pengatur Muda
                    $sendPegawai->kode_golongan = 'GOL005'; //Golongan B/a
                    $sendPegawai->verif_data_pangkat = 'Belum';

                    $sendPegawai->save();
                    $nama_pangkat = 'Pengatur Muda';
                    $nama_golongan = 'Golongan B/a';

                    riwayat_pangkat::create([
                        'kode_riwayat' => $id,
                        'npk' => $sendPegawai->npk,
                        'nama_pangkat' => $nama_pangkat,
                        'nama_golongan' => $nama_golongan,

                    ]);

                    $email = Mail::to($sendPegawai->email)->send(
                        new EmailPangkatPegawaiFromSistem($sendPegawai, $nama_pangkat, $nama_golongan)
                    );
                    if ($email) {
                        $this->info('Successfully sent email pangkat Pengatur Muda to pegawai.');
                    } else {
                        $this->info('failed sent email pangkat Pengatur Muda to pegawai');
                    }
                } else if ($hari_masa_kerja >= $hari_kenaikan_pangkat  && $sendPegawai->kode_pangkat == 'PKT003') {
                    $sendPegawai->kode_pangkat = 'PKT004'; //Juru Tingkat I
                    $sendPegawai->kode_golongan = 'GOL004'; //Golongan A/d
                    $sendPegawai->verif_data_pangkat = 'Belum';

                    $sendPegawai->save();
                    $nama_pangkat = 'Juru Tingkat I';
                    $nama_golongan = 'Golongan A/d';

                    riwayat_pangkat::create([
                        'kode_riwayat' => $id,
                        'npk' => $sendPegawai->npk,
                        'nama_pangkat' => $nama_pangkat,
                        'nama_golongan' => $nama_golongan,

                    ]);

                    $email = Mail::to($sendPegawai->email)->send(
                        new EmailPangkatPegawaiFromSistem($sendPegawai, $nama_pangkat, $nama_golongan)
                    );

                    if ($email) {
                        $this->info('Successfully sent email pangkat Juru Tingkat I to pegawai.');
                    } else {
                        $this->info('failed sent email pangkat Juru Tingkat I to pegawai');
                    }
                } else if ($hari_masa_kerja >= $hari_kenaikan_pangkat * 2 &&   $sendPegawai->kode_pangkat == 'PKT007') {
                    // echo '<span class="badge bg-secondary">Pensiun</span>';  

                    $sendPegawai->kode_pangkat = 'PKT008'; //Pengatur Tingkat I
                    $sendPegawai->kode_golongan = 'GOL008'; //Golongan B/d
                    $sendPegawai->verif_data_pangkat = 'Belum';

                    $sendPegawai->save();
                    $nama_pangkat = 'Pengatur Tingkat I';
                    $nama_golongan = 'Golongan B/d';

                    riwayat_pangkat::create([
                        'kode_riwayat' => $id,
                        'npk' => $sendPegawai->npk,
                        'nama_pangkat' => $nama_pangkat,
                        'nama_golongan' => $nama_golongan,

                    ]);

                    $email = Mail::to($sendPegawai->email)->send(
                        new EmailPangkatPegawaiFromSistem($sendPegawai, $nama_pangkat, $nama_golongan)
                    );

                    if ($email) {
                        $this->info('Successfully sent email pangkat Pengatur to pegawai.');
                    } else {
                        $this->info('failed sent email pangkat Pengatur to pegawai');
                    }
                } else {
                    $this->info('Tidak ada data.');
                }
            }
        }
    }
}