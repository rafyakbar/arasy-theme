<?php

namespace ArasyTheme;

use Filament\Contracts\Plugin;
use Filament\Facades\Filament;
use Filament\FontProviders\GoogleFontProvider;
use Filament\Panel;
use Filament\Support\Assets\Css;
use Filament\Support\Colors\Color;
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
                'primary' => Color::Indigo,
                'gray' => Color::Zinc,
                'success' => Color::Emerald,
                'warning' => Color::Amber,
                'danger' => Color::Rose,
                'info' => Color::Sky,
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

                return '<style data-arasy-preset="default">:root { --arasy-accent-rgb: 99, 102, 241; }</style>';
            }
        );
    }
}
