# Arasy Theme

A modern Filament theme inspired by TailAdmin, featuring vibrant indigo accents, Outfit typography, consistent 16px and 8px radius, and an always-dark sidebar. Designed for Filament v5.

![Arasy Theme](art/banner.png)

## Features

- **Modern Design Language** — Fresh brand color palette, clean typography, and consistent spacing
- **Outfit Font** — Clean, modern sans-serif typeface via Google Fonts
- **Dark Mode** — Full dark mode support with carefully crafted surfaces
- **Always-Dark Sidebar** — Sidebar remains dark in both light and dark modes
- **Consistent Border Radius** — 16px cards, 8px inputs, 24px modals
- **Beautiful Auth Pages** — Dark-themed login, register, and password reset pages with brand block
- **Seamless Integration** — Single line of configuration to activate

## Installation

```bash
composer require arasy/arasy-theme
```

### Automatic Setup

```bash
php artisan arasy:install
```

This will detect your Filament panel, create/update the theme CSS file, and print next steps.

### Manual Setup

1. Register the plugin in your PanelServiceProvider:

```php
use ArasyTheme\ArasyThemePlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugin(ArasyThemePlugin::make())
        // ...
}
```

2. Add the import to your panel's theme CSS (`resources/css/filament/{panel}/theme.css`):

```css
@import '../../../../vendor/arasy/arasy-theme/resources/css/arasy.css';
```

3. Compile your assets:

```bash
npm run build
```

## Configuration

```php
use ArasyTheme\ArasyThemePlugin;

ArasyThemePlugin::make()
    ->brandName('My App')              // Brand name for auth pages
    ->brandTagline('ERP SYSTEM')       // Optional tagline
    ->hideBrandText()                  // Hide text when logo contains the brand name
```

## Screenshots

| Light | Dark |
|---|---|
| ![Dashboard Light](art/screenshot-1.png) | ![Dashboard Dark](art/screenshot-2.png) |
| ![Login](art/screenshot-3.png) | ![Tables](art/screenshot-4.png) |

## Requirements

- PHP 8.2+
- Filament v5.0+
- Laravel 10+

## License

MIT
