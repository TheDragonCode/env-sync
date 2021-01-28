<?php

return [
    'forces' => [
        'APP_ENV'   => 'production',
        'APP_DEBUG' => false,
        'APP_URL'   => 'http://localhost',

        'LOG_CHANNEL' => 'daily',
        'LOG_LEVEL'   => 'debug',

        'DB_CONNECTION' => 'mysql',
        'DB_HOST'       => '127.0.0.1',
        'DB_PORT'       => 3306,
        'DB_DATABASE'   => 'default',

        'BROADCAST_DRIVER' => 'redis',
        'CACHE_DRIVER'     => 'redis',
        'QUEUE_CONNECTION' => 'redis',
        'SESSION_DRIVER'   => 'redis',
        'SESSION_LIFETIME' => 120,

        'REDIS_HOST' => '127.0.0.1',
        'REDIS_PORT' => 6379,

        'MAIL_MAILER' => 'smtp',
        'MAIL_HOST'   => 'mailhog',
        'MAIL_PORT'   => 1025,
    ],
];
