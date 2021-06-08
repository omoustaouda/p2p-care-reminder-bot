<?php

use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

return [
    'loggerName' => APP_NAME,
    'handlers' => [
        // Printout to stdout the logger output
        new StreamHandler('php://stdout', Logger::DEBUG),
        // Create one log file per day, keep only the last 30 files.
        new RotatingFileHandler(
            APP_ROOT . 'logs/app.log', // log files path
            30,
            Logger::INFO
        ),
    ]
];
