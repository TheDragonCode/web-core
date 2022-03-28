<?php

namespace DragonCode\WebCore\Foundation\Bootstrap;

use DragonCode\Support\Facades\Helpers\Ables\Arrayable;
use DragonCode\Support\Facades\Helpers\Filesystem\File;
use DragonCode\Support\Facades\Helpers\Str;
use Illuminate\Contracts\Config\Repository as RepositoryContract;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Bootstrap\LoadConfiguration as BaseLoadConfiguration;

class LoadConfiguration extends BaseLoadConfiguration
{
    protected function loadConfigurationFiles(Application $app, RepositoryContract $repository)
    {
        parent::loadConfigurationFiles($app, $repository);

        $this->loadCoreConfigurationFiles($repository);
    }

    protected function loadCoreConfigurationFiles(RepositoryContract $repository)
    {
        $path = __DIR__ . '/../../../config';

        foreach ($this->getWebCoreConfigurationFile($path) as $filename) {
            $key = Str::before($filename, '.php');

            $config = $repository->get($key, []);

            $repository->set($key, array_merge(require $path . '/' . $filename, $config));
        }
    }

    protected function getWebCoreConfigurationFile(string $path): array
    {
        return Arrayable::of(File::names($path))
            ->sort()
            ->get();
    }
}
