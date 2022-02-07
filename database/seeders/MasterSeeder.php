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

        // Diagnosa
        for ($i = 1; $i <= 20; $i++) {
            DB::table('diagnosa')->insert([
                'kode' => $faker->nik(),
                'nama' => $faker->sentence(2),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Tindakan
        for ($i = 1; $i <= 20; $i++) {
            DB::table('tindakan')->insert([
                'kode' => $faker->nik(),
                'nama' => $faker->sentence(2),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
