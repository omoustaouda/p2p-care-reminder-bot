<?php

namespace Tests\Integration\TelegramCommand\Generic;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Telegram;
use P2pCareReminder\TelegramCommand\Generic\StartCommand;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class HelpCommandTest extends TestCase
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

    public function testExecute(): void
    {
        $updatePostContent = file_get_contents(
            __DIR__ . '/../data/helpCommand.json'
        );

        $expectedContainedText = 'Commands List';
        $mockResponse = new Response(
            body: json_encode(['status' => 'ok'])
        );
        $this->clientMock
            ->expects(self::once())
            ->method('post')
            ->with(
                '/bot' . config('telegram')['botApiKey'] . '/' . 'sendMessage',
                self::callback(
                    // in the second parameter, we are interested only into `form_params`, ignoring the `debug` content
                    function ($param) use ($expectedContainedText) {
                        self::assertStringContainsString($expectedContainedText, $param['form_params']['text']);
                    return true;
                })
            )->willReturn($mockResponse);

        $this->tgClient->setCustomInput($updatePostContent);
        Request::setClient($this->clientMock);
        $this->tgClient->handle();
    }
}
