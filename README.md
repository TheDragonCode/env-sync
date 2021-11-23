# Environment Synchronization

<img src="https://preview.dragon-code.pro/TheDragonCode/env-sync.svg?brand=php" alt="Environment Synchronization"/>

[![Stable Version][badge_stable]][link_packagist]
[![Unstable Version][badge_unstable]][link_packagist]
[![Total Downloads][badge_downloads]][link_packagist]
[![Github Workflow Status][badge_build]][link_build]
[![License][badge_license]][link_license]


## Installation

> If you are using the Laravel framework, then install the [dragon-code/env-sync-laravel](https://github.com/TheDragonCode/env-sync-laravel) package instead.


To get the latest version of `Environment Synchronization`, simply require the project using [Composer](https://getcomposer.org):

```bash
$ composer require dragon-code/env-sync --dev
```

Or manually update `require-dev` block of `composer.json` and run `composer update`.

```json
{
    "require-dev": {
        "dragon-code/env-sync": "^3.0"
    }
}
```

### Upgrade from `andrey-helldar/env-sync`

1. In your `composer.json` file, replace "andrey-helldar/env-sync": "^1.0" with "dragon-code/env-sync": "^3.0".
2. Replace the `Helldar\EnvSync` namespace with `DragonCode\EnvSync` in your app;
3. Run the command `composer update`.
4. Profit!

## How to use

> This package scans files with `*.php`, `*.json`, `*.yml`, `*.yaml` and `*.twig` extensions in the specified folder, receiving from them calls to the `env` and `getenv` functions.
> Based on the received values, the package creates a key-value array. When saving, the keys are split into blocks by the first word before the `_` character.
>
> Also, all keys are sorted alphabetically.

### Frameworks

* Laravel / Lumen Frameworks - See the documentation in [this repository](https://github.com/TheDragonCode/env-sync-laravel).

### Native using

To call a command in your application, you need to do the following:

```php
use DragonCode\EnvSync\Services\Syncer;

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
use DragonCode\EnvSync\Services\Syncer;

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


## License

This package is licensed under the [MIT License](LICENSE).


[badge_build]:          https://img.shields.io/github/workflow/status/TheDragonCode/env-sync/phpunit?style=flat-square

[badge_downloads]:      https://img.shields.io/packagist/dt/dragon-code/env-sync.svg?style=flat-square

[badge_license]:        https://img.shields.io/packagist/l/dragon-code/env-sync.svg?style=flat-square

[badge_stable]:         https://img.shields.io/github/v/release/TheDragonCode/env-sync?label=stable&style=flat-square

[badge_unstable]:       https://img.shields.io/badge/unstable-dev--main-orange?style=flat-square

[link_build]:           https://github.com/TheDragonCode/env-sync/actions

[link_license]:         LICENSE

[link_packagist]:       https://packagist.org/packages/dragon-code/env-sync
