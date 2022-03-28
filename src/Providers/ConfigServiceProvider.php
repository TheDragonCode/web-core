<?php

namespace DragonCode\WebCore\Providers;

use DragonCode\Support\Facades\Helpers\Filesystem\Directory;
use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    protected string $path = __DIR__ . '/../../config/';

    public function boot()
    {
        if ($this->hasCache()) {
            return;
        }

        foreach ($this->names() as $name) {
            $this->mergeConfigFrom($this->path . $name, $name);
        }
    }

    protected function names(): array
    {
        return Directory::names($this->path);
    }

    protected function hasCache(): bool
    {
        return file_exists(base_path('bootstrap/cache/config.php'));
    }
}
