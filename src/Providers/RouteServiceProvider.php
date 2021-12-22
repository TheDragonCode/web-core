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
    protected int $max_attempts = 60;

    public function boot()
    {
        $this->configureRateLimiting();

        $this->configureRoutes();
    }

    protected function configureRoutes(): void
    {
        $this->routes(function () {
            $this->bootApiRoutes();
            $this->bootWebRoutes();
        });
    }

    protected function bootApiRoutes(): void
    {
        $this->bootRoutes('routes/api.php',
            static fn () => Route::name('api.')->middleware('api')
        );
    }

    protected function bootWebRoutes(): void
    {
        $this->bootRoutes('routes/web.php',
            static fn () => Route::middleware('web')
        );
    }

    protected function bootRoutes(string $filename, callable $registrar): void
    {
        if (file_exists(base_path($filename))) {
            $registrar()->group(base_path($filename));
        }
    }

    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api',
            fn (Request $request) => Limit::perMinute($this->max_attempts)->by($this->userIdentifier($request))
        );
    }

    protected function userIdentifier(Request $request): int|string
    {
        return optional($request->user())->id ?: $request->ip();
    }
}
