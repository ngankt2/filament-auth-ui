<?php

namespace Ngankt2\AuthUi\Pages;

use Ngankt2\AuthUi\Concerns\HasSplitLayout;
use Filament\Auth\Pages\Login as BaseLogin;

class Login extends BaseLogin
{
    use HasSplitLayout;

    protected function hasFullWidthFormActions(): bool
    {
        return true;
    }
}
