<?php

namespace P2pCareReminder\Service;

use InvalidArgumentException;
use Longman\TelegramBot\Telegram;
use Nette\Utils\Finder;
use SplFileInfo;

class TelegramBotService
{
    public function __construct(
        private Telegram $tgClient,
    )
    {
    }

}
