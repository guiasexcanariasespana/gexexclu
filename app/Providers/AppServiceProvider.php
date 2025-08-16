<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\Process\Process;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('path.public', function () {
            return config('app.public_prefix');
        }); 
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
          // Solución alternativa para el problema del directorio
    if ($this->app->runningInConsole()) {
        // Configura el directorio por defecto para procesos
        config(['process.default_options.cwd' => base_path()]);
    }

    }
}