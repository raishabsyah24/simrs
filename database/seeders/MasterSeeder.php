<?php

namespace Database\Seeders;

use App\Models\KategoriPasien;
use App\Models\Poli;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Layanan
        for ($i = 1; $i <= 20; $i++) {
            DB::table('layanan')->insert([
                'kode' => uniqid(),
                'nama' => $faker->name,
                'tarif' => rand(1, 100000),
                'keterangan' => $faker->sentence(10),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        for ($i = 1; $i <= 3; $i++) {
            DB::table('activity_logs')->insert([
                'id' => Str::uuid(),
                'user_id' => rand(1, 3),
                'nama' => $faker->randomElement(['ardi', 'rais', 'ilham']),
                'email' => $faker->randomElement(['ardi@mail.com', 'rais@mail.com', 'ilham@mail.com']),
                'aktifitas' => $faker->sentence(10),
                'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
                'updated_at' => now()
            ]);
        }

        // Dokter
        for ($i = 1; $i <= 3; $i++) {
            DB::table('dokter')->insert([
                // 'user_id' => $i,
                'nik' => $faker->nik(),
                'nama' => $faker->name,
                'spesialis' => $faker->randomElement(['mata', 'jantung', 'kulit', 'paru-paru']),
                'no_str' => $faker->nik(),
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' =>
                $faker->dateTimeBetween($startDate = '-60 years', $endDate = 'now'),
                'jenis_kelamin' =>  $faker->randomElement(['laki-laki', 'perempuan']),
                'alamat' => $faker->address,
                'no_hp' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Pasien
<<<<<<< HEAD
        // for ($i = 1; $i <= 1000; $i++) {
        //     DB::table('pasien')->insert([
        //         'kode' => kodePasien(),
        //         'nik' => $faker->nik(),
        //         'no_bpjs' => $faker->nik(),
        //         'nama' => $faker->name,
        //         'jenis_kelamin' =>  $faker->randomElement(['laki-laki', 'perempuan']),
        //         'tempat_lahir' => $faker->city,
        //         'tanggal_lahir' =>
        //         $faker->dateTimeBetween($startDate = '-60 years', $endDate = 'now'),
        //         'agama' => $faker->randomElement(['islam', 'kriste']),
        //         'golongan_darah' => $faker->randomElement(['A', 'O', 'B']),
        //         'alamat' => $faker->address,
        //         'no_hp' => $faker->phoneNumber,
        //         'email' => $faker->unique()->safeEmail,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }
=======
        for ($i = 1; $i <= 50; $i++) {
            DB::table('pasien')->insert([
                'kode' => kodePasien(),
                'nik' => $faker->nik(),
                'no_bpjs' => $faker->nik(),
                'nama' => $faker->name,
                'jenis_kelamin' =>  $faker->randomElement(['laki-laki', 'perempuan']),
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' =>
                $faker->dateTimeBetween($startDate = '-60 years', $endDate = 'now'),
                'agama' => $faker->randomElement(['islam', 'kriste']),
                'golongan_darah' => $faker->randomElement(['A', 'O', 'B']),
                'alamat' => $faker->address,
                'no_hp' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
>>>>>>> 41ca30b (v1 daftar tenaga medis)

        // Kategori Pasien
        $kategori_pasien = [
            ['bpjs', 'aktif'],
            ['umum', 'aktif'],
            ['asuransi', 'aktif'],
        ];

        foreach ($kategori_pasien as $item) {
            KategoriPasien::create([
                'nama' => $item[0],
                'status' => $item[1]
            ]);
        }

        // Poli
        $poli = [
            ['jantung', 'jantung', 'aktif'],
            ['paru', 'paru-paru', 'aktif'],
            ['mata', 'mata', 'aktif'],
            ['anak', 'anak', 'aktif'],
            ['kulit', 'kulit', 'aktif'],
            ['laboratorium', 'laboratorium', 'aktif'],
            ['radiologi', 'radiologi', 'aktif'],
        ];

        foreach ($poli as $item) {
            Poli::create([
                'nama' => $item[0],
                'spesialis' => $item[1],
                'status' => $item[2],
            ]);
        }

        // Faskes
        for ($i = 1; $i <= 20; $i++) {
            DB::table('faskes')->insert([
                'kode' => $faker->nik(),
                'nama' => $faker->company,
                'alamat' => $faker->address,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // dokter poli
        for ($i = 1; $i <= 20; $i++) {
            DB::table('dokter_poli')->insert([
                'dokter_id' => $i,
                'poli_id' => rand(1, 7),
                'hari_praktek' => $faker->randomElement(["Senin, Selasa, Juma't", "Rabu, Kamis, Sabtu", "Selasa, Kamis"]),
                'jam_mulai' => $faker->time($format = 'H:i'),
                'jam_selesai' => $faker->time($format = 'H:i'),
            ]);
        }
    }
}
