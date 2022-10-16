<?php

declare(strict_types=1);

namespace DragonCode\WebCore\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

abstract class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];
}
