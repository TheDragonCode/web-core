<?php

declare(strict_types=1);

namespace DragonCode\WebCore\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

abstract class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    protected array $exceptionMapMessages = [
        NotFoundHttpException::class => 'http-statuses.404',
    ];

    protected function convertExceptionToArray(Throwable $e): array
    {
        return config('app.debug')
            ? parent::convertExceptionToArray($e)
            : ['message' => $this->mapExceptionMessage($e)];
    }

    protected function mapExceptionMessage(Throwable $e): string
    {
        if ($message = $this->exceptionMapMessages[get_class($e)] ?? false) {
            return __($message);
        }

        return $this->isHttpException($e) ? $e->getMessage() : __('http-statuses.500');
    }
}
