<?php

namespace Database\Seeders;

use App\Models\Obat;
use App\Models\Satuan;
use App\Models\ObatApotek;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use App\Models\KategoriObat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $satuan = [
            ['Kaplet', 10],
            ['Lusin', 12],
            ['Kodi', 20],
            ['Pcs', 1],
        ];

        foreach ($satuan as $item) {
            Satuan::create([
                'nama' => $item[0],
                'jumlah' => $item[1],
            ]);
        }

        
        $kategori_obat = [
            ['Obat Generik', 'aktif'],
            ['Obat Umum', 'aktif'],
            ['Obat Adiktif', 'aktif'],
            ['Obat Penenang', 'aktif'],
            ['Obat Murah', 'aktif'],
            ['Obat BPJS', 'aktif'],
            ['Obat Psikotropika dan Adiktif', 'aktif'],
            ['Obat Sakti', 'aktif'],
            ['Obat Mata', 'aktif'],
            ['Obat Psikotropika', 'aktif'],
        ];

        foreach ($kategori_obat as $item) {
            KategoriObat::create([
                'nama' => $item[0],
                'status' => $item[1],
            ]);
        }



        for ($i = 1; $i <= 10; $i++) {
            Obat::create([
                'kategori_obat' => rand(1, 5),
                'kode' => uniqid(),
                'nama_paten' => 'nama paten obat' . $faker->lastName,
                'nama_generik' => 'nama generik obat' . $faker->lastName,
                'komposisi' => 'komposisi' . $faker->sentence(5),
                'status' => 'aktif'
            ]);
        }

        for ($i = 1; $i <= 10; $i++) {
            ObatApotek::create([
                'obat_id' => $i,
                'harga_jual' => rand(1000, 10000),
                'stok' => rand(10, 1000),
                'minimal_stok' => rand(1, 10),
                'maksimal_stok' => rand(10, 10000),
                'satuan_id' => rand(1, 4),
                'ed' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+5 years'),
            ]);
        }
    }
}
