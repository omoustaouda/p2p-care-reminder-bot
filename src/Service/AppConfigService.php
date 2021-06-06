<?php

namespace P2pCareReminder\Service;

use InvalidArgumentException;
use Nette\Utils\Finder;
use SplFileInfo;

class AppConfigService
{
    private array $config;

    public function __construct(
        protected string $configDir,
    )
    {
        $this->loadConfig();
    }

    public function loadConfig(): void
    {
        foreach (Finder::findFiles('*.php')->in($this->configDir) as $filePath => $file) {
            /** @var $filePath string */
            /** @var $file SplFileInfo */

            $configName = basename($filePath, '.php');
            $loadedConfig = include $filePath;

            if ($loadedConfig === 1) {
                // when a file is empty, `include` returns 1
                $loadedConfig = null;
            }

            $this->config[$configName] = $loadedConfig;
        }
    }

    public function getConfig(string $confName = null): ?array
    {
        if ($confName !== null) {

            if (!array_key_exists($confName, $this->config)) {
                throw new InvalidArgumentException('config not found');
            }

            return $this->config[$confName];
        }

        // Return the full config when no config name is set
        return $this->config;
    }
}
