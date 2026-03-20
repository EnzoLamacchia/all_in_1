<?php

namespace Elamacchia\Excelimport;
use Illuminate\Support\ServiceProvider;

Class ExcelimportServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'excelimport');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->publishes([
            __DIR__.'/config/excel_import.php' => config_path('excelimport.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/excel_import.php', 'excelimport'
        );
    }
}
