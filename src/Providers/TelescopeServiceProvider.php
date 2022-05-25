<?php

declare(strict_types=1);

namespace DragonCode\WebCore\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Telescope\IncomingEntry;
use Laravel\Telescope\Telescope;
use Laravel\Telescope\TelescopeApplicationServiceProvider;

class TelescopeServiceProvider extends TelescopeApplicationServiceProvider
{
    public function register()
    {
        $this->hideSensitiveRequestDetails();

        Telescope::filter(function (IncomingEntry $entry) {
            return $entry->isReportableException()
                   || $entry->isFailedRequest()
                   || $entry->isFailedJob()
                   || $entry->isScheduledTask()
                   || $entry->hasMonitoredTag();
        });
    }

    protected function hideSensitiveRequestDetails()
    {
        Telescope::hideRequestParameters(['_token']);

        Telescope::hideRequestHeaders([
            'cookie',
            'x-csrf-token',
            'x-xsrf-token',
        ]);
    }

    protected function gate()
    {
        Gate::define('viewTelescope', static fn ($user) => true);
    }
}
