<?php

namespace Database\Seeders;

use App\Models\Dokter;
use App\Models\DokterPoli;
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
            $role = 'poli_station';
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

         /**REKAM MEDIS */
         $rekam_mediss = [
            ['Rekam_Medis', 'rekam_medis', 'rekam_medis@mail.com'],
        ];

        foreach ($rekam_mediss as $rekam_medis) {
            $rekam_medis = User::create([
                'name' => $rekam_medis[0],
                'username' => $rekam_medis[1],
                'email' => $rekam_medis[2],
                'password' => bcrypt('admin')
            ]);
            Profile::create([
                'user_id' => $rekam_medis->id
            ]);
            $role = 'rekam_medis';
            $permission = 'full_permission';
            $rekam_medis->assignRole([$role]);
            $rekam_medis->givePermissionTo([$permission]);
            $role = Role::find(11);
            $role->givePermissionTo([$permission]);
        }

        /**IGD */
        $igds = [
            ['igd', 'igd', 'igd@mail.com'],
        ];

        foreach ($igds as $igd) {
            $igd = User::create([
                'name' => $igd[0],
                'username' => $igd[1],
                'email' => $igd[2],
                'password' => bcrypt('admin')
            ]);
            Profile::create([
                'user_id' => $igd->id
            ]);
            $role = 'igd';
            $permission = 'full_permission';
            $igd->assignRole([$role]);
            $igd->givePermissionTo([$permission]);
            $role = Role::find(12);
            $role->givePermissionTo([$permission]);
        }

        /**DAHLIA */
        $dahlias = [
            ['dahlia', 'dahlia', 'dahlia@mail.com'],
        ];

        foreach ($dahlias as $dahlia) {
            $dahlia = User::create([
                'name' => $dahlia[0],
                'username' => $dahlia[1],
                'email' => $dahlia[2],
                'password' => bcrypt('admin')
            ]);
            Profile::create([
                'user_id' => $dahlia->id
            ]);
            $role = 'dahlia';
            $permission = 'full_permission';
            $dahlia->assignRole([$role]);
            $dahlia->givePermissionTo([$permission]);
            $role = Role::find(13);
            $role->givePermissionTo([$permission]);
        }

        /**MELATI */
        $melatis = [
            ['melati', 'melati', 'melati@mail.com'],
        ];

        foreach ($melatis as $melati) {
            $melati = User::create([
                'name' => $melati[0],
                'username' => $melati[1],
                'email' => $melati[2],
                'password' => bcrypt('admin')
            ]);
            Profile::create([
                'user_id' => $melati->id
            ]);
            $role = 'melati';
            $permission = 'full_permission';
            $melati->assignRole([$role]);
            $melati->givePermissionTo([$permission]);
            $role = Role::find(14);
            $role->givePermissionTo([$permission]);
        }

        /**KENANGA */
        $kenangas = [
            ['kenanga', 'kenanga', 'kenanga@mail.com'],
        ];

        foreach ($kenangas as $kenanga) {
            $kenanga = User::create([
                'name' => $kenanga[0],
                'username' => $kenanga[1],
                'email' => $kenanga[2],
                'password' => bcrypt('admin')
            ]);
            Profile::create([
                'user_id' => $kenanga->id
            ]);
            $role = 'kenanga';
            $permission = 'full_permission';
            $kenanga->assignRole([$role]);
            $kenanga->givePermissionTo([$permission]);
            $role = Role::find(15);
            $role->givePermissionTo([$permission]);
        }

        /**TULIP */
        $tulips = [
            ['tulip', 'tulip', 'tulip@mail.com'],
        ];

        foreach ($tulips as $tulip) {
            $tulip = User::create([
                'name' => $tulip[0],
                'username' => $tulip[1],
                'email' => $tulip[2],
                'password' => bcrypt('admin')
            ]);
            Profile::create([
                'user_id' => $tulip->id
            ]);
            $role = 'tulip';
            $permission = 'full_permission';
            $tulip->assignRole([$role]);
            $tulip->givePermissionTo([$permission]);
            $role = Role::find(16);
            $role->givePermissionTo([$permission]);
        }

        /**EDELWEIS */
        $edelweiss = [
            ['edelweis', 'edelweis', 'edelweis@mail.com'],
        ];

        foreach ($edelweiss as $edelweis) {
            $edelweis = User::create([
                'name' => $edelweis[0],
                'username' => $edelweis[1],
                'email' => $edelweis[2],
                'password' => bcrypt('admin')
            ]);
            Profile::create([
                'user_id' => $edelweis->id
            ]);
            $role = 'edelweis';
            $permission = 'full_permission';
            $edelweis->assignRole([$role]);
            $edelweis->givePermissionTo([$permission]);
            $role = Role::find(17);
            $role->givePermissionTo([$permission]);
        }

        /**OK */
        $oks = [
            ['ok', 'ok', 'ok@mail.com'],
        ];

        foreach ($oks as $ok) {
            $ok = User::create([
                'name' => $ok[0],
                'username' => $ok[1],
                'email' => $ok[2],
                'password' => bcrypt('admin')
            ]);
            Profile::create([
                'user_id' => $ok->id
            ]);
            $role = 'ok';
            $permission = 'full_permission';
            $ok->assignRole([$role]);
            $ok->givePermissionTo([$permission]);
            $role = Role::find(18);
            $role->givePermissionTo([$permission]);
        }

        /**VK */
        $vks = [
            ['vk', 'vk', 'vk@mail.com'],
        ];

        foreach ($vks as $vk) {
            $vk = User::create([
                'name' => $vk[0],
                'username' => $vk[1],
                'email' => $vk[2],
                'password' => bcrypt('admin')
            ]);
            Profile::create([
                'user_id' => $vk->id
            ]);
            $role = 'vk';
            $permission = 'full_permission';
            $vk->assignRole([$role]);
            $vk->givePermissionTo([$permission]);
            $role = Role::find(19);
            $role->givePermissionTo([$permission]);
        }

        /**ICU/HCU */
        $icus = [
            ['icu', 'icu', 'icu@mail.com'],
        ];

        foreach ($icus as $icu) {
            $icu = User::create([
                'name' => $icu[0],
                'username' => $icu[1],
                'email' => $icu[2],
                'password' => bcrypt('admin')
            ]);
            Profile::create([
                'user_id' => $icu->id
            ]);
            $role = 'icu';
            $permission = 'full_permission';
            $icu->assignRole([$role]);
            $icu->givePermissionTo([$permission]);
            $role = Role::find(20);
            $role->givePermissionTo([$permission]);
        }

        /**HD */
        $hds = [
            ['hd', 'hd', 'hd@mail.com'],
        ];

        foreach ($hds as $hd) {
            $hd = User::create([
                'name' => $hd[0],
                'username' => $hd[1],
                'email' => $hd[2],
                'password' => bcrypt('admin')
            ]);
            Profile::create([
                'user_id' => $hd->id
            ]);
            $role = 'hd';
            $permission = 'full_permission';
            $hd->assignRole([$role]);
            $hd->givePermissionTo([$permission]);
            $role = Role::find(21);
            $role->givePermissionTo([$permission]);
        }

        /**DAPUR */
        $dapurs = [
            ['dapur', 'dapur', 'dapur@mail.com'],
        ];

        foreach ($dapurs as $dapur) {
            $dapur = User::create([
                'name' => $dapur[0],
                'username' => $dapur[1],
                'email' => $dapur[2],
                'password' => bcrypt('admin')
            ]);
            Profile::create([
                'user_id' => $dapur->id
            ]);
            $role = 'melati';
            $permission = 'full_permission';
            $dapur->assignRole([$role]);
            $dapur->givePermissionTo([$permission]);
            $role = Role::find(22);
            $role->givePermissionTo([$permission]);
        }

        /**LAUNDRY */
        $laundrys = [
            ['laundry', 'laundry', 'laundry@mail.com'],
        ];

        foreach ($laundrys as $laundry) {
            $laundry = User::create([
                'name' => $laundry[0],
                'username' => $laundry[1],
                'email' => $laundry[2],
                'password' => bcrypt('admin')
            ]);
            Profile::create([
                'user_id' => $laundry->id
            ]);
            $role = 'melati';
            $permission = 'full_permission';
            $laundry->assignRole([$role]);
            $laundry->givePermissionTo([$permission]);
            $role = Role::find(23);
            $role->givePermissionTo([$permission]);
        }

        /**CSSD */
        $cssds = [
            ['cssd', 'cssd', 'cssd@mail.com'],
        ];

        foreach ($cssds as $cssd) {
            $cssd = User::create([
                'name' => $cssd[0],
                'username' => $cssd[1],
                'email' => $cssd[2],
                'password' => bcrypt('admin')
            ]);
            Profile::create([
                'user_id' => $cssd->id
            ]);
            $role = 'cssd';
            $permission = 'full_permission';
            $cssd->assignRole([$role]);
            $cssd->givePermissionTo([$permission]);
            $role = Role::find(24);
            $role->givePermissionTo([$permission]);
        }
    }
}
