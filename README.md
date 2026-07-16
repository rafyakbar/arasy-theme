# Arasy Theme

> A modern FilamentPHP v5 theme plugin inspired by the TailAdmin design language — vibrant indigo accents, Outfit typography, consistent border radius, and full dark mode support.

![Arasy Theme](art/banner.png)

## Is This Project For You?

✅ Laravel developers using FilamentPHP v5  
✅ Admins who want a polished, modern admin panel look  
✅ Projects that need consistent branding across auth pages and dashboard  
✅ Teams that want dark mode out of the box  

❌ Filament v2/v3 projects (only v5 supported)  
❌ Projects without Laravel or Filament  

## Features

- **Brand Color Palette** — Carefully crafted primary (indigo), success (green), warning (amber), danger (red), info (blue), and gray scales
- **Outfit Font** — Clean, modern sans-serif typeface loaded via Google Font Provider
- **IBM Plex Mono** — Monospace font for code, stats, and tabular data
- **Design Tokens** — CSS custom properties for border radius, shadows, colors, and transitions
- **Full Dark Mode** — Every surface, border, text, and shadow has a dark variant; sidebar included
- **Consistent Border Radius** — 16px cards, 8px inputs, 24px modals, pill badges
- **Sidebar Brand Name** — Optional brand name display beside the logo
- **Cluster Sub-Navigation** — Styled cluster navigation matching the sidebar appearance
- **Auth Pages** — Dark-themed login, register, and password reset pages with brand block
- **Plain CSS** — No build step required for the theme; loaded as a Filament asset
- **One-Command Setup** — `php artisan arasy:install` detects your panel and publishes assets

## Tech Stack

- **Framework**: Laravel, FilamentPHP v5
- **Language**: PHP 8.2+
- **Styling**: Plain CSS with CSS custom properties
- **Typography**: Outfit (sans-serif), IBM Plex Mono (monospace)
- **Package Tools**: Spatie Laravel Package Tools

## Requirements

- PHP 8.2+
- Laravel 10+
- Filament v5.0+

## Installation

```bash
composer require rafyakbar/arasy-theme:dev-main
```

### Automatic Setup

```bash
php artisan arasy:install
```

This will detect your Filament panel, publish the theme CSS, and print next steps.

### Manual Setup

1. Register the plugin in your PanelProvider:

```php
use ArasyTheme\ArasyThemePlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugin(ArasyThemePlugin::make());
}
```

2. Build your frontend assets:

```bash
npm run build
```

## Configuration

The plugin works with zero configuration. All options are opt-in:

```php
use ArasyTheme\ArasyThemePlugin;

ArasyThemePlugin::make()
    ->withSidebarBrandName();   // Show brand name beside logo in sidebar
```

### Sidebar Brand Name

When your panel has a logo set via `->brandLogo()`, you can display the brand name next to it:

```php
// PanelProvider
$panel
    ->brandLogo(asset('images/logo.svg'))
    ->brandLogoHeight('2.5rem')
    ->plugin(
        ArasyThemePlugin::make()
            ->withSidebarBrandName()
    );
```

The brand name uses the panel's `->brandName()` value and matches the sidebar styling — 1.25rem font size, 600 weight, responsive to sidebar collapse.

## What's Included

```
arasy-theme/
├── src/
│   ├── ArasyThemePlugin.php        # Filament plugin class
│   ├── ArasyThemeServiceProvider.php # Package service provider
│   └── Console/
│       └── InstallCommand.php      # php artisan arasy:install
├── resources/
│   ├── css/
│   │   ├── arasy.css               # Main theme stylesheet
│   │   └── theme-stub.css          # Vite theme stub
│   └── views/
│       └── sidebar-brand-name.blade.php  # Brand name blade view
├── art/                            # Screenshots and assets
├── composer.json
├── CHANGELOG.md
└── LICENSE.md
```

### CSS Architecture

The stylesheet `arasy.css` is organized into sections:

- **Design Tokens** — CSS custom properties for colors, radius, shadows, fonts
- **Dark Mode Tokens** — Same properties overridden for `.dark` class
- **Body & Layout** — Background, text color, topbar
- **Sidebar** — Background, border, item styling, active states, collapse states
- **Sidebar Brand Name** — Logo-adjacent brand text
- **Cluster Sub-Navigation** — Styling for cluster/cluster page navigation
- **Content Area** — Topbar and main content margins for sidebar layout
- **Components** — Cards, buttons, form inputs, badges, tables, tabs, pagination, toggles, modals, dropdowns
- **Utilities** — Monospace helper class

## Development

```bash
# Clone and install dependencies
git clone https://github.com/rafyakbar/arasy-theme.git
cd arasy-theme
composer install

# Run tests
composer test

# Lint
composer lint

# Serve testbench
composer serve
```

## Testing

```bash
composer test
```

## Changelog

See [CHANGELOG.md](CHANGELOG.md) for version history.

## License

Distributed under the [MIT License](LICENSE.md).
