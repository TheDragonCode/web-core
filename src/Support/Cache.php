<?php

declare(strict_types=1);

namespace DragonCode\WebAppSupport\Support;

use DragonCode\Cache\Services\Cache as DragonCache;
use DragonCode\Contracts\DataTransferObject\DataTransferObject;

class Cache
{
    public function remember(callable $callback, DataTransferObject $keys, string|int|callable|null $ttl = null): mixed
    {
        return $this->instance($keys)->ttl($ttl)->put($callback);
    }

    public function has(DataTransferObject $keys): bool
    {
        return $this->instance($keys)->has();
    }

    protected function instance(DataTransferObject $keys): DragonCache
    {
        return DragonCache::make()->key($keys);
    }
}
