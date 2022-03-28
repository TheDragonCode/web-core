<?php

namespace DragonCode\WebCore\Providers;

use DragonCode\Support\Facades\Helpers\Filesystem\File;
use DragonCode\Support\Facades\Helpers\Str;
use Illuminate\Contracts\Foundation\CachesConfiguration;
use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    protected string $path = __DIR__ . '/../../config/';

    public function register()
    {
        if ($this->doesntCache()) {
            foreach ($this->names() as $filename) {
                $this->mergeConfigFrom($this->path . $filename, $this->name($filename));
            }
        }
    }

    protected function names(): array
    {
        return File::names($this->path);
    }

    protected function name(string $filename): string
    {
        return Str::before($filename, '.php');
    }

    protected function doesntCache(): bool
    {
        return ! $this->hasCache();
    }

    protected function hasCache(): bool
    {
        return $this->app instanceof CachesConfiguration && $this->app->configurationIsCached();
    }

    protected function mergeConfigFrom($path, $key)
    {
        $config = $this->app->make('config');

        $config->set(
            $key,
            array_merge(
                $config->get($key, []),
                require $path
            )
        );
    }
}
