<?php

namespace DragonCode\WebCore\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;

class PreventRequestsDuringMaintenance extends Middleware
{
    public function getExcludedPaths(): array
    {
        return config('http.middleware.maintenance.except', []);
    }
}
