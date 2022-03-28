<?php

declare(strict_types=1);

namespace DragonCode\WebCore\Http;

use DragonCode\WebCore\Foundation\Bootstrap\LoadConfiguration;
use DragonCode\WebCore\Http\Middleware\Authenticate;
use DragonCode\WebCore\Http\Middleware\PreventRequestsDuringMaintenance;
use DragonCode\WebCore\Http\Middleware\TrimStrings;
use DragonCode\WebCore\Http\Middleware\TrustHosts;
use DragonCode\WebCore\Http\Middleware\TrustProxies;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Auth\Middleware\RequirePassword;
use Illuminate\Foundation\Bootstrap\BootProviders;
use Illuminate\Foundation\Bootstrap\HandleExceptions;
use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use Illuminate\Foundation\Bootstrap\RegisterFacades;
use Illuminate\Foundation\Bootstrap\RegisterProviders;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Http\Middleware\HandleCors;
use Illuminate\Http\Middleware\SetCacheHeaders;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Routing\Middleware\ValidateSignature;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

abstract class Kernel extends HttpKernel
{
    protected $bootstrappers = [
        LoadEnvironmentVariables::class,
        LoadConfiguration::class,
        HandleExceptions::class,
        RegisterFacades::class,
        RegisterProviders::class,
        BootProviders::class,
    ];

    protected $middleware = [
        TrustHosts::class,
        TrustProxies::class,
        HandleCors::class,
        PreventRequestsDuringMaintenance::class,
        ValidatePostSize::class,
        TrimStrings::class,
        ConvertEmptyStringsToNull::class,
    ];

    protected array $mainMiddlewareGroups = [
        'api' => [
            EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            SubstituteBindings::class,
        ],
    ];

    protected array $mainRouteMiddleware = [
        'auth'       => Authenticate::class,
        'auth.basic' => AuthenticateWithBasicAuth::class,

        'cache.headers' => SetCacheHeaders::class,

        'can'      => Authorize::class,
        'signed'   => ValidateSignature::class,
        'verified' => EnsureEmailIsVerified::class,

        'password.confirm' => RequirePassword::class,
        'throttle'         => ThrottleRequests::class,
    ];

    public function getRouteMiddleware(): array
    {
        return array_merge($this->mainRouteMiddleware, $this->routeMiddleware);
    }

    public function getMiddlewareGroups(): array
    {
        foreach ($this->mainMiddlewareGroups as $group => $middlewares) {
            if (! isset($this->middlewareGroups[$group])) {
                $this->middlewareGroups[$group] = [];
            }

            $this->appendMiddlewareToGroup($group, $middlewares);
        }

        return $this->middlewareGroups;
    }

    protected function syncMiddlewareToRouter(): void
    {
        $this->router->middlewarePriority = $this->middlewarePriority;

        foreach ($this->middlewareGroups as $key => $middleware) {
            $this->router->middlewareGroup($key, $middleware);
        }

        foreach ($this->getRouteMiddleware() as $key => $middleware) {
            $this->router->aliasMiddleware($key, $middleware);
        }
    }
}
