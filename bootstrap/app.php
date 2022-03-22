<?php

use App\Console\Kernel as KernelConsole;
use App\Exceptions\Handler as ExceptionHandler;
use App\Http\Kernel as HttpKernel;
use DragonCode\LaravelRouteNames\Application;
use Illuminate\Contracts\Console\Kernel as KernelConsoleContract;
use Illuminate\Contracts\Debug\ExceptionHandler as ExceptionHandlerContract;
use Illuminate\Contracts\Http\Kernel as HttpKernelContract;

$app = new Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__ . '/../../../')
);

$app->singleton(
    HttpKernelContract::class,
    HttpKernel::class
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
