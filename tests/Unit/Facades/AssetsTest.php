<?php

declare(strict_types=1);

namespace Tests\Unit\Facades;

use DragonCode\Support\Facades\Helpers\Str;
use DragonCode\WebCore\Facades\Filesystem\Assets;
use Tests\TestCase;

class AssetsTest extends TestCase
{
    public function testFont()
    {
        $expected = $this->assetsUrl('fonts/foo.woff2');

        $this->assertSame($expected, Assets::font('foo.woff2'));
    }

    public function testImage()
    {
        $expected = $this->assetsUrl('images/foo.webp');

        $this->assertSame($expected, Assets::image('foo.webp'));
    }

    protected function assetsUrl(string $filename): string
    {
        return Str::of(config('app.asset_url'))
            ->rtrim('/')
            ->append('/')
            ->append(ltrim($filename, '/'))
            ->toString();
    }
}
