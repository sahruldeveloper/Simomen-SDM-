<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('npk');
        $cek = Pegawai::count();
        if ($cek == 0) {
            $urut = 100001;
            $id = 'SDM'  . $urut;
        } else {
            $ambil = Pegawai::all()->last();
            $urut = (int)substr($ambil->id, -6) + 1;
            $id = 'SDM'  . $urut;
        }
        $gender = $faker->randomElement(['Pria', 'Wanita']);

        for ($i = 1; $i <= 20; $i++) {

            // insert data ke table pegawai menggunakan Faker
            DB::table('pegawai')->insert([
                'id' => $id,
                'npk' => $faker->regexify('[A-Za-z0-9]{10}'),
                'kode_pangkat' => 'PKT1001',
                'kode_golongan' => 'GOL1001',
                'kode_jabatan' => '',
                'nama' => $faker->name,
                'email' => $faker->email,
                'tgl_lahir' => $faker->dateTimeThisCentury->format('Y-m-d'),
                'tmp_lahir' =>  $faker->country,
                'tgl_sk_yayasan' => $faker->dateTimeThisYear->format('Y-m-d'),
                'jenis_kelamin' => $gender,
                'foto' => '1666794915sahrul-gunawan.png', // 'http://lorempixel.com/800/400/cats/Faker'
                'verif_data_pangkat' => 'Sudah',
                'kategori' => 'Pegawai Non Akademik',
                'status' => 'Aktif',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')

            ]);

            DB::table('jenjangpendidikan')->insert([
                'id' => $id,
                'sd' => 'sd',
                'smp' => 'smp',
                'sma' => 'sma',
                'pendidikan_strata' => 's1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
}