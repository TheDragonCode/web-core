<?php

declare(strict_types=1);

namespace DragonCode\WebAppSupport\Http;

use DragonCode\WebAppSupport\Http\Middleware\EncryptCookies;
use DragonCode\WebAppSupport\Http\Middleware\TrimStrings;
use DragonCode\WebAppSupport\Http\Middleware\TrustHosts;
use DragonCode\WebAppSupport\Http\Middleware\TrustProxies;
use Fruitcake\Cors\HandleCors;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

abstract class Kernel extends HttpKernel
{
    protected $middleware = [
        TrustHosts::class,
        TrustProxies::class,
        HandleCors::class,
        ValidatePostSize::class,
        TrimStrings::class,
        ConvertEmptyStringsToNull::class,
    ];

    protected $middlewareGroups = [
        'web' => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            //\Illuminate\Session\Middleware\AuthenticateSession::class,
            ShareErrorsFromSession::class,
            SubstituteBindings::class,
        ],

        'api' => [
            EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            SubstituteBindings::class,
        ],
    ];
}
