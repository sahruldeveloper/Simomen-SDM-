<?php

namespace App\Console\Commands;

use App\Models\Dosen;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\dosen\EmailPensiunDosenFromSistem;


class TaskScheduleDosen extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifikasi:pensiunDosen';

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
        $dosen = Dosen::with('pegawai');
        foreach ($dosen as $sendDosen) {
            $now = \Carbon\Carbon::now(); // Tanggal sekarang
            $b_day = \Carbon\Carbon::parse($sendDosen->pegawai->tgl_lahir); // Tanggal Lahir
            $age = $b_day->diffInYears($now);  // Menghitung umur
            $diff  = date_diff($now, $b_day);

            $batas_pensiun = 65;
            $batas_pensiun_guru_besar = 70;

            if ($age >= $batas_pensiun_guru_besar && $sendDosen->pegawai->status == 'Aktif' && $sendDosen->kode_jabatan == 'JBT004' && $senDosen->pegawai->kategori == 'Pegawai Akademik(Dosen)') {
                // echo '<span class="badge bg-secondary">Pensiun</span>';  
                Mail::to($sendDosen->email)->send(
                    new EmailPensiunDosenFromSistem($sendDosen)
                );

                $sendDosen->pegawai->status = 'Pensiun';

                $sendDosen->save();
                $this->info('Successfully sent email pensiun to dosen.');
            } else if ($age >= $batas_pensiun && $sendDosen->pegawai->status == 'Aktif' && $sendDosen->kode_jabatan == 'JBT001' && $senDosen->pegawai->kategori == 'Pegawai Akademik(Dosen)') {
                // echo '<span class="badge bg-secondary">Pensiun</span>';  
                Mail::to($sendDosen->email)->send(
                    new EmailPensiunDosenFromSistem($sendDosen)
                );

                $sendDosen->pegawai->status = 'Pensiun';

                $sendDosen->save();
                $this->info('Successfully sent email pensiun to dosen.');
            } else if ($age >= $batas_pensiun && $sendDosen->pegawai->status == 'Aktif' && $sendDosen->kode_jabatan == 'JBT002' && $senDosen->pegawai->kategori == 'Pegawai Akademik(Dosen)') {
                // echo '<span class="badge bg-secondary">Pensiun</span>';  
                Mail::to($sendDosen->email)->send(
                    new EmailPensiunDosenFromSistem($sendDosen)
                );

                $sendDosen->status = 'Pensiun';

                $sendDosen->save();
                $this->info('Successfully sent email pensiun to dosen.');
            } else if ($age >= $batas_pensiun && $sendDosen->pegawai->status == 'Aktif' && $sendDosen->kode_jabatan == 'JBT003' && $senDosen->pegawai->kategori == 'Pegawai Akademik(Dosen)') {
                // echo '<span class="badge bg-secondary">Pensiun</span>';  
                Mail::to($sendDosen->email)->send(
                    new EmailPensiunDosenFromSistem($sendDosen)
                );

                $sendDosen->pegawai->status = 'Pensiun';

                $sendDosen->save();
                $this->info('Successfully sent email pensiun to dosen.');
            }
        }
    }
}