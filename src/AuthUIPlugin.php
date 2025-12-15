<?php

namespace Ngankt2\AuthUi;

use Ngankt2\AuthUi\Pages\Login;
use Ngankt2\AuthUi\Pages\Register;
use Filament\Auth\Pages\Login as FilamentLogin;
use Filament\Auth\Pages\Register as FilamentRegister;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;

class AuthUIPlugin implements Plugin
{
    protected string $backgroundImage = '';
    protected string $formWidth = '400px';
    protected string $formBackgroundColor = '#ffffff';
    protected string $formPosition = 'left';
    protected array $featureCards = [];
    protected array $socialLogins = [];

    public function getId(): string
    {
        return 'ngankt2-auth-ui';
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public function register(Panel $panel): void
    {
        // Override login page if using default
        if ($panel->getLoginRouteAction() === FilamentLogin::class) {
            $panel->login(Login::class);
        }

        // Override register page if using default
        if ($panel->getRegistrationRouteAction() === FilamentRegister::class) {
            $panel->registration(Register::class);
        }
    }

    public function boot(Panel $panel): void
    {
        FilamentView::registerRenderHook(
            PanelsRenderHook::HEAD_END,
            fn () => '
                <style>
                :root {
                    --ngankt2-form-width: ' . $this->formWidth . ';
                    --ngankt2-form-bg: ' . $this->formBackgroundColor . ';
                    --ngankt2-bg-image: url("' . $this->backgroundImage . '");
                }
                </style>
            '
        );
    }

    /**
     * Set background image URL for the panel
     */
    public function backgroundImage(string $url): static
    {
        $this->backgroundImage = $url;
        return $this;
    }

    public function getBackgroundImage(): string
    {
        return $this->backgroundImage;
    }

    /**
     * Set form panel width
     */
    public function formWidth(string $width): static
    {
        $this->formWidth = $width;
        return $this;
    }

    public function getFormWidth(): string
    {
        return $this->formWidth;
    }

    /**
     * Set form background color
     */
    public function formBackgroundColor(string $color): static
    {
        $this->formBackgroundColor = $color;
        return $this;
    }

    public function getFormBackgroundColor(): string
    {
        return $this->formBackgroundColor;
    }

    /**
     * Set form position: 'left' or 'right'
     */
    public function formPosition(string $position): static
    {
        $this->formPosition = in_array($position, ['left', 'right']) ? $position : 'left';
        return $this;
    }

    public function getFormPosition(): string
    {
        return $this->formPosition;
    }

    /**
     * Set feature cards to display on the side panel
     * Each card should have: icon, title, brief
     *
     * @param array<array{icon: string, title: string, brief: string}> $cards
     */
    public function featureCards(array $cards): static
    {
        $this->featureCards = $cards;
        return $this;
    }

    public function getFeatureCards(): array
    {
        return $this->featureCards;
    }

    public function hasFeatureCards(): bool
    {
        return !empty($this->featureCards);
    }

    /**
     * Set social login buttons
     * Each login should have: url, label, icon (heroicon name), color (optional)
     *
     * @param array<array{url: string, label: string, icon: string, color?: string, svg?: string}> $logins
     */
    public function socialLogins(array $logins): static
    {
        $this->socialLogins = $logins;
        return $this;
    }

    public function getSocialLogins(): array
    {
        return $this->socialLogins;
    }

    public function hasSocialLogins(): bool
    {
        return !empty($this->socialLogins);
    }
}
