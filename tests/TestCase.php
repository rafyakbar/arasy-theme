<?php

namespace ArasyTheme\Tests;

use ArasyTheme\ArasyThemeServiceProvider;
use Filament\FilamentServiceProvider;
use Filament\Support\SupportServiceProvider;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    use InteractsWithViews;

    protected function getPackageProviders($app): array
    {
        return [
            ArasyThemeServiceProvider::class,
            FilamentServiceProvider::class,
            SupportServiceProvider::class,
            LivewireServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        //
    }
}
