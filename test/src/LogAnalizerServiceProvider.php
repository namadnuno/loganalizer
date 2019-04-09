<?php

namespace Loganalizer;

use Illuminate\Support\ServiceProvider;

class LogAnalizerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/loganalizer.php', 'loganalizer');
    }

    public function boot()
    { }
}
