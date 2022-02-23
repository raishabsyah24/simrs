<?php

namespace Database\Seeders;

use App\Models\Asuransi;
use App\Models\Poli;
use App\Models\User;
use App\Models\Dokter;
use App\Models\Layanan;
use App\Models\Profile;
use App\Models\DokterPoli;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use App\Models\NurseStation;
use App\Models\KategoriPasien;
use App\Models\Ruangan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

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

        /**Dokter */
        for ($i = 1; $i <= 20; $i++) {
            $user = User::create([
                'name' => $faker->name,
                'username' => Str::camel($faker->name),
                'email' => $faker->unique()->safeEmail(),
                'password' => bcrypt('firdaus'),
            ]);
            $role = 'dokter';
            $permission = ['create', 'read', 'update', 'delete'];
            $user->assignRole([$role]);
            $user->givePermissionTo([$permission]);
            $role = Role::find(10);
            $role->givePermissionTo([$permission]);

            $profile = Profile::create(['user_id' => $user->id]);

            $dokter = Dokter::create([
                'user_id' => $user->id,
                'nama' => $faker->name,
                'nik' => $faker->nik(),
                'spesialis' => $faker->randomElement(['jantung', 'mata', 'anak', 'kulit', 'paru-paru']),
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->dateTimeBetween($startDate = '-60 years', $endDate = '-25 years'),
                'tanggal_bergabung' => $faker->dateTimeBetween($startDate = '-10 years', $endDate = '-1 years'),
                'jenis_kelamin' => $faker->randomElement(['laki-laki', 'perempuan']),
                'email' => $faker->unique()->safeEmail(),
                'alamat' => $faker->address(),
                'status' => 'aktif',
            ]);

            $dokter_poli = DokterPoli::create([
                'dokter_id' => $dokter->id,
                'poli_id' => rand(1, 7)
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

        // Nurse Station
        $nurse_station = [
            ['NS001', 'Dahlia', 'lantai 2', rand(1, 3), rand(1, 3)],
            ['NS002', 'Edelweis', 'lantai 4', rand(1, 3), rand(1, 3)],
            ['NS003', 'Kenanga', 'lantai 3', rand(1, 3), rand(1, 3)],
            ['NS004', 'Melati', 'lantai 2', rand(1, 3), rand(1, 3)],
            ['NS005', 'Tulip', 'lantai 3', rand(1, 3), rand(1, 3)],
            ['NS006', 'IGD', 'lantai 1', rand(1, 3), rand(1, 3)],
            ['NS007', 'OK', 'lantai 4', rand(1, 3), rand(1, 3)],
            ['NS008', 'VK', 'lantai 4', rand(1, 3), rand(1, 3)],
            ['NS009', 'HD', 'lantai 4', rand(1, 3), rand(1, 3)],
            ['NS0010', 'ICU', 'lantai 4', rand(1, 3), rand(1, 3)]
        ];

        foreach ($nurse_station as $item) {
            NurseStation::create([
                'kode' => $item[0],
                'nama' => $item[1],
                'lokasi' => $item[2],
                'dokter_ruangan' => $item[3],
                'dpjp' => $item[4],
            ]);
        }

        // Ruangan
        $ruangan = [
            [rand(1, 10), '201', '3', '3', 100000],
            [rand(1, 10), '202', '2', '2', 120000],
            [rand(1, 10), '203', '1', '1', 130000],
            [rand(1, 10), '204', '4', 'vip', 140000],
        ];

        foreach ($ruangan as $item) {
            Ruangan::create([
                'nurse_station_id' => $item[0],
                'kode_kamar' => $item[1],
                'kode_bed' => $item[2],
                'kelas' => $item[3],
                'tarif' => $item[4],
            ]);
        }
    }
}
