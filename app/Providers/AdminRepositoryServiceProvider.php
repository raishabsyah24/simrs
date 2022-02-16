<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\{
    AntrianPoliRepository,
    KasirRepository,
    LayananRepository,
    PasienRepository,
    PendaftaranRepository,
    DokterRepository,
    ApotekRepository,
    PosisiPasienRepository,
    DashboardRepository,
    UserRepository,
    PoliStationRepository,
};
use App\Repositories\Interfaces\{
    AntrianPoliInterface,
    PasienInterface,
    LayananInterface,
    PendaftaranInterface,
    DokterInterface,
    ApotekInterface,
    KasirInterface,
    PosisiPasienInterface,
    DashboardInterface,
    UserInterface,
    PoliStationInterface
};

class AdminRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            PasienInterface::class,
            PasienRepository::class
        );
        $this->app->bind(
            LayananInterface::class,
            LayananRepository::class
        );
        $this->app->bind(
            PendaftaranInterface::class,
            PendaftaranRepository::class
        );
        $this->app->bind(
            DokterInterface::class,
            DokterRepository::class
        );
        $this->app->bind(
            ApotekInterface::class,
            ApotekRepository::class
        );
        $this->app->bind(
            KasirInterface::class,
            KasirRepository::class
        );
        $this->app->bind(
            DashboardInterface::class,
            DashboardRepository::class
        );
        $this->app->bind(
            UserInterface::class,
            UserRepository::class
        );
        $this->app->bind(
            PoliStationInterface::class,
            PoliStationRepository::class
        );
        $this->app->bind(
            PosisiPasienInterface::class,
            PosisiPasienRepository::class
        );
        $this->app->bind(
            AntrianPoliInterface::class,
            AntrianPoliRepository::class
        );
        $this->app->bind(
            KasirInterface::class,
            KasirRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
