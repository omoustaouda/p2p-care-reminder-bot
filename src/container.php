<?php
declare(strict_types=1);

use Longman\TelegramBot\Telegram;
use P2pCareReminder\Service\AppConfigService;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use P2pCareReminder\Service\TelegramBotService;
use Psr\Log\LoggerInterface;

/**
 * Container used is: http://php-di.org/
 *
 * Auto-wiring is enabled: by analyzing the constructor signature (via type-hints),
 * the needed dependencies are automatically injected for each class defined here.
 */

return [
    AppConfigService::class => static function () {
        return new AppConfigService(APP_ROOT . 'config');
    },
    LoggerInterface::class => static function () {
        $logger = new Logger(APP_NAME);
        $logger->pushHandler(new StreamHandler('php://stdout', Logger::DEBUG));
        // Create one log file per day, keep only the last 30 files.
        $logger->pushHandler(new RotatingFileHandler(
            LOG_FILE_PATH,
            30,
            Logger::INFO),
        );
        return $logger;
    },
    Telegram::class => static function () {
        $tgConfig = config('telegram');

        return new Telegram(
            $tgConfig['botApiKey'],
            $tgConfig['botUsername'],
        );
    },
    TelegramBotService::class => static function () {
        return new TelegramBotService(
            get(Telegram::class),
            config('telegram'),
        );
    }
];
