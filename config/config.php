<?php

return [
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
        'extra' => [
            'env' => env('APP_ENV'),
            'php' => PHP_VERSION,
            'laravel' => app()->version(),
        ],
    ],
];
