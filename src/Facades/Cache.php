<?php

declare(strict_types=1);

namespace DragonCode\WebAppSupport\Facades;

use DragonCode\Contracts\DataTransferObject\DataTransferObject;
use DragonCode\WebAppSupport\Support\Cache as Support;
use Illuminate\Support\Facades\Facade;

/**
 * @method static bool has(DataTransferObject $keys)
 * @method static mixed remember(callable $callback, DataTransferObject $keys, string|int|callable|null $ttl = null)
 */
class Cache extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Support::class;
    }
}
