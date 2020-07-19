# PHP-SkyNet
#### For use with SiaCoin's Global SkyNet Network

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/php-skynet.svg?style=flat-square)](https://packagist.org/packages/spatie/php-skynet)
![Tests](https://github.com/mechawrench/php-skynet/workflows/Tests/badge.svg)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/php-skynet.svg?style=flat-square)](https://packagist.org/packages/spatie/php-skynet)


SkyNet by SiaCoin allows for users to upload files for download by anyone else in the world.  I noticed there was no 
support for PHP/Laravel so I created a package to upload/download files from SkyNet.

## Installation

You can install the package via composer:

```bash
composer require mechawrench/php-skynet
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Mechawrench\PhpSkynet\PhpSkynetServiceProvider" --tag="config"
```

This is the contents of the published config file:

```php
return [
    'default_portal_url' => env('SKYNET_DEFAULT_PORTAL_URL'),

    'siad_host' => env('SIAD_HOST'),

    'siad_api_key' => env('SIAD_API_KEY'),
];
```

## Usage

- Ensure you fill out the config file, or preferably the environment variables
- Decide if you will use a SkyNet web portal or your own Siad instance
  - We will not get into details of configuring this on your own, technical skills are assumed

``` php
// SkyNet Portal Usage
// Stores files under storage/app
$upload = \Mechawrench\PhpSkynet\PhpSkynet::upload(storage_path('app/Bitcoin-Accepted-Here-Button-PNG-Clipart.png'));
$download = \Mechawrench\PhpSkynet\PhpSkynet::download('GAAGFVdQTCpf43KH7Wami5iNldaEHbyxQXhjDkd_ifob2g');

// Private Siad Instance Usage
$upload = \Mechawrench\PhpSkynet\PhpSkynet::uploadSiad('Bitcoin-Accepted-Here-Button-PNG-Clipart.png', storage_path('app/Bitcoin-Accepted-Here-Button-PNG-Clipart.png'), $my_optional_siad_host, $my_optional_siad_apiKey);
$download = \Mechawrench\PhpSkynet\PhpSkynet::downloadSiad($skyLink, $optional_filename, $optional_siad_host);
```
## Current Limitations
- Can only upload/download single files at a time for now

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email jesse.schneider@hey.com instead of using the issue tracker.

## Credits

- [Jesse Schneider](https://github.com/Mechawrench)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
