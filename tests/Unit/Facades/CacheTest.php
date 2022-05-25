<?php

declare(strict_types=1);

namespace Tests\Unit\Facades;

use DragonCode\WebCore\Facades\Cache;
use Tests\Fixtures\Cache\Keys;
use Tests\TestCase;

class CacheTest extends TestCase
{
    public function testRemember()
    {
        $keys = $this->keys();

        $this->assertFalse(Cache::has($keys));

        Cache::remember(static fn () => 'foo', $keys);

        $this->assertTrue(Cache::has($keys));
    }

    protected function keys(): Keys
    {
        return Keys::make([
            'foo' => 'Foo',
            'bar' => 'Bar',
        ]);
    }
}
