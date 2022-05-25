<?php

declare(strict_types=1);

namespace DragonCode\WebCore\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected int $max_attempts = 120;

    public function boot()
    {
        $this->configureRateLimiting();
        $this->configureRoutes();
    }

    protected function configureRoutes(): void
    {
        $this->routes(function () {
            $this->bootRoutes('routes/api.php', fn () => Route::middleware('api'), $this->routeExist('routes/web.php'), 'api');
            $this->bootRoutes('routes/web.php', fn () => Route::middleware('web'));
        });
    }

    protected function bootRoutes(string $filename, callable $registrar, bool $when = false, string $prefix = null): void
    {
        if ($this->routeExist($filename)) {
            $when
                ? $registrar()->prefix($prefix)->group(base_path($filename))
                : $registrar()->group(base_path($filename));
        }
    }

    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', fn (Request $request) => Limit::perMinute($this->max_attempts)->by($this->userIdentifier($request)));
    }

    protected function userIdentifier(Request $request): int|string
    {
        return $request->user()?->id ?? $request->ip();
    }

    protected function routeExist(string $filename): bool
    {
        return file_exists(base_path($filename));
    }
}
