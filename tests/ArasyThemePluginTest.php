<?php

use ArasyTheme\ArasyThemePlugin;

it('can be instantiated via make', function () {
    $plugin = ArasyThemePlugin::make();

    expect($plugin)->toBeInstanceOf(ArasyThemePlugin::class);
});

it('returns correct plugin id', function () {
    $plugin = ArasyThemePlugin::make();

    expect($plugin->getId())->toBe('arasy-theme');
});

it('can set brand name via fluent method', function () {
    $plugin = ArasyThemePlugin::make()->brandName('My App');

    expect($plugin->getBrandName())->toBe('My App');
});

it('can set brand tagline via fluent method', function () {
    $plugin = ArasyThemePlugin::make()->brandTagline('ERP SYSTEM');

    expect($plugin->getBrandTagline())->toBe('ERP SYSTEM');
});

it('can hide brand text', function () {
    $plugin = ArasyThemePlugin::make()->hideBrandText();

    expect($plugin->getHideBrandText())->toBeTrue();
});

it('registers colors font and assets on panel', function () {
    $plugin = ArasyThemePlugin::make();
    $panel = filament()
        ->panel('test')
        ->plugin($plugin)
        ->default();

    $plugin->register($panel);

    expect($panel->getColors())->toHaveKeys(['primary', 'gray', 'success', 'warning', 'danger', 'info']);
    expect($panel->getFontFamily())->toBe('Outfit');
});

it('css file exists and is not empty', function () {
    $cssPath = __DIR__ . '/../resources/css/arasy.css';

    expect(file_exists($cssPath))->toBeTrue();
    expect(filesize($cssPath))->toBeGreaterThan(100);
});

it('login-brand blade view exists', function () {
    $viewPath = __DIR__ . '/../resources/views/login-brand.blade.php';

    expect(file_exists($viewPath))->toBeTrue();
});
