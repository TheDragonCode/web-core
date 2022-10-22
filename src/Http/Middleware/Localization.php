<?php

declare(strict_types=1);

namespace DragonCode\WebCore\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;

class Localization
{
    protected string $key = 'X-Locale';

    public function handle(Request $request, Closure $next)
    {
        if ($locale = $this->locale($request)) {
            $this->set($locale);
        }

        return $next($request);
    }

    protected function set(string $locale): void
    {
        App::setLocale($locale);
        Carbon::setLocale($locale);
    }

    protected function locale(Request $request): ?string
    {
        if ($request->hasHeader($this->key)) {
            return $request->header($this->key);
        }

        return null;
    }
}
