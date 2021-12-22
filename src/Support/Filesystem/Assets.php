<?php

declare(strict_types=1);

namespace DragonCode\WebCore\Support\Filesystem;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;

class Assets
{
    protected string $driver = 'assets';

    public function image(string $filename): string
    {
        return $this->storage()->url('images/' . $filename);
    }

    public function font(string $filename): string
    {
        return $this->storage()->url('fonts/' . $filename);
    }

    protected function storage(): Filesystem|FilesystemAdapter
    {
        return Storage::disk($this->driver);
    }
}
