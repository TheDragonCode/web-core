<?php

declare(strict_types=1);

namespace DragonCode\WebAppSupport\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class BladeServiceProvider extends ServiceProvider
{
    protected string $app_namespace = 'App\\View\\Components';

    protected string $path = 'View/Components';

    public function boot()
    {
        if ($this->has()) {
            $this->bootComponent();
        }
    }

    protected function bootComponent()
    {
        Blade::componentNamespace(
            $this->getNamespace(),
            $this->getAppName()
        );
    }

    protected function has(): bool
    {
        return file_exists(app_path($this->path));
    }

    protected function getNamespace(): string
    {
        return $this->app_namespace;
    }

    protected function getAppName(): string
    {
        return Str::lower(config('app.name_short'));
    }
}
