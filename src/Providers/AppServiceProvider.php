<?php

declare(strict_types=1);

namespace DragonCode\WebCore\Providers;

use DragonCode\ApiResponse\Services\Response;
use Illuminate\Support\ServiceProvider;
use Laravel\Telescope\TelescopeApplicationServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerResponseExtra();
        $this->registerTelescope();
    }

    public function boot(): void
    {
        $this->bootMigrations();
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

    protected function bootMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }
}
