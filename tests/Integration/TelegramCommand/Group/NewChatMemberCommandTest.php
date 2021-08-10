<?php

namespace Tests\Integration\TelegramCommand\Group;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Telegram;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class NewChatMemberCommandTest extends TestCase
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

    public function testNewMemberAdded(): void
    {
        $updatePostContent = file_get_contents(
            __DIR__ . '/../data/newChatMemberCommand.json'
        );

        $expectedParams = [
            'chat_id' => '-535758690',
            'text' => 'Welcome Mariam Amadou!'
        ];
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
                    function ($param) use ($expectedParams) {
                        self::assertEquals($expectedParams, $param['form_params']);
                    return true;
                })
            )->willReturn($mockResponse);

        $this->tgClient->setCustomInput($updatePostContent);
        Request::setClient($this->clientMock);
        $this->tgClient->handle();
    }

    public function testThisBotJustAddedInGroup(): void
    {
        $updatePostContent = file_get_contents(
            __DIR__ . '/../data/newChatMemberCommand_thisBotAdded.json'
        );

        $expectedParams = [
            'chat_id' => '-535758690',
            'text' => 'Hi everyone!'
        ];
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
                    function ($param) use ($expectedParams) {
                        self::assertEquals($param['form_params'], $expectedParams);
                    return true;
                })
            )->willReturn($mockResponse);

        $this->tgClient->setCustomInput($updatePostContent);
        Request::setClient($this->clientMock);
        $this->tgClient->handle();
    }
}
