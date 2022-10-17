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
    public function boot()
    {
        $this->configureRateLimiting();
        $this->configureRoutes();
    }

    protected function configureRoutes(): void
    {
        $this->routes(function () {
            $this->bootRoutes($this->routePath('routes/api.php'), fn () => Route::middleware('api'), config('http.prefixes.api'));
            $this->bootRoutes($this->routePath('routes/web.php'), fn () => Route::middleware('web'), config('http.prefixes.web'));
        });
    }

    protected function bootRoutes(string $filename, callable $registrar, ?string $prefix = null): void
    {
        if ($this->routeExist($filename)) {
            ! empty($prefix)
                ? $registrar()->prefix($prefix)->group(base_path($filename))
                : $registrar()->group(base_path($filename));
        }
    }

    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', fn (Request $request) => Limit::perMinute($this->maxAttempts())->by($this->userIdentifier($request)));
    }

    protected function userIdentifier(Request $request): int|string
    {
        return $request->user()?->id ?? $request->ip();
    }

    protected function routePath(string $filename): string
    {
        return base_path($filename);
    }

    protected function routeExist(string $filename): bool
    {
        return file_exists($filename);
    }

    protected function maxAttempts(): int
    {
        return (int) config('http.throttle', 60);
    }
}
