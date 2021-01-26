# Env Sync

<p align="center">
    <img src="/.github/images/logo.png?raw=true" alt="Env Sync"/>
</p>

[![StyleCI Status][badge_styleci]][link_styleci]
[![Github Workflow Status][badge_build]][link_build]
[![Coverage Status][badge_coverage]][link_scrutinizer]
[![Scrutinizer Code Quality][badge_quality]][link_scrutinizer]

[![Stable Version][badge_stable]][link_packagist]
[![Unstable Version][badge_unstable]][link_packagist]
[![Total Downloads][badge_downloads]][link_packagist]
[![License][badge_license]][link_license]

[![For Laravel][badge_laravel]][link_packagist]
[![For Lumen][badge_lumen]][link_packagist]

## Table of contents

* [Installation](#installation)
* [How to use](#how-to-use)
    * [Laravel/Lumen Frameworks](#laravellumen-frameworks)
    * [Other using](#other-using)

## Installation

To get the latest version of `Env Sync`, simply require the project using [Composer](https://getcomposer.org):

```bash
$ composer require andrey-helldar/env-sync --dev
```

Or manually update `require` block of `composer.json` and run `composer update`.

```json
{
    "require-dev": {
        "andrey-helldar/env-sync": "^1.0"
    }
}
```

## How to use

### Laravel/Lumen Frameworks

Just execute the `php artisan env:sync` command.

You can also specify the invocation when executing the `composer update` command in `composer.json` file:

```json
{
    "scripts": {
        "post-update-cmd": [
            "php artisan sync:env"
        ]
    }
}
```

Now, every time you run the `composer update` command, the environment settings file will be synchronized.

### Other using

To call a command in your application, you need to do the following:

```php
use Helldar\EnvSync\Services\Compiler;
use Helldar\EnvSync\Services\Parser;
use Helldar\EnvSync\Services\Stringify;
use Helldar\EnvSync\Services\Syncer;

protected function syncer(): Syncer
{
    $parser    = new Parser();
    $stringify = new Stringify();
    $compiler  = new Compiler($stringify);

    return new Syncer($parser, $compiler);
}

protected function sync()
{
    $this->syncer()
        ->from('/** path to .env file */')
        ->to('/** path to .env.example file */')
        ->store();
}
```

You can also suggest your implementation by sending a PR. We will be glad 😊

[badge_build]:          https://img.shields.io/github/workflow/status/andrey-helldar/env-sync/phpunit?style=flat-square

[badge_downloads]:      https://img.shields.io/packagist/dt/andrey-helldar/env-sync.svg?style=flat-square

[badge_laravel]:        https://img.shields.io/badge/Laravel-6.x%20%7C%207.x%20%7C%208.x-orange.svg?style=flat-square

[badge_lumen]:          https://img.shields.io/badge/Lumen-6.x%20%7C%207.x%20%7C%208.x-orange.svg?style=flat-square

[badge_license]:        https://img.shields.io/packagist/l/andrey-helldar/env-sync.svg?style=flat-square

[badge_coverage]:       https://img.shields.io/scrutinizer/coverage/g/andrey-helldar/env-sync.svg?style=flat-square

[badge_quality]:        https://img.shields.io/scrutinizer/g/andrey-helldar/env-sync.svg?style=flat-square

[badge_stable]:         https://img.shields.io/github/v/release/andrey-helldar/env-sync?label=stable&style=flat-square

[badge_styleci]:        https://styleci.io/repos/333111450/shield

[badge_unstable]:       https://img.shields.io/badge/unstable-dev--main-orange?style=flat-square

[link_build]:           https://github.com/andrey-helldar/env-sync/actions

[link_license]:         LICENSE

[link_packagist]:       https://packagist.org/packages/andrey-helldar/env-sync

[link_scrutinizer]:     https://scrutinizer-ci.com/g/andrey-helldar/env-sync/?branch=main

[link_styleci]:         https://github.styleci.io/repos/333111450
