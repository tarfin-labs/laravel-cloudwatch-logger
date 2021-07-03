# Laravel Logger for AWS CloudWatch

Laravel logger factory for AWS Cloudwatch Logs service.

## Installation

You can install the package via composer:

```bash
composer require tarfin-labs/laravel-cloudwatch-logger
```

## Usage

Config parameters for logging are defined at `config/logging.php`.

You need to add new channel as `cloudwatch` and copy params inside `config/config.php` into it.

```php
'channels' => [
    ...

    'cloudwatch' => [
        'driver' => 'custom',
        'via' => \TarfinLabs\LaravelCloudWatchLogger\LaravelCloudWatchLoggerFactory::class,
        'aws' => [
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'version' => 'latest',
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ],
        'name' => env('CLOUDWATCH_LOG_NAME', ''),
        'group' => env('CLOUDWATCH_LOG_GROUP_NAME', env('APP_NAME') . '-' . env('APP_ENV')),
        'stream' => env('CLOUDWATCH_LOG_STREAM', 'default'),
        'retention' => env('CLOUDWATCH_LOG_RETENTION', 7),
        'level' => env('CLOUDWATCH_LOG_LEVEL', 'error'),
        'extra' => [        // In case there's extra information to be logged
            'env' => env('APP_ENV'),
            'php' => PHP_VERSION,
            'laravel' => app()->version(),
        ],
    ],
],
```

Change the log channel inside `.env` file with `cloudwatch`.

```dotenv
LOG_CHANNEL=cloudwatch
```

You can use Laravel's default `Log` class to send your logs to CloudWatch.

```php
\Illuminate\Support\Facades\Log::info('user logged in successfully', [
    'id' => 1,
    'username' => 'JohnDoe',
    'ip' => '127.0.0.1',
]);
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email development@tarfin.com instead of using the issue tracker.

## Credits

-   [Turan Karatuğ](https://github.com/tkaratug)
-   [Faruk Can](https://github.com/frkcn)
-   [Yunus Emre Deligöz](https://github.com/deligoez)
-   [Hakan Özdemir](https://github.com/hozdemir)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
