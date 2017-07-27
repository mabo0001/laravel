<?php

namespace App\Providers;

use App\FileParser;
use Illuminate\Support\ServiceProvider;

class FileParseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //使用singleton绑定单例
        $this->app->singleton('parse', function (){
            return new FileParser();
        });
    }
}
