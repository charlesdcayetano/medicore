<?php

namespace App\Providers;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!Type::hasType('enum')) {
            Type::addType('enum', \Doctrine\DBAL\Types\StringType::class);
        }
    }
    protected $listen = [
    'Illuminate\Auth\Events\Login' => [
        \App\Listeners\LogSuccessfulLogin::class,
    ],
    'Illuminate\Auth\Events\Logout' => [
        \App\Listeners\LogLogout::class,
    ],
];

}
