<?php

declare(strict_types=1);

namespace DragonCode\WebCore\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Telescope\TelescopeApplicationServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
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

    protected function bootMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }
}
