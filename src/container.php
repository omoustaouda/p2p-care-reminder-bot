<?php
declare(strict_types=1);

use Longman\TelegramBot\Telegram;
use P2pCareReminder\Service\PlaceholderService;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

/**
 * Container used is: http://php-di.org/
 *
 * Auto-wiring is enabled: by analyzing the constructor signature (via type-hints),
 * the needed dependencies are automatically injected for each class defined here.
 */

$tgConfig = require __DIR__ . '/../config/telegram.php';

return [
    PlaceholderService::class => DI\autowire(PlaceholderService::class),
    LoggerInterface::class => static function () {
        $logger = new Logger(APP_NAME);
        $logger->pushHandler(new StreamHandler('php://stdout', Logger::DEBUG));
        // Create one log file per day, keep only the last 30 files.
        $logger->pushHandler(new RotatingFileHandler(
            LOG_FILE_PATH,
            30,
            Logger::INFO)
        );
        return $logger;
    },
    Telegram::class => static function () use ($tgConfig) {
        return new Telegram(
            $tgConfig['apiKey'],
            $tgConfig['botUsername']
        );
    }
];