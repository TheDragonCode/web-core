<?php

namespace DragonCode\WebCore\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->exists()) {
            Broadcast::routes();

            require $this->path();
        }
    }

    protected function exists(): bool
    {
        return file_exists($this->path());
    }

    protected function path(): string
    {
        return base_path('routes/channels.php');
    }
}
