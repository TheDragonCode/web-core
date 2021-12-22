<?php

declare(strict_types=1);

namespace DragonCode\WebCore;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    protected array $config = [
        'app',
        'auth',
        'broadcasting',
        'cache',
        'cors',
        'database',
        'filesystems',
        'hashing',
        'ignition',
        'lang-publisher',
        'logging',
        'mail',
        'pretty-routes',
        'queue',
        'sanctum',
        'services',
        'session',
        'sluggable',
        'telescope',
        'tinker',
        'view',
    ];

    public function register()
    {
        $this->registerConfig();
    }

    protected function registerConfig(): void
    {
        foreach ($this->config as $name) {
            $this->mergeConfigFrom(__DIR__ . "/../config/$name.php", $name);
        }
    }
}
