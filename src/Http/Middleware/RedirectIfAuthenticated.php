<?php

namespace DragonCode\WebCore\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @param string|null ...$guards
     *
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards): Response|JsonResponse|RedirectResponse
    {
        foreach ($this->guards($guards) as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect($this->getUrl());
            }
        }

        return $next($request);
    }

    protected function guards(mixed $guards): array
    {
        return empty($guards) ? [null] : $guards;
    }

    protected function getUrl(): string
    {
        return config('http.middleware.redirect.authenticated');
    }
}
