<?php

declare(strict_types=1);

namespace DragonCode\WebCore\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    public function handle($request, Closure $next)
    {
        $this->setExcept();

        parent::handle($request, $next);
    }

    protected function setExcept(): void
    {
        $this->except = config('http.middleware.verify_csrf.except', []);
    }
}
