<?php

use Longman\TelegramBot\Telegram;

include_once __DIR__ . '/../src/bootstrap.php';

try {
    /** @var Telegram $telegram */
    $telegram = get(Telegram::class);
    $telegram->handle();
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    getLogger()->error(
        __FILE__ . ' - Error while handling webhook request.',
        ['exception' => $e]
    );
}
