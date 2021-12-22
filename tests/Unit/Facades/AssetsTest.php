<?php

declare(strict_types=1);

namespace Tests\Unit\Facades;

use App\Constants\Application;
use App\Facades\Assets;
use Tests\TestCase;

class AssetsTest extends TestCase
{
    public function testMainLogotype()
    {
        $expected = $this->assetsUrl() . '/images/' . Application::LOGOTYPE_IMAGE;

        $this->assertSame($expected, Assets::mainLogotype());
    }

    public function testFont()
    {
        $expected = $this->assetsUrl() . '/fonts/foo.woff2';

        $this->assertSame($expected, Assets::font('foo.woff2'));
    }

    public function testImage()
    {
        $expected = $this->assetsUrl() . '/images/foo.webp';

        $this->assertSame($expected, Assets::image('foo.webp'));
    }

    protected function assetsUrl(): string
    {
        return rtrim(config('app.asset_url'), '/');
    }
}
