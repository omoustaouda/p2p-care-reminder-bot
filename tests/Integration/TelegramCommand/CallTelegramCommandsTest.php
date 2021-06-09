<?php

namespace Tests\Integration\TelegramCommand;

use GuzzleHttp\ClientInterface;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Telegram;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CallTelegramCommandsTest extends TestCase
{
    private Telegram $tgClient;
    private ClientInterface|MockObject $clientMock;

    protected function setUp(): void
    {
        $this->tgClient = get(Telegram::class);
        $this->clientMock = $this->getMockForAbstractClass(
            originalClassName: ClientInterface::class,
            mockedMethods: ['post']
        );
    }

    public function testStartCommand(): void
    {
        $this->markTestSkipped('TO BE IMPLEMENTED');
        $updatePostContent = file_get_contents(
            __DIR__ . '/data/startCommand.json'
        );

        $this->clientMock
            ->expects(self::once())
            ->method('post')
            ->with(
                '/bot' . config('telegram')['botApiKey'] . '/' . 'sendMessage',
                [
                    'chat_id' => 56653407,
                    'text' => "Hi there!\nType /help to see all commands!"
                ],
            );

        $this->tgClient->setCustomInput($updatePostContent);
        Request::setClient($this->clientMock);
        $this->tgClient->handle();
    }
}
