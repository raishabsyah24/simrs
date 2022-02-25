<?php

namespace Database\Seeders;

use App\Models\KamarPasien;
use App\Models\Pasien;
use App\Models\RawatInap;
use App\Models\RekamMedis;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class RanapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i < 4; $i++) {
            $pasien = Pasien::create([
                'kode' => uniqid(),
                'nik' => $faker->nik,
                'no_bpjs' => $faker->nik,
                'nama' => $faker->name,
                'jenis_kelamin' => $faker->randomElement(['laki-laki', 'perempuan']),
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->dateTimeBetween($startDate = '-60 years', $endDate = '-10 years'),
                'agama' => 'Islam',
                'golongan_darah' => 'A',
                'pekerjaan' => 'Karyawan',
                'email' => $faker->unique()->safeEmail(),
                'no_hp' => $faker->phoneNumber(),
                'alamat' => $faker->address(),
            ]);

            $rekam_medis = RekamMedis::create([
                'pasien_id' => $pasien->id,
                'kode' => uniqid(),
            ]);

            $rawat_inap = RawatInap::create([
                'kode' => uniqid(),
                'no_sep' => uniqid(),
                'no_bpjs' => uniqid(),
                'no_rekam_medis' => $rekam_medis->kode,
                'pasien_id' => $pasien->id,
                'kategori_pasien' => 1,
                'checkin' =>
                $faker->dateTimeBetween($startDate = '-1 month', $endDate = 'now'),
                'status' => 'proses',
                'tanggal' => now()
            ]);

            $kamar_pasien = KamarPasien::create([
                'rawat_inap_id' => $rawat_inap->id,
                'ruangan_id' => $i,
                'checkin' => now(),
                'tarif' => $faker->randomElement([100000, 120000, 140000]),
                'resiko_jatuh_pasien' => 'ungu',
                'status' => 'ditempati'
            ]);
        }
    }
}
