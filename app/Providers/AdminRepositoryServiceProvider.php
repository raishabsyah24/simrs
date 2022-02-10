<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\{
    LayananRepository,
    PasienRepository,
    PendaftaranRepository,
    DokterRepository,
    ApotekRepository,
    KasirRepository
};
use App\Repositories\Interfaces\{
    PasienInterface,
    LayananInterface,
    PendaftaranInterface,
    DokterInterface,
    ApotekInterface,
    KasirInterface
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
