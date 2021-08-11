<?php

/**
 * This file is based on the PHP Telegram Bot example-bot package.
 * https://github.com/php-telegram-bot/example-bot/
 *
 * (c) PHP Telegram Bot Team
 * (c) 2021 - Othmane Moustaouda <web@othmanemoustaouda.io>
 *
 * Original license: `src/TelegramCommand/LICENSE_TelegramBotExample`
 */

namespace P2pCareReminder\TelegramCommand\Generic;

use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;

/**
 * Generic command
 *
 * Gets executed for generic commands, when no other appropriate one is found.
 */
class GenericCommand extends SystemCommand
{
    /**
     * @var string
     */
    protected $name = 'generic';

    /**
     * @var string
     */
    protected $description = 'Handles generic commands or is executed by default when a command is not found';

    /**
     * @var string
     */
    protected $version = '1.1.0';

    /**
     * Main command execution
     *
     * @return ServerResponse
     * @throws TelegramException
     */
    public function execute(): ServerResponse
    {
        $message = $this->getMessage();
        $command = $message->getCommand();

        $messageText = $message->getText();

        return $this->replyToChat("Command /{$command} not found.. Original message: $messageText");
    }
}
