<?php

namespace DragonCode\WebCore\Foundation\Bootstrap;

use DragonCode\Support\Facades\Filesystem\File;
use DragonCode\Support\Facades\Helpers\Arr;
use DragonCode\Support\Facades\Helpers\Str;
use Illuminate\Contracts\Config\Repository as RepositoryContract;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Bootstrap\LoadConfiguration as BaseLoadConfiguration;

class LoadConfiguration extends BaseLoadConfiguration
{
    protected string $configPath = __DIR__ . '/../../../config';

    protected function loadConfigurationFiles(Application $app, RepositoryContract $repository)
    {
        parent::loadConfigurationFiles($app, $repository);

        $this->loadCoreConfigurationFiles($repository);
    }

    protected function loadCoreConfigurationFiles(RepositoryContract $repository)
    {
        foreach ($this->getWebCoreConfigurationFile($this->configPath) as $filename) {
            $key = Str::before($filename, '.php');

            $config = $repository->get($key, []);

            $loaded = $this->mergeWithFile($this->configPath . '/' . $filename, $config);

            $repository->set($key, $loaded);
        }
    }

    protected function getWebCoreConfigurationFile(string $path): array
    {
        return File::names($path);
    }

    protected function mergeWithFile(string $filename, array $values): array
    {
        return Arr::ofFile($filename)->merge($values)->toArray();
    }
}
