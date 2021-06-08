<?php
declare(strict_types=1);

use Longman\TelegramBot\Telegram;
use P2pCareReminder\Service\AppConfigService;
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
        $loggerConfig = config('logger');
        $logger = new Logger($loggerConfig['loggerName']);
        $logger->setHandlers($loggerConfig['handlers']);
        return $logger;
    },
    Telegram::class => static function () {
        $tgConfig = config('telegram');

        $tgClient = new Telegram(
            $tgConfig['botApiKey'],
            $tgConfig['botUsername'],
        );
        $tgClient->enableLimiter(['enabled' => true]);
        $tgClient->addCommandsPath(__DIR__ . '/TelegramCommand/');
        return $tgClient;
    },
    TelegramBotService::class => static function () {
        return new TelegramBotService(
            get(Telegram::class),
            config('telegram'),
        );
    }
];
