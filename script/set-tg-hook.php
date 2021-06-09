<?php

use P2pCareReminder\Service\TelegramBotService;

require __DIR__ . '/../src/bootstrap.php';

/** @var TelegramBotService $telegramBotService */
$telegramBotService = get(TelegramBotService::class);

$telegramBotService->connectWebhook();
