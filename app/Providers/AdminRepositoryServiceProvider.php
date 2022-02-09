<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\{
    LayananRepository,
    PasienRepository,
    PendaftaranRepository,
    DokterRepository,
    DashboardRepository,
    UserRepository,
    PoliStationRepository,
    PosisiPasienRepository
};
use App\Repositories\Interfaces\{
    PasienInterface,
    LayananInterface,
    PendaftaranInterface,
    DokterInterface,
    DashboardInterface,
    UserInterface,
    PoliStationInterface,
    PosisiPasienInterface
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
