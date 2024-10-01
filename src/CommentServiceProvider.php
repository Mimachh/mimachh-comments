<?php

namespace Mimachh\Comments;

use Illuminate\Support\ServiceProvider;

class CommentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */

    public function boot() 
    {
        $this->publishes([
            __DIR__ . '/./config/mimachh-comments.php' => config_path('mimachh-comments.php'),
        ], 'comments-config');
        $this->loadMigrationsFrom(__DIR__ . '/./database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/./routes/web.php');
    }

    public function register()
    {
        //
    }
}
