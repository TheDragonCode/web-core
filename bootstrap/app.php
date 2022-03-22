<?php

use DragonCode\LaravelRouteNames\Application;
use DragonCode\WebCore\Console\Kernel as KernelConsole;
use DragonCode\WebCore\Exceptions\Handler as ExceptionHandler;
use DragonCode\WebCore\Http\Kernel as KernelHttp;
use Illuminate\Contracts\Console\Kernel as KernelConsoleContract;
use Illuminate\Contracts\Debug\ExceptionHandler as ExceptionHandlerContract;
use Illuminate\Contracts\Http\Kernel as KernelHttpContract;

$app = new Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__ . '/../../../')
);

$app->singleton(
    KernelHttpContract::class,
    KernelHttp::class
);

$app->singleton(
    KernelConsoleContract::class,
    KernelConsole::class
);

$app->singleton(
    ExceptionHandlerContract::class,
    ExceptionHandler::class
);

return $app;
