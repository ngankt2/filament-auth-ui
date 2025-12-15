<?php

namespace Ngankt2\AuthUi\Pages;

use Ngankt2\AuthUi\Concerns\HasSplitLayout;
use Filament\Auth\Pages\Register as BaseRegister;

class Register extends BaseRegister
{
    use HasSplitLayout;

    protected function hasFullWidthFormActions(): bool
    {
        return true;
    }
}
