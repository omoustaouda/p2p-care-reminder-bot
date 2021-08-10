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
 * New chat members command
 *
 * Gets executed when a new member joins the chat.
 *
 * NOTE: This command must be called from GenericMessageCommand.php!
 * It is only in a separate command file for easier code maintenance.
 */

namespace P2pCareReminder\TelegramCommand\Group;

use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;

class NewChatMemberCommand extends SystemCommand
{
    /**
     * @var string
     */
    protected $name = 'newchatmembers';

    /**
     * @var string
     */
    protected $description = 'New Chat Members';

    /**
     * @var string
     */
    protected $version = '1.3.0';

    /**
     * Main command execution
     *
     * @return ServerResponse
     * @throws TelegramException
     */
    public function execute(): ServerResponse
    {
        $message = $this->getMessage();
        $members = $message->getNewChatMembers();

        if ($message->botAddedInChat()) {
            return $this->onBotAddedToGroupChat();
        }

        $member_names = [];
        foreach ($members as $member) {
            $member_names[] = $member->tryMention();
        }

        return $this->replyToChat('Welcome ' . implode(', ', $member_names) . '!');
    }

    public function onBotAddedToGroupChat(): ServerResponse
    {
        // This bot has just entered a chat
        return $this->replyToChat('Hi everyone!');
    }

}
