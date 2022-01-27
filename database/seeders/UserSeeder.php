<?php

namespace Database\Seeders;

use App\Models\Dokter;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /**SUPER ADMIN */
        $faker = Faker::create('id_ID');

        $users = [
            ['Ardi', 'ardi', 'ardi@mail.com'],
            ['Rais', 'rais', 'rais@mail.com'],
            ['Ilham', 'ilham', 'ilham@mail.com'],
        ];

        foreach ($users as $user) {
            $user = User::create([
                'name' => $user[0],
                'username' => $user[1],
                'email' => $user[2],
                'password' => bcrypt('admin')
            ]);
            Profile::create([
                'user_id' => $user->id
            ]);
            $role = 'super_admin';
            $permission = 'full_permission';
            $user->assignRole([$role]);
            $user->givePermissionTo([$permission]);
            $role = Role::find(1);
            $role->givePermissionTo([$permission]);
        }

        // Paru-paru
        $paru = User::create([
            'name' => 'dr. paru name',
            'username' => 'paru username',
            'email' => 'paru@mail.com',
            'password' => bcrypt('admin')
        ]);
        Profile::create([
            'user_id' => $paru->id
        ]);
        $role = 'dokter';
        $permission = 'full_permission';
        $paru->assignRole([$role]);
        $paru->givePermissionTo([$permission]);
        $role = Role::find(3);
        $role->givePermissionTo([$permission]);

        Dokter::create([
            'user_id' => $paru->id,
            'nik' => $faker->nik(),
            'nama' => 'dr. paru',
            'spesialis' => 'paru-paru',
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
        // End paru-paru

        // Jantung
        $jantung = User::create([
            'name' => 'dr. jantung name',
            'username' => 'jantung username',
            'email' => 'jantung@mail.com',
            'password' => bcrypt('admin')
        ]);
        Profile::create([
            'user_id' => $jantung->id
        ]);
        $role = 'dokter';
        $permission = 'full_permission';
        $jantung->assignRole([$role]);
        $jantung->givePermissionTo([$permission]);
        $role = Role::find(3);
        $role->givePermissionTo([$permission]);

        Dokter::create([
            'user_id' => $jantung->id,
            'nik' => $faker->nik(),
            'nama' => 'dr. jantung',
            'spesialis' => 'jantung',
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
        // End paru-paru

        /**ADMIN */
        $admins = [
            ['Admin', 'admin', 'admin@mail.com'],
        ];

        foreach ($admins as $admin) {
            $admin = User::create([
                'name' => $admin[0],
                'username' => $admin[1],
                'email' => $admin[2],
                'password' => bcrypt('admin')
            ]);
            Profile::create([
                'user_id' => $admin->id
            ]);
            $role = 'admin';
            $permission = 'full_permission';
            $admin->assignRole([$role]);
            $admin->givePermissionTo([$permission]);
            $role = Role::find(2);
            $role->givePermissionTo([$permission]);
        }

        /**DOKTER */
        $dokters = [
            ['Dokter', 'dokter', 'dokter@mail.com'],
        ];

        for ($i = 6; $i <= 23; $i++) {
            $dokter = Dokter::create([
                'user_id' => $i,
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

            $user = User::create([
                'name' => $dokter['nama'],
                'username' => Str::lower($faker->lastName() . $faker->firstName()),
                'email' => $dokter['email'],
                'password' => bcrypt('admin')
            ]);
            Profile::create([
                'user_id' => $user['id']
            ]);
            $role = 'apotek';
            $permission = 'full_permission';
            $user->assignRole([$role]);
            $user->givePermissionTo([$permission]);
            $role = Role::find(3);
            $role->givePermissionTo([$permission]);
        }

        /**DIREKTUR */
        $direkturs = [
            ['Direktur', 'direktur', 'direktur@mail.com'],
        ];

        foreach ($direkturs as $direktur) {
            $direktur = User::create([
                'name' => $direktur[0],
                'username' => $direktur[1],
                'email' => $direktur[2],
                'password' => bcrypt('admin')
            ]);
            Profile::create([
                'user_id' => $direktur->id
            ]);
            $role = 'direktur';
            $permission = 'full_permission';
            $direktur->assignRole([$role]);
            $direktur->givePermissionTo([$permission]);
            $role = Role::find(4);
            $role->givePermissionTo([$permission]);
        }

        /**Pendaftaran */
        $pendaftarans = [
            ['Pendaftaran', 'pendaftaran', 'pendaftaran@mail.com'],
        ];

        foreach ($pendaftarans as $pendaftaran) {
            $pendaftaran = User::create([
                'name' => $pendaftaran[0],
                'username' => $pendaftaran[1],
                'email' => $pendaftaran[2],
                'password' => bcrypt('admin')
            ]);
            Profile::create([
                'user_id' => $pendaftaran->id
            ]);
            $role = 'pendaftaran';
            $permission = 'full_permission';
            $pendaftaran->assignRole([$role]);
            $pendaftaran->givePermissionTo([$permission]);
            $role = Role::find(5);
            $role->givePermissionTo([$permission]);
        }

        /**POLI */
        $polis = [
            ['Poli', 'poli', 'poli@mail.com'],
        ];

        foreach ($polis as $poli) {
            $poli = User::create([
                'name' => $poli[0],
                'username' => $poli[1],
                'email' => $poli[2],
                'password' => bcrypt('admin')
            ]);
            Profile::create([
                'user_id' => $poli->id
            ]);
            $role = 'poli';
            $permission = 'full_permission';
            $poli->assignRole([$role]);
            $poli->givePermissionTo([$permission]);
            $role = Role::find(6);
            $role->givePermissionTo([$permission]);
        }

        /**RADIOLOGI */
        $radiologis = [
            ['Radiologi', 'radiologi', 'radiologi@mail.com'],
        ];

        foreach ($radiologis as $radiologi) {
            $radiologi = User::create([
                'name' => $radiologi[0],
                'username' => $radiologi[1],
                'email' => $radiologi[2],
                'password' => bcrypt('admin')
            ]);
            Profile::create([
                'user_id' => $radiologi->id
            ]);
            $role = 'radiologi';
            $permission = 'full_permission';
            $radiologi->assignRole([$role]);
            $radiologi->givePermissionTo([$permission]);
            $role = Role::find(7);
            $role->givePermissionTo([$permission]);
        }

        /**LAB */
        $labs = [
            ['Lab', 'lab', 'lab@mail.com'],
        ];

        foreach ($labs as $lab) {
            $lab = User::create([
                'name' => $lab[0],
                'username' => $lab[1],
                'email' => $lab[2],
                'password' => bcrypt('admin')
            ]);
            Profile::create([
                'user_id' => $lab->id
            ]);
            $role = 'lab';
            $permission = 'full_permission';
            $lab->assignRole([$role]);
            $lab->givePermissionTo([$permission]);
            $role = Role::find(8);
            $role->givePermissionTo([$permission]);
        }

        /**KASIR */
        $kasirs = [
            ['Kasir', 'kasir', 'kasir@mail.com'],
        ];

        foreach ($kasirs as $kasir) {
            $kasir = User::create([
                'name' => $kasir[0],
                'username' => $kasir[1],
                'email' => $kasir[2],
                'password' => bcrypt('admin')
            ]);
            Profile::create([
                'user_id' => $kasir->id
            ]);
            $role = 'kasir';
            $permission = 'full_permission';
            $kasir->assignRole([$role]);
            $kasir->givePermissionTo([$permission]);
            $role = Role::find(9);
            $role->givePermissionTo([$permission]);
        }

        /**APOTEK */
        $apoteks = [
            ['Apotek', 'apotek', 'apotek@mail.com'],
        ];

        foreach ($apoteks as $apotek) {
            $apotek = User::create([
                'name' => $apotek[0],
                'username' => $apotek[1],
                'email' => $apotek[2],
                'password' => bcrypt('admin')
            ]);
            Profile::create([
                'user_id' => $apotek->id
            ]);
            $role = 'apotek';
            $permission = 'full_permission';
            $apotek->assignRole([$role]);
            $apotek->givePermissionTo([$permission]);
            $role = Role::find(10);
            $role->givePermissionTo([$permission]);
        }
    }
}
