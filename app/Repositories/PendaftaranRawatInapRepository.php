<?php

namespace App\Repositories;

use App\Repositories\Interfaces\PendaftaranRawatInapInterface;
use Illuminate\Support\Facades\DB;

class PendaftaranRawatInapRepository implements PendaftaranRawatInapInterface
{
    public function pasienHariIni()
    {
        return DB::table('rawat_inap as ri')
            ->selectRaw('
            ri.id as rawat_inap_id, p.nama as nama_pasien, r.kode_kamar as nama_ruangan, r.kode_bed as nama_bed, kp.nama as kategori_pasien
        ')
            ->join('kamar_pasien as kapa', 'kapa.rawat_inap_id', '=', 'ri.id')
            ->join('ruangan as r', 'r.id', '=', 'kapa.ruangan_id')
            ->join('pasien as p', 'p.id', '=', 'ri.pasien_id')
            ->join('kategori_pasien as kp', 'kp.id', '=', 'ri.kategori_pasien')
            ->whereDate('ri.tanggal', tanggalSekarang())
            ->orderByDesc('ri.tanggal');
    }
}
