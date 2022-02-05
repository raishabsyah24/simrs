<?php

namespace Database\Seeders;

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
