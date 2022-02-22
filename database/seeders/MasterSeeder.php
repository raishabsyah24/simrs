<?php

namespace Database\Seeders;

use App\Models\KategoriPasien;
use App\Models\Layanan;
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
        $layanan = [
            [0, 'L00001', 'periksa dokter', 100000, 'Periksa dan konsultasi dokter'],
            [0, 'L00002', 'periksa laboratorium', 0, 'Periksa laboratorium'],
            [0, 'L00003', 'periksa radiologi', 0, 'Periksa radiologi'],
        ];
        foreach ($layanan as $item) {
            Layanan::create([
                'parent_id' => $item[0],
                'kode' => $item[1],
                'nama' => $item[2],
                'tarif' => $item[3],
                'keterangan' => $item[4],
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
        for ($i = 1; $i <= 10; $i++) {
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
                'kode' => $faker->randomElement(['A', 'B', 'C']) . $i,
                'nama' => 'diagnosa ' . $i . ' '  . $faker->sentence(2),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Tindakan
        for ($i = 1; $i <= 20; $i++) {
            DB::table('tindakan')->insert([
                'kode' => $faker->randomElement(['A', 'B', 'C']) . $i,
                'nama' => 'tindakan ' . $i . ' ' . $faker->sentence(2),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
