<?php

declare(strict_types=1);

use DragonCode\LaravelRouteNames\Application;
use Illuminate\Contracts\Console\Kernel as ConsoleKernelContract;
use Illuminate\Contracts\Debug\ExceptionHandler as ExceptionHandlerContract;
use Illuminate\Contracts\Http\Kernel as HttpKernelContract;
use Tests\Fixtures\Console\Kernel as ConsoleKernel;
use Tests\Fixtures\Exceptions\Handler as ExceptionHandler;
use Tests\Fixtures\Http\Kernel as HttpKernel;

$app = new Application(
    realpath(__DIR__ . '/../../../')
);

$app->singleton(HttpKernelContract::class, HttpKernel::class);
$app->singleton(ConsoleKernelContract::class, ConsoleKernel::class);
$app->singleton(ExceptionHandlerContract::class, ExceptionHandler::class);

return $app;
