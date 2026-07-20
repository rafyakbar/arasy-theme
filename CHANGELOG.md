# Changelog

## v1.1.0 — 2026-07-20

### Fixed
- Collapsed sidebar logo now visible and centered (Alpine `x-show` no longer hides it)
- Injected dedicated collapsed logo element via render hook with `x-show="!$store.sidebar.isOpen"`
- Removed `Alpine.effect()` script (no longer needed)
- Logo forced to 2rem x 2rem with `object-fit: contain` for consistent sizing

## v1.0.0 — 2025-07-16

Initial release of Arasy Theme.

### Added
- Plugin class (`ArasyThemePlugin`) for Filament panel integration
- Service provider with Spatie PackageTools
- Color palette: primary (indigo), success (green), warning (amber), danger (red), info (blue), gray (zinc)
- Outfit font via Google Font Provider
- IBM Plex Mono font for code and tabular data
- Full CSS override for all major Filament components
- Design token system via CSS custom properties
- Always-dark sidebar styling
- Dark mode support for all components
- Cluster sub-navigation styling matching sidebar
- Sidebar brand name (opt-in via `withSidebarBrandName()`)
- Responsive sidebar layout (fixed, full-height, collapsible)
- Consistent border radius: 1rem cards, 0.5rem inputs, 1.5rem modals
- Install command (`php artisan arasy:install`)
- Auth page styling with brand block
