<?php

declare(strict_types=1);

namespace Tests\Fixtures\Cache;

use DragonCode\SimpleDataTransferObject\DataTransferObject;

class Keys extends DataTransferObject
{
    public string $foo;

    public string $bar;
}
