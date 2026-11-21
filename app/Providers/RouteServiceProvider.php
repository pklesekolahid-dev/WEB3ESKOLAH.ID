<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/admin/dashboard';

    public function boot(): void
    {
        // Route bindings / patterns can be declared here when needed.
    }
}
