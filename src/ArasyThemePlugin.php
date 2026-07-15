<?php

namespace ArasyTheme;

use Filament\Contracts\Plugin;
use Filament\Facades\Filament;
use Filament\FontProviders\GoogleFontProvider;
use Filament\Panel;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Contracts\Support\Htmlable;

class ArasyThemePlugin implements Plugin
{
    protected ?string $brandName = null;

    protected ?string $brandTagline = null;

    protected bool $hideBrandText = false;

    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'arasy-theme';
    }

    public function brandName(?string $name): static
    {
        $this->brandName = $name;

        return $this;
    }

    public function brandTagline(?string $tagline): static
    {
        $this->brandTagline = $tagline;

        return $this;
    }

    public function hideBrandText(bool $hide = true): static
    {
        $this->hideBrandText = $hide;

        return $this;
    }

    public function getBrandName(): ?string
    {
        return $this->brandName;
    }

    public function getBrandTagline(): ?string
    {
        return $this->brandTagline;
    }

    public function getHideBrandText(): bool
    {
        return $this->hideBrandText;
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
                    '50' => '#ecfdf3', '100' => '#d1fadf', '300' => '#6ce9a6',
                    '500' => '#12b76a', '600' => '#039855', '700' => '#027a48',
                    '800' => '#05603a',
                ],
                'warning' => [
                    '50' => '#fffaeb', '400' => '#fdb022', '500' => '#f79009',
                    '600' => '#dc6803', '700' => '#b54708',
                ],
                'danger' => [
                    '50' => '#fef3f2', '100' => '#fee4e2', '300' => '#fda29b',
                    '400' => '#f97066', '500' => '#f04438', '600' => '#d92d20',
                    '700' => '#b42318', '800' => '#912018',
                ],
                'info' => [
                    '50' => '#f0f9ff', '300' => '#7cd4fd', '400' => '#36bffa',
                    '500' => '#0ba5ec', '600' => '#0086c9',
                ],
            ])
            ->font('Outfit', provider: GoogleFontProvider::class)
            ->assets([
                Css::make('arasy-theme', __DIR__ . '/../resources/css/arasy.css'),
            ], 'arasy/arasy-theme');

        $this->registerAuthBrandRenderHook($panel);
        $this->registerPresetStyleRenderHook($panel);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    protected function registerAuthBrandRenderHook(Panel $panel): void
    {
        FilamentView::registerRenderHook(
            PanelsRenderHook::SIMPLE_LAYOUT_START,
            function () use ($panel): string {
                if (Filament::getCurrentPanel()?->getId() !== $panel->getId()) {
                    return '';
                }

                $brandName = $this->getBrandName();

                if (blank($brandName)) {
                    $panelBrandName = $panel->getBrandName();

                    $brandName = $panelBrandName instanceof Htmlable
                        ? strip_tags($panelBrandName->toHtml())
                        : (string) $panelBrandName;
                }

                $brandLogo = $panel->getDarkModeBrandLogo() ?? $panel->getBrandLogo();

                return view('arasy-theme::login-brand', [
                    'brandName' => $brandName,
                    'brandTagline' => $this->getBrandTagline(),
                    'brandLogo' => $brandLogo,
                    'brandLogoHeight' => $panel->getBrandLogoHeight(),
                    'hideBrandText' => $this->getHideBrandText(),
                ])->render();
            }
        );
    }

    protected function registerPresetStyleRenderHook(Panel $panel): void
    {
        FilamentView::registerRenderHook(
            PanelsRenderHook::HEAD_END,
            function () use ($panel): string {
                if (Filament::getCurrentPanel()?->getId() !== $panel->getId()) {
                    return '';
                }

                return '<style data-arasy-preset="default">:root { --arasy-accent-rgb: 70, 95, 255; }</style>';
            }
        );
    }
}
