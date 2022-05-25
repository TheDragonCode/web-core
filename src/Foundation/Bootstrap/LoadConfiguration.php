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
    protected string $config_path = __DIR__ . '/../../../config';

    protected function loadConfigurationFiles(Application $app, RepositoryContract $repository)
    {
        parent::loadConfigurationFiles($app, $repository);

        $this->loadCoreConfigurationFiles($repository);
    }

    protected function loadCoreConfigurationFiles(RepositoryContract $repository)
    {
        foreach ($this->getWebCoreConfigurationFile($this->config_path) as $filename) {
            $key = Str::before($filename, '.php');

            $config = $repository->get($key, []);

            $repository->set($key, array_merge(require $this->config_path . '/' . $filename, $config));
        }
    }

    protected function getWebCoreConfigurationFile(string $path): array
    {
        return Arr::of(File::names($path))->sort()->toArray();
    }
}
