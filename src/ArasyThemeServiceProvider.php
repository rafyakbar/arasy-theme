<?php

namespace ArasyTheme;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ArasyThemeServiceProvider extends PackageServiceProvider
{
    public static string $name = 'arasy-theme';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasViews()
            ->hasCommand(Console\InstallCommand::class);
    }

    public function packageBooted(): void
    {
        $this->publishes([
            __DIR__ . '/../resources/css/theme-stub.css' => resource_path('css/filament/admin/arasy-theme.css'),
        ], 'arasy-theme-vite');
    }
}
