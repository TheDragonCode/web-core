<?php

namespace DragonCode\WebCore\Providers;

use DragonCode\Support\Facades\Helpers\Filesystem\File;
use DragonCode\Support\Facades\Helpers\Str;
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
        return ! file_exists(base_path('bootstrap/cache/config.php'));
    }
}
