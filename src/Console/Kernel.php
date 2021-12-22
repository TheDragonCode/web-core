<?php

declare(strict_types=1);

namespace DragonCode\WebCore\Console;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

abstract class Kernel extends ConsoleKernel
{
    protected function commands()
    {
        $this->load(app_path('Console/Commands'));

        if ($this->consoleRoutesExist()) {
            $this->requireConsoleRoutes();
        }
    }

    protected function requireConsoleRoutes()
    {
        require $this->consoleRoutesPath();
    }

    protected function consoleRoutesExist(): bool
    {
        return file_exists($this->consoleRoutesPath());
    }

    protected function consoleRoutesPath(): string
    {
        return base_path('routes/console.php');
    }
}
