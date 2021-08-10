<?php

/**
 * This file is based of the PHP Telegram Bot example-bot package.
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
//        $user_id = $message->getFrom()->getId();
        $command = $message->getCommand();

//        // To enable proper use of the /whois command.
//        // If the user is an admin and the command is in the format "/whoisXYZ", call the /whois command
//        if (stripos($command, 'whois') === 0 && $this->telegram->isAdmin($user_id)) {
//            return $this->telegram->executeCommand('whois');
//        }

        return $this->replyToChat("Command /{$command} not found.. Original message: $message");
    }
}
