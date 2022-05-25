<?php

declare(strict_types=1);

use App\Console\Kernel as ConsoleKernel;
use App\Exceptions\Handler as ExceptionHandler;
use App\Http\Kernel as HttpKernel;
use DragonCode\LaravelRouteNames\Application;
use Illuminate\Contracts\Console\Kernel as ConsoleKernelContract;
use Illuminate\Contracts\Debug\ExceptionHandler as ExceptionHandlerContract;
use Illuminate\Contracts\Http\Kernel as HttpKernelContract;

$app = new Application(
    $_ENV['APP_BASE_PATH'] ?? realpath(__DIR__ . '/../../../../')
);

$app->singleton(HttpKernelContract::class, HttpKernel::class);
$app->singleton(ConsoleKernelContract::class, ConsoleKernel::class);
$app->singleton(ExceptionHandlerContract::class, ExceptionHandler::class);

return $app;
