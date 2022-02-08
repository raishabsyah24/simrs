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
    PoliStationRepository
};
use App\Repositories\Interfaces\{
    PasienInterface,
    LayananInterface,
    PendaftaranInterface,
    DokterInterface,
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
