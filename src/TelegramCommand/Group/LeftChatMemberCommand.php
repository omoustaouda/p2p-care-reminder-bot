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

/**
 * Left chat member command
 *
 * Gets executed when a member leaves the chat.
 *
 * NOTE: This command must be called from GenericmessageCommand.php!
 * It is only in a separate command file for easier code maintenance.
 */

namespace P2pCareReminder\TelegramCommand\Group;

use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;

class LeftChatMemberCommand extends SystemCommand
{
    /**
     * @var string
     */
    protected $name = 'leftchatmember';

    /**
     * @var string
     */
    protected $description = 'Left Chat Member';

    /**
     * @var string
     */
    protected $version = '1.2.0';

    /**
     * Main command execution
     *
     * @return ServerResponse
     * @throws TelegramException
     */
    public function execute(): ServerResponse
    {
        $message = $this->getMessage();
        $member  = $message->getLeftChatMember();

        return $this->replyToChat('Sorry to see you go, ' . $member->getFirstName());
    }
}
