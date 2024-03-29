<?php

declare(strict_types=1);

return [
    'ABLY_KEY' => null,

    'APP_DEBUG' => false,
    'APP_ENV'   => 'testing',
    'APP_KEY'   => null,
    'APP_NAME'  => 'Laravel',
    'APP_URL'   => 'http://localhost',

    'ASSET_URL' => null,

    'AWS_ACCESS_KEY_ID'     => null,
    'AWS_BUCKET'            => null,
    'AWS_DEFAULT_REGION'    => 'us-east-1',
    'AWS_ENDPOINT'          => null,
    'AWS_SECRET_ACCESS_KEY' => null,
    'AWS_URL'               => null,

    'BCRYPT_ROUNDS' => 10,

    'BROADCAST_DRIVER' => null,

    'CACHE_DRIVER' => 'array',
    'CACHE_PREFIX' => null,

    'CONEMUANSI' => null,

    'DATABASE_URL' => null,

    'DB_CONNECTION'   => 'mysql',
    'DB_DATABASE'     => 'forge',
    'DB_FOREIGN_KEYS' => null,
    'DB_HOST'         => '127.0.0.1',
    'DB_PASSWORD'     => null,
    'DB_PORT'         => 3306,
    'DB_SOCKET'       => '',
    'DB_USERNAME'     => null,

    'DYNAMODB_CACHE_TABLE' => 'cache',
    'DYNAMODB_ENDPOINT'    => null,

    'FILESYSTEM_DRIVER' => 'local',

    'LOG_CHANNEL'           => 'stack',
    'LOG_LEVEL'             => 'debug',
    'LOG_SLACK_WEBHOOK_URL' => null,
    'LOG_STDERR_FORMATTER'  => null,

    'MAILGUN_DOMAIN'   => null,
    'MAILGUN_ENDPOINT' => 'api.mailgun.net',
    'MAILGUN_SECRET'   => null,

    'MAIL_ENCRYPTION'    => 'tls',
    'MAIL_FROM_ADDRESS'  => 'hello@example.com',
    'MAIL_FROM_NAME'     => 'Example',
    'MAIL_HOST'          => 'smtp.mailgun.org',
    'MAIL_LOG_CHANNEL'   => null,
    'MAIL_MAILER'        => 'smtp',
    'MAIL_PASSWORD'      => null,
    'MAIL_PORT'          => 587,
    'MAIL_SENDMAIL_PATH' => '/usr/sbin/sendmail -t -i',
    'MAIL_USERNAME'      => null,

    'MEMCACHED_HOST'          => '127.0.0.1',
    'MEMCACHED_PASSWORD'      => null,
    'MEMCACHED_PERSISTENT_ID' => null,
    'MEMCACHED_PORT'          => 11211,
    'MEMCACHED_USERNAME'      => null,

    'MYSQL_ATTR_SSL_CA' => null,

    'PAPERTRAIL_PORT' => null,
    'PAPERTRAIL_URL'  => null,

    'POSTMARK_TOKEN' => null,

    'PUSHER_APP_CLUSTER' => null,
    'PUSHER_APP_ID'      => null,
    'PUSHER_APP_KEY'     => null,
    'PUSHER_APP_SECRET'  => null,

    'QUEUE_CONNECTION'    => 'sync',
    'QUEUE_FAILED_DRIVER' => 'database-uuids',

    'REDIS_CACHE_DB' => 1,
    'REDIS_CLIENT'   => null,
    'REDIS_CLUSTER'  => 'redis',
    'REDIS_DB'       => 0,
    'REDIS_HOST'     => '127.0.0.1',
    'REDIS_PASSWORD' => null,
    'REDIS_PORT'     => 6379,
    'REDIS_PREFIX'   => null,
    'REDIS_QUEUE'    => 'default',
    'REDIS_URL'      => null,

    'SESSION_CONNECTION'    => null,
    'SESSION_DOMAIN'        => null,
    'SESSION_DRIVER'        => 'array',
    'SESSION_LIFETIME'      => 120,
    'SESSION_SECURE_COOKIE' => null,
    'SESSION_STORE'         => null,

    'SQS_PREFIX' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
    'SQS_QUEUE'  => 'your-queue-name',
    'SQS_SUFFIX' => null,
];
