<?php

namespace App\Repositories\Interfaces;

interface DashboardInterface
{
    public function totalPasienRajalHariIni();
    public function totalPasienRajalBpjsHariIni();
    public function totalPasienRajalUmumHariIni();
    public function totalPasienRajalAsuransiHariIni();
    public function totalPasienSpesialisSaya(int $user_id);
    public function dataPasienSpesialisSaya(int $user_id);
}
