<?php

namespace App\Repositories\Interfaces;

interface DashboardInterface
{
    public function totalPasienRajalHariIni();
    public function totalPasienRajalBpjsHariIni();
    public function totalPasienRajalUmumHariIni();
    public function totalPasienRajalAsuransiHariIni();
}
