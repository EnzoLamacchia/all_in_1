<?php

namespace Elamacchia\Dedir;
use Illuminate\Support\ServiceProvider;

Class DedirServiceProvider extends ServiceProvider
{

    public function boot() {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'dedir');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->publishes([__DIR__ . '/resources/assets' => public_path('/vendor/dedir/assets')], 'public');
//        $this->publishes([__DIR__ . '/../vendor' => public_path('/vendor')], 'reportistica')
//        $this->mergeConfigFrom(__DIR__.'/../vendor/maatwebsite/excel/config/excel.php', 'excel');
//        $this->publishes([__DIR__.'/../vendor/maatwebsite/excel/config/excel.php' => config_path('excel.php')]);
//        $this->publishes([__DIR__ . '/resources/views' => resource_path('views/vendor/dedir')]);
    }

    public function register() {
//        $this->app->register(Elamacchia\Dedir\Vendor\Maatwebsite\Excel\Src\ExcelServiceProvider::class);
    }
}
