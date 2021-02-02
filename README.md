# Environment Synchronization

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

> ATTENTION!
>
> Package version 1.0 includes implementation of console commands for Laravel and Symfony frameworks. Since version 2.0, implementations have been moved to separate packages. If you are using Laravel framework - install [andrey-helldar/env-sync-laravel](https://github.com/andrey-helldar/env-sync-laravel) package, if Symfony - [andrey-helldar/env-sync-symfony](https://github.com/andrey-helldar/env-sync-symfony).

## Table of contents

* [Installation](#installation)
* [How to use](#how-to-use)
    * [Frameworks](#frameworks)
    * [Native using](#native-using)

## Installation

> If you are using the Laravel framework, then install the [andrey-helldar/env-sync-laravel](https://github.com/andrey-helldar/env-sync-laravel) package instead.
>
> If you are using the Symfony framework, then install the [andrey-helldar/env-sync-symfony](https://github.com/andrey-helldar/env-sync-symfony) package instead.


To get the latest version of `Environment Synchronization`, simply require the project using [Composer](https://getcomposer.org):

```bash
$ composer require andrey-helldar/env-sync --dev
```

Or manually update `require-dev` block of `composer.json` and run `composer update`.

```json
{
    "require-dev": {
        "andrey-helldar/env-sync": "^2.0"
    }
}
```

## How to use

> This package scans files with `*.php`, `*.json`, `*.yml`, `*.yaml` and `*.twig` extensions in the specified folder, receiving from them calls to the `env` and `getenv` functions.
> Based on the received values, the package creates a key-value array. When saving, the keys are split into blocks by the first word before the `_` character.
>
> Also, all keys are sorted alphabetically.

### Frameworks

* Laravel / Lumen Frameworks - See the documentation in [this repository](https://github.com/andrey-helldar/env-sync-laravel).
* Symfony Framework - See the documentation in [this repository](https://github.com/andrey-helldar/env-sync-symfony).

### Native using

To call a command in your application, you need to do the following:

```php
use Helldar\EnvSync\Services\Syncer;

protected function syncer(): Syncer
{
    return Syncer::make();
}

protected function sync()
{
    $this->syncer()
       ->path(__DIR__)
       ->filename('.env.example')
       ->store();
}
```

If you want to define default values or specify which key values should be stored, you need to pass an array to the constructor of the `Config` class:

```php
use Helldar\EnvSync\Services\Syncer;

protected function syncer(): Syncer
{
    return Syncer::make($this->config());
}

protected function config(): array
{
    return require realpath(__DIR__ . '/your-path/your-config.php');
}
```

You can also suggest your implementation by sending a PR. We will be glad 😊

[badge_build]:          https://img.shields.io/github/workflow/status/andrey-helldar/env-sync/phpunit?style=flat-square

[badge_downloads]:      https://img.shields.io/packagist/dt/andrey-helldar/env-sync.svg?style=flat-square

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
