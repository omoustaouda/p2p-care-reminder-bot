<?php

namespace P2pCareReminder\Service;

use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\TelegramLog;

class TelegramBotService
{
    private string $chatId;

    public function __construct(
        private Telegram $tgClient,
        private array $config
    )
    {
        // Use the pre-existing app logger
        TelegramLog::initialize(
            getLogger(),
            getLogger()
        );
    }

    public function sendMessage(string $messageText): bool
    {
        $response = Request::sendMessage([
            'chat_id' => $this->chatId,
            'text'    => $messageText,
        ]);

        if ($response->getOk()) {
            return true;
        }
        return false;
    }

    public function connectWebhook(): bool
    {
        $hookUrl = $this->config['hookUrl'];

        try {
            /**
             * Connect the webhook URL with the specific bot
             *
             * NOTE:
             *  for self signed certificates, make sure to add the crt in the request:
             *      $result = $telegram->setWebhook($hookUrl, ['certificate' => '/path/to/certificate']);
             */
            $result = $this->tgClient->setWebhook($hookUrl);

            getLogger()->info(
                __METHOD__ . ' - ' . $result->getDescription()
            );

        } catch (TelegramException $e) {
            getLogger()->error(
                __FILE__ . ' - Bot registration failed.',
                ['exception' => $e]
            );
            return false;
        }

        return true;
    }

    public function unsetWebhook(): bool
    {
        try {
            // Unset / delete the webhook
            $result = $this->tgClient->deleteWebhook();

            getLogger()->info(
                __METHOD__ . ' - ' . $result->getDescription(),
                ['response' => $result]
            );

        } catch (TelegramException $e) {
            getLogger()->error(
                __FILE__ . ' - Error while unsetting the webhook',
                ['exception' => $e]
            );
            return false;
        }

        return true;
    }

    public function setChatId(string $chatId): void
    {
        $this->chatId = $chatId;
    }
}
