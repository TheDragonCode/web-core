<?php

declare(strict_types=1);

namespace DragonCode\WebCore\Http\Middleware;

use Illuminate\Contracts\Encryption\Encrypter as EncrypterContract;
use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    public function __construct(EncrypterContract $encrypter)
    {
        $this->setExcept();

        parent::__construct($encrypter);
    }

    protected function setExcept(): void
    {
        $this->except = config('http.middleware.encrypt_cookies.except', []);
    }
}
