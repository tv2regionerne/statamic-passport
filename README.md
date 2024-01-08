# Statamic Passport Addon

<!-- statamic:hide -->
[![Packagist](https://img.shields.io/packagist/v/tv2regionerne/statamic-passport.svg?style=flat-square)](https://packagist.org/packages/tv2regionerne/statamic-passport)
[![Downloads](https://img.shields.io/packagist/dt/tv2regionerne/statamic-passport.svg?style=flat-square)](https://packagist.org/packages/tv2regionerne/statamic-passport)
[![License](https://img.shields.io/github/license/tv2regionerne/statamic-passport.svg?style=flat-square)](LICENSE)
[![Supported Statamic version](https://img.shields.io/badge/Statamic-4.0%2B-FF269E)](https://github.com/statamic/cms/releases)
<!-- /statamic:hide -->

This addon adds A UI into Statamic to manage Laravel Passport Clients and personal tokens.
![Skærmbillede 2024-01-08 kl  10 15 43](https://github.com/tv2regionerne/statamic-passport/assets/2431914/3229a8a9-f014-4400-ba39-7b8243868ad5)


## Features

This fieldtype can be found under the "Integration" category.

## How to Install

You can search for this addon in the `Tools > Addons` section of the Statamic control panel and click **install**, or run the following command from your project root:

``` bash
composer require tv2regionerne/statamic-passport
```

The addon will require Laravel Passport to be installed. If not already installed, the package will be added.  
Please follow the instructions in the [Laravel documentation](https://laravel.com/docs/10.x/passport) for the passport installation.

Be aware that Laravel Passport default routes will clash with Statamic OAuth authentication if enabled: ```STATAMIC_OAUTH_ENABLED=true```.
Please change the Passport prefix if you are using OAuth Authentication. This is done in ```config/passport.php``` by changing the 'path' parameter to eg. passport instead of oauth.

## How to Use

After installation ```Passport``` will be present in the menu under Users for all users with the permissions to access it.

Enjoy cropping away!
