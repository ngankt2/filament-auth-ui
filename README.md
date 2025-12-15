# Ngankt2 Auth UI

A beautiful split-layout authentication UI plugin for Filament v4 panels with configurable form position and feature cards.

## Installation

```bash
composer require ngankt2/filament-auth-ui
```

## Usage

Add the plugin to your Panel Provider:

```php
use Ngankt2\AuthUi\AuthUIPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugin(
            AuthUIPlugin::make()
                ->formPosition('left')  // or 'right'
                ->featureCards([
                    [
                        'icon' => 'heroicon-o-academic-cap',
                        'title' => 'Learn Anywhere',
                        'brief' => 'Access courses from any device'
                    ],
                    [
                        'icon' => 'heroicon-o-user-group',
                        'title' => 'Community',
                        'brief' => 'Connect with thousands of learners'
                    ],
                    [
                        'icon' => 'heroicon-o-chart-bar',
                        'title' => 'Track Progress',
                        'brief' => 'Personal dashboard for your journey'
                    ],
                ])
        );
}
```

## Configuration Options

### Form Position

```php
->formPosition('left')   // Login form on left (default)
->formPosition('right')  // Login form on right
```

### Feature Cards

Display promotional cards alongside the login form:

```php
->featureCards([
    [
        'icon' => 'heroicon-o-sparkles',  // Any Heroicon
        'title' => 'Card Title',
        'brief' => 'Short description'
    ],
    // ... more cards (recommended: 3-4)
])
```

If no cards are configured, skeleton placeholders are shown automatically.

### Background Image (Legacy)

```php
->backgroundImage('/images/auth-bg.jpg')
```

### Form Styling

```php
->formWidth('400px')           // Form panel width
->formBackgroundColor('#fff')  // Form background color
```

### Social Logins

```php
->socialLogins([
    [
        'url' => '/auth/google',
        'label' => 'Đăng nhập bằng Google',
        'svg' => '<svg viewBox="0 0 24 24" width="20" height="20">...</svg>',
    ],
    [
        'url' => '/auth/facebook',
        'label' => 'Đăng nhập bằng Facebook', 
        'icon' => 'heroicon-o-globe-alt',  // or use svg
        'color' => '#1877F2',  // optional button color
    ],
])
```

## Screenshots

| Form Left | Form Right |
|-----------|------------|
| Login form on the left with feature cards on the right | Login form on the right with feature cards on the left |

## Requirements

- PHP 8.3+
- Laravel 11+
- Filament 4.0+

## License

MIT
