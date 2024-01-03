<?php

namespace Tv2regionerne\StatamicPassport;

use Statamic\Facades\CP\Nav;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $routes = [
        'cp' => __DIR__.'/../routes/cp.php',
    ];

    protected $vite = [
        'input' => [
            'resources/js/addon.js',
        ],
    ];

    public function bootAddon()
    {
        Nav::extend(function ($nav) {
            $nav->create('Passport')
                ->section('Users')
                ->route('passport.index')
                ->icon('user');
        });
    }
}
