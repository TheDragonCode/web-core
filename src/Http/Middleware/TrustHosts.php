<?php

declare(strict_types=1);

namespace DragonCode\WebAppSupport\Http\Middleware;

use DragonCode\Support\Facades\Http\Builder;
use Illuminate\Http\Middleware\TrustHosts as Middleware;

class TrustHosts extends Middleware
{
    public function hosts(): array
    {
        return [
            $this->allSubdomainsOfApplicationUrl(),
        ];
    }

    protected function allSubdomainsOfApplicationUrl(): ?string
    {
        if ($host = $this->host()) {
            return '^(.+\.)?' . preg_quote($host) . '$';
        }

        return null;
    }

    protected function host(): ?string
    {
        $host = config('app.url');

        return Builder::parse($host)->getBaseDomain();
    }
}
