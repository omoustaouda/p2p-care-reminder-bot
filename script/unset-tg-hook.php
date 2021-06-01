<?php

include_once __DIR__ . '/../src/bootstrap.php';

/** @var array $telegramConfig */
$telegramConfig = require __DIR__ . '/../config/telegram.php';

try {
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($telegramConfig['botApiKey'], $telegramConfig['botUsername']);

    // Unset / delete the webhook
    $result = $telegram->deleteWebhook();

    echo $result->getDescription();
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    getLogger()->error(
        __FILE__ . ' - Error while unsetting the webhook',
        ['exception' => $e]
    );
}
