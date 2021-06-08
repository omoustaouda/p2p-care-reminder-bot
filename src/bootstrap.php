<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use P2pCareReminder\Service\AppConfigService;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

require_once __DIR__ . '/../vendor/autoload.php';


$dotEnv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$requiredEnvVars = [];
$dotEnv->required($requiredEnvVars);
$dotEnv->load();

const APP_NAME = 'p2p-care-reminder-bot';
define(
    'APP_ROOT',
    dirname(__DIR__, 1) . '/'
);
$appConfigService = new AppConfigService(APP_ROOT . 'config');

function getContainer(): ContainerInterface
{
    static $container;

    if ($container) {
        return $container;
    }

    // In this basic config, wiring cache (for speed increase) is not enabled.
    // See here for how to enable it: http://php-di.org/doc/performances.html
    $containerBuilder = new ContainerBuilder();
    $containerBuilder->addDefinitions(__DIR__ . '/container.php');
    $container = $containerBuilder->build();
    return $container;
}

function get(string $id)
{
    return getContainer()->get($id);
}

function getLogger(): LoggerInterface
{
    return get(LoggerInterface::class);
}

function config(string $configName = null): ?array
{
    /** @var AppConfigService $configService */
    $configService = get(AppConfigService::class);
    return $configService->getConfig($configName);
}

function env($key, $default = null): mixed
{
    $value = getenv($key);

    if ($value === false) {
        return $default;
    }

    switch (mb_strtolower($value)) {
        case 'false':
        case '(false)':
            $value = false;
            break;
        case 'true':
        case '(true)':
            $value = true;
            break;
        case 'null':
        case '(null)':
            $value = null;
            break;
    }

    return $value;
}
