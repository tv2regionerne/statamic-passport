<?php

namespace Tv2regionerne\StatamicPassport;

use Laravel\Passport\Passport;
use Statamic\Facades\CP\Nav;
use Statamic\Facades\Permission;
use Statamic\Providers\AddonServiceProvider;
use Statamic\Statamic;

class ServiceProvider extends AddonServiceProvider
{
    protected $routes = [
        'cp' => __DIR__ . '/../routes/cp.php',
    ];

    protected $vite = [
        'input' => [
            'resources/js/addon.js',
        ],
    ];

    public function register(): void
    {
        parent::register();

        app()->booting(function () {
            Passport::$registersJsonApiRoutes = true;
        });
    }

    public function bootAddon(): void
    {
        Statamic::provideToScript([
            'passport' => [
                'url' => (string) url(config('passport.path', 'oauth')),
            ],
        ]);

        Permission::extend(function () {
            Permission::register('manage passport')
                ->label(__('Manage Passport'));
        });

        Nav::extend(function ($nav) {
            $nav->create(__('Passport'))
                ->section('Users')
                ->route('passport.index')
                ->icon('user')
                ->can('manage passport');
        });
    }
}
