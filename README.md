# Laravel UTM Tracker

[![Latest Version on Packagist](https://img.shields.io/packagist/v/code-tree-dev/laravel-utm-tracker.svg?style=flat-square)](https://packagist.org/packages/code-tree-dev/laravel-utm-tracker)
[![Total Downloads](https://img.shields.io/packagist/dt/code-tree-dev/laravel-utm-tracker.svg?style=flat-square)](https://packagist.org/packages/code-tree-dev/laravel-utm-tracker)
![GitHub Actions](https://github.com/code-tree-dev/laravel-utm-tracker/actions/workflows/main.yml/badge.svg)

Laravel UTM Tracker is a package for Laravel that automatically or manually tracks UTM parameters from your visitors and stores them in your database. It is ideal for marketing attribution, analytics, and campaign tracking. The package is easy to configure, extend, and integrates seamlessly with Laravel middleware and facades.

## Features

-   Automatic UTM tracking via middleware
-   Manual UTM tracking via Facade
-   Stores UTM data in the database, session, or cookie
-   Easily extendable for custom UTM parameters
-   Ready for analytics and marketing attribution

## Installation

Install the package via Composer:

```bash
composer require code-tree-dev/laravel-utm-tracker
```

Publish the config and migration files (optional):

```bash
php artisan vendor:publish --provider="CodeTreeDev\LaravelUtmTracker\LaravelUtmTrackerServiceProvider"
```

Run the migrations if using database storage:

```bash
php artisan migrate
```

## Configuration

You can configure the package in `config/laravel-utm-tracker.php`:

-   `storage`: Where to store UTM data (`session`, `cookie`, or `database`)
-   `parameters`: Default UTM parameters to track
-   `custom_parameters`: Add your own custom UTM parameters
-   `cookie_lifetime`: Lifetime for cookies (if using cookie storage)
-   `auto_track`: Enable/disable automatic tracking via middleware
-   `table`: Table name for database storage

## Usage

### Automatic Tracking (Middleware)

By default, the package's middleware is registered and will automatically capture UTM parameters from incoming requests:

```php
// No action needed if auto_track is enabled in config.
```

### Manual Tracking (Facade)

You can manually create a UTM visit record using the Facade:

```php
use LaravelUtmTracker;

LaravelUtmTracker::track([
    'utm_source' => 'newsletter',
    'utm_medium' => 'email',
    'utm_campaign' => 'spring_sale',
    // ...other fields...
]);
```

### Testing

Run the test suite with:

```bash
composer test
```

## Contributing

Contributions are welcome! Please read the [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) files for details.

-   Open issues for bugs or feature requests
-   Submit pull requests for improvements

## Security

If you discover any security related issues, please email codetreedev@gmail.com instead of using the issue tracker.

## Changelog

See [CHANGELOG](CHANGELOG.md) for recent changes.

## Credits

-   [Code-Tree.dev](https://github.com/code-tree-dev)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). See [License File](LICENSE.md) for details.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
