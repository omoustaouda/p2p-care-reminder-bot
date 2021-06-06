<?php

// Load composer
use Longman\TelegramBot\Telegram;

require __DIR__ . '../src/bootstrap.php';

// TODO: get the config from the container
$tgConfig = require __DIR__ . '/../config/telegram.php';
$hookUrl = $tgConfig['hookUrl'];

try {
    /** @var Telegram $telegram */
    $telegram = get(Telegram::class);

    /**
     * Connect the webhook URL with the specific bot
     *
     * NOTE:
     *  for self signed certificates, make sure to add the crt in the request:
     *      $result = $telegram->setWebhook($hookUrl, ['certificate' => '/path/to/certificate']);
     */
    $result = $telegram->setWebhook($hookUrl);


    if ($result->isOk()) {
        echo $result->getDescription();
    }
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    getLogger()->error(
        __FILE__ . ' - Bot registration failed.',
        ['exception' => $e]
    );
}
