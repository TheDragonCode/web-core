<?php

namespace Tests;

use DragonCode\LaravelRouteNames\Application;
use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    public function createApplication(): Application
    {
        /** @var \DragonCode\LaravelRouteNames\Application $app */
        $app = require __DIR__ . '/Fixtures/bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
