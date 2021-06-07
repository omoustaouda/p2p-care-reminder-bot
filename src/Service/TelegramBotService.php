<?php

namespace P2pCareReminder\Service;

use Longman\TelegramBot\ChatAction;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\TelegramLog;
use Psr\Log\LoggerInterface;

class TelegramBotService
{
    private array $groupParticipants = [];
    private string $chatId = '-549160779'; // TODO: get chatId from request

    public function __construct(
        private Telegram $tgClient,
        LoggerInterface $logger
    )
    {

        // Use the pre-existing app logger
        TelegramLog::initialize(
            $logger,
            $logger
        );
    }

    public function sendMessage(): void
    {
        Request::sendChatAction([
            'chat_id' => $this->chatId,
            'action'  => ChatAction::TYPING,
        ]);

        // TODO: send message

    }

    public function handleUpdateNewUser(): void
    {

    }
}
