<?php

namespace ArasyTheme;

use Filament\Contracts\Plugin;
use Filament\Facades\Filament;
use Filament\FontProviders\GoogleFontProvider;
use Filament\Panel;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;

class ArasyThemePlugin implements Plugin
{
    protected bool $showSidebarBrandName = false;

    protected bool $showCollapsedLogo = false;

    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'arasy-theme';
    }

    public function withSidebarBrandName(bool $condition = true): static
    {
        $this->showSidebarBrandName = $condition;

        return $this;
    }

    public function withCollapsedLogo(bool $condition = true): static
    {
        $this->showCollapsedLogo = $condition;

        return $this;
    }

    public function register(Panel $panel): void
    {
        $panel
            ->colors([
                'primary' => [
                    '50' => '#ecf3ff', '100' => '#dde9ff', '200' => '#c2d6ff',
                    '300' => '#9cb9ff', '400' => '#7592ff', '500' => '#465fff',
                    '600' => '#3641f5', '700' => '#252dae', '800' => '#252dae',
                    '900' => '#161950', '950' => '#161950',
                ],
                'gray' => [
                    '50' => '#f9fafb', '100' => '#f2f4f7', '200' => '#e4e7ec',
                    '300' => '#d0d5dd', '400' => '#98a2b3', '500' => '#667085',
                    '600' => '#475467', '700' => '#344054', '800' => '#1d2939',
                    '900' => '#101828', '950' => '#0c111d',
                ],
                'success' => [
                    '50' => '#ecfdf3', '100' => '#d1fadf', '200' => '#a6f4c5',
                    '300' => '#6ce9a6', '400' => '#32d583', '500' => '#12b76a',
                    '600' => '#039855', '700' => '#027a48', '800' => '#05603a',
                    '900' => '#054f31', '950' => '#032d1a',
                ],
                'warning' => [
                    '50' => '#fffaeb', '100' => '#fef0c7', '200' => '#fedf89',
                    '300' => '#fec84b', '400' => '#fdb022', '500' => '#f79009',
                    '600' => '#dc6803', '700' => '#b54708', '800' => '#93370d',
                    '900' => '#7a2e0b', '950' => '#4e1c06',
                ],
                'danger' => [
                    '50' => '#fef3f2', '100' => '#fee4e2', '200' => '#fecdca',
                    '300' => '#fda29b', '400' => '#f97066', '500' => '#f04438',
                    '600' => '#d92d20', '700' => '#b42318', '800' => '#912018',
                    '900' => '#7a1414', '950' => '#4a0d0d',
                ],
                'info' => [
                    '50' => '#f0f9ff', '100' => '#e0f2fe', '200' => '#b9e6fe',
                    '300' => '#7cd4fd', '400' => '#36bffa', '500' => '#0ba5ec',
                    '600' => '#0086c9', '700' => '#0065a0', '800' => '#004b7a',
                    '900' => '#003a5e', '950' => '#00253d',
                ],
            ])
            ->font('Outfit', provider: GoogleFontProvider::class)
            ->assets([
                Css::make('arasy-theme', __DIR__ . '/../resources/css/arasy.css'),
            ], 'arasy/arasy-theme');

        $this->registerPresetStyleRenderHook($panel);
        $this->registerSidebarBrandRenderHook($panel);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    protected function registerPresetStyleRenderHook(Panel $panel): void
    {
        FilamentView::registerRenderHook(
            PanelsRenderHook::HEAD_END,
            function () use ($panel): string {
                if (Filament::getCurrentPanel()?->getId() !== $panel->getId()) {
                    return '';
                }

                return '<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<style data-arasy-preset="default">:root { --arasy-accent-rgb: 70, 95, 255; }</style>';
            }
        );
    }

    protected function registerSidebarBrandRenderHook(Panel $panel): void
    {
        FilamentView::registerRenderHook(
            PanelsRenderHook::SIDEBAR_LOGO_AFTER,
            function () use ($panel): string {
                if (Filament::getCurrentPanel()?->getId() !== $panel->getId()) {
                    return '';
                }

                if (! filled(filament()->getBrandLogo())) {
                    return '';
                }

                $html = '';

                if ($this->showSidebarBrandName) {
                    $html .= view('arasy-theme::sidebar-brand-name', [
                        'brandName' => filament()->getBrandName(),
                    ])->render();
                }

                $logo = e(filament()->getBrandLogo());
                $alt = e(filament()->getBrandName());
                $homeUrl = e(filament()->getHomeUrl() ?? url('/'));

                if ($this->showCollapsedLogo) {
                    $html .= <<<HTML
                    <div x-show="!\$store.sidebar.isOpen" class="arasy-sidebar-logo-collapsed" style="display:none;">
                        <a href="{$homeUrl}" style="display:flex;align-items:center;justify-content:center;">
                            <img src="{$logo}" alt="{$alt}" style="height:2rem;">
                        </a>
                    </div>
                    HTML;
                }

                return $html;
            }
        );
    }
}
