<?php

declare(strict_types=1);

namespace DragonCode\WebAppSupport\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        abort(401, __('http-statuses.401'));
    }
}
