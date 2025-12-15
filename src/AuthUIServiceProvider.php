<?php

namespace Ngankt2\AuthUi;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AuthUIServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('ngankt2-auth-ui')
            ->hasViews()
            ->hasTranslations();
    }
}
