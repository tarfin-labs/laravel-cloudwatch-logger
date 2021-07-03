<?php

namespace TarfinLabs\LaravelCloudWatchLogger;

use Aws\CloudWatchLogs\CloudWatchLogsClient;
use Maxbanton\Cwh\Handler\CloudWatch;
use Monolog\Logger;

class LaravelCloudWatchLoggerFactory
{
    /**
     * @param array $config
     * @return Logger
     * @throws \Exception
     */
    public function __invoke(array $config)
    {
        $aws = $config['aws'];
        $tags = $config['tags'] ?? [];
        $name = $config['name'];

        // Instantiate AWS SDK Cloudwatch Logs Client
        $client = new CloudWatchLogsClient($aws);

        // Log group name, will be created if none
        $groupName = $config['group'];

        // Log stream name, will be created if none
        $streamName = $config['stream'];

        // Days to keep logs, 14 by default. Set to 'null' to allow indefinite retention
        $retentionDays = $config['retention'];

        // Instantiate handler (tags are optional)
        $handler = new CloudWatch($client, $groupName, $streamName, $retentionDays, 10000, $tags);

        // Create a log channel
        $logger = new Logger($name);

        $logger->pushHandler($handler);

        if (isset($record['extra'])) {
            $logger->pushProcessor(function ($record) use ($config) {
                $record['extra'] = $config['extra'];
                return $record;
            });
        }

        return $logger;
    }
}
