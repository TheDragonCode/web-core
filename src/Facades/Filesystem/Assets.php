<?php

declare(strict_types=1);

namespace DragonCode\WebCore\Facades\Filesystem;

use DragonCode\WebCore\Support\Filesystem\Assets as Support;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string font(string $filename)
 * @method static string image(string $filename)
 */
class Assets extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Support::class;
    }
}
