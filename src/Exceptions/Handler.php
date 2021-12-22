<?php

declare(strict_types=1);

namespace DragonCode\WebCore\Exceptions;

use DragonCode\ApiResponse\Exceptions\Laravel\Eight\ApiHandler as ExceptionHandler;

abstract class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];
}
