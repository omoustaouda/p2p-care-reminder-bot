<?php

use Longman\TelegramBot\Entities\Update;
use Longman\TelegramBot\Telegram;

include_once __DIR__ . '/../src/bootstrap.php';

// Define the list of allowed Update types manually:
$allowedUpdates = [
    Update::TYPE_MESSAGE,
    Update::TYPE_CHAT_MEMBER,
];

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
