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

/**
 * Generic message command
 *
 * Gets executed when any type of message is sent.
 *
 * In this group-related context, we can handle new and left group members.
 */

namespace P2pCareReminder\TelegramCommand\Group;

use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;

class GenericMessageCommand extends SystemCommand
{
    /**
     * @var string
     */
    protected $name = 'genericmessage';

    /**
     * @var string
     */
    protected $description = 'Handle generic message';

    /**
     * @var string
     */
    protected $version = '1.0.0';

    /**
     * Main command execution
     *
     * @return ServerResponse
     * @throws TelegramException
     */
    public function execute(): ServerResponse
    {
        $message = $this->getMessage();

        // Handle new chat members
        if ($message->getNewChatMembers()) {
            return $this->getTelegram()->executeCommand('newchatmember');
        }

        // Handle left chat members
        if ($message->getLeftChatMember()) {
            return $this->getTelegram()->executeCommand('leftchatmember');
        }

        // The chat photo was changed
        if ($message->getNewChatPhoto()) {
            return $this->replyToChat('Sweet! 😍');
        }

        return Request::emptyResponse();
    }
}
