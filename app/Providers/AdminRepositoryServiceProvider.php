<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\{
    LayananRepository,
    PasienRepository,
    PendaftaranRepository,
    DokterRepository,
    ApotekRepository,
    AntrianRepository,
    GudangFarmasiRepository,
};
use App\Repositories\Interfaces\{
    PasienInterface,
    LayananInterface,
    PendaftaranInterface,
    DokterInterface,
    ApotekInterface,
    AntrianInterface,
    GudangFarmasiInterface,
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
            AntrianInterface::class,
            AntrianRepository::class
        );
        $this->app->bind(
            GudangFarmasiInterface::class,
            GudangFarmasiRepository::class
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
