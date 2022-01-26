<?php

use App\Models\ActivityLog;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;


function usia($tanggal_lahir)
{
    $birthDate = new DateTime($tanggal_lahir);
    $today = Carbon::today();
    if ($birthDate > $today) {
        exit("0 tahun 0 bulan 0 hari");
    }
    $y = $today->diff($birthDate)->y;
    $m = $today->diff($birthDate)->m;
    $d = $today->diff($birthDate)->d;
    return $y . " Tahun " . $m . " Bulan " . $d . " Hari";
}

function tanggalLahirUsia($tanggal_lahir)
{
    return tanggal($tanggal_lahir) . ' ( ' . usia($tanggal_lahir) . ' )';
}

function tanggalSekarang()
{
    return date('Y-m-d');
}

function activeClass(string $route)
{
    return request()->routeIs($route) ? 'active current-page' : '';
}

function getInitialUser(string $nama)
{

    $arr = explode(' ', $nama);
    $singkatan = '';
    foreach ($arr as $kata) {
        $singkatan .= substr($kata, 0, 1);
    }
    return $singkatan;
}

function activity(string $aktifitas)
{
    $user = Auth::user();
    $user_id = $user->id;
    $nama = $user->name;
    $email = $user->email;

    if (!$user) {
        return false;
    }

    return ActivityLog::create([
        'user_id' => $user_id,
        'nama' => $nama,
        'email' => $email,
        'aktifitas' => $aktifitas,
    ]);
}

function formatAngka($angka, $rp = false)
{
    if ($rp === true) {
        return 'Rp. ' . number_format($angka, 0, ',', '.');
    } else {
        return number_format($angka, 0, ',', '.');
    }
}
function tanggal($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

function tanggalJam($tanggal)
{
    return Carbon::parse($tanggal)->format('d M Y H:i:s');
}

function replaceRole($role)
{
    return Str::title(str_replace("_", " ", $role));
}


function kode(string $table, string $field, int $panjang, string $prefix, bool $auto_reset = true)
{
    $config = [
        'table' => $table,
        'field' => $field,
        'length' => $panjang,
        'prefix' => $prefix,
        'reset_on_prefix_change' => $auto_reset
    ];
    return IdGenerator::generate($config);
}


function kodePasien()
{
    $date = date('myd');
    return kode('pasien', 'kode', '15', 'P' . $date);
}

function kodePemeriksaanPasien()
{
    $date = date('myd');
    return kode('pemeriksaan', 'kode', '15', 'PPRJ' . $date);
}

function kodeRekamMedis()
{
    $date = date('myd');
    return kode('rekam_medis', 'kode', '15', 'RMP' . $date);
}
