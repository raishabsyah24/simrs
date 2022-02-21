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
    AntrianRepository,
    GudangFarmasiRepository,
    PosisiPasienRepository,
    DashboardRepository,
    UserRepository,
    PoliStationRepository,
    MelatiRepository
};
use App\Repositories\Interfaces\{
    AntrianPoliInterface,
    PasienInterface,
    LayananInterface,
    PendaftaranInterface,
    DokterInterface,
    ApotekInterface,
    KasirInterface,
    AntrianInterface,
    GudangFarmasiInterface,
    PosisiPasienInterface,
    DashboardInterface,
    UserInterface,
    PoliStationInterface,
    MelatiInterface
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
            AntrianInterface::class,
            AntrianRepository::class
        );
        $this->app->bind(
            GudangFarmasiInterface::class,
            GudangFarmasiRepository::class
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
            MelatiInterface::class,
            MelatiRepository::class
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
