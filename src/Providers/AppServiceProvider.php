<?php

declare(strict_types=1);

namespace DragonCode\WebAppSupport\Providers;

use DragonCode\ApiResponse\Services\Response;
use Illuminate\Support\ServiceProvider;
use Laravel\Telescope\TelescopeApplicationServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerResponseExtra();
        $this->registerTelescope();
    }

    protected function registerTelescope(): void
    {
        if (config('telescope.enabled') && class_exists(TelescopeApplicationServiceProvider::class)) {
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    protected function registerResponseExtra(): void
    {
        config('app.debug')
            ? Response::allowWith()
            : Response::withoutWith();
    }
}
