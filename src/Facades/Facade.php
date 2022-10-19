<?php

namespace DragonCode\WebCore\Facades;

use DragonCode\WebCore\Providers\AppServiceProvider;
use DragonCode\WebCore\Providers\BroadcastServiceProvider as BroadcastCoreServiceProvider;
use DragonCode\WebCore\Providers\RouteServiceProvider;
use Illuminate\Auth\AuthServiceProvider;
use Illuminate\Auth\Passwords\PasswordResetServiceProvider;
use Illuminate\Broadcasting\BroadcastServiceProvider;
use Illuminate\Bus\BusServiceProvider;
use Illuminate\Cache\CacheServiceProvider;
use Illuminate\Cookie\CookieServiceProvider;
use Illuminate\Database\DatabaseServiceProvider;
use Illuminate\Encryption\EncryptionServiceProvider;
use Illuminate\Filesystem\FilesystemServiceProvider;
use Illuminate\Foundation\Providers\ConsoleSupportServiceProvider;
use Illuminate\Foundation\Providers\FoundationServiceProvider;
use Illuminate\Hashing\HashServiceProvider;
use Illuminate\Mail\MailServiceProvider;
use Illuminate\Notifications\NotificationServiceProvider;
use Illuminate\Pagination\PaginationServiceProvider;
use Illuminate\Pipeline\PipelineServiceProvider;
use Illuminate\Queue\QueueServiceProvider;
use Illuminate\Redis\RedisServiceProvider;
use Illuminate\Session\SessionServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade as BaseFacade;
use Illuminate\Translation\TranslationServiceProvider;
use Illuminate\Validation\ValidationServiceProvider;
use Illuminate\View\ViewServiceProvider;

abstract class Facade extends BaseFacade
{
    public static function defaultProviders(): Collection
    {
        return collect([
            AuthServiceProvider::class,
            BroadcastServiceProvider::class,
            BusServiceProvider::class,
            CacheServiceProvider::class,
            ConsoleSupportServiceProvider::class,
            CookieServiceProvider::class,
            DatabaseServiceProvider::class,
            EncryptionServiceProvider::class,
            FilesystemServiceProvider::class,
            FoundationServiceProvider::class,
            HashServiceProvider::class,
            MailServiceProvider::class,
            NotificationServiceProvider::class,
            PaginationServiceProvider::class,
            PipelineServiceProvider::class,
            QueueServiceProvider::class,
            RedisServiceProvider::class,
            PasswordResetServiceProvider::class,
            SessionServiceProvider::class,
            TranslationServiceProvider::class,
            ValidationServiceProvider::class,
            ViewServiceProvider::class,

            // Web Core Providers
            AppServiceProvider::class,
            BroadcastCoreServiceProvider::class,
            RouteServiceProvider::class,
        ]);
    }
}
