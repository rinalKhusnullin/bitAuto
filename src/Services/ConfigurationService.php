<?php

namespace ES\Services;

use ES\Exceptions\ConfigurationException;

class ConfigurationService
{
	/**
	 * @throws ConfigurationException
	 */
	static function getConfig(string $name, $defaultValue = null)
	{
		/** @var array $config */
		static $config = null;

		if ($config === null)
		{
			$masterConfig = require_once ROOT . '/core/config/config.php';
			if (file_exists(ROOT . '/core/config/config.local.php'))
			{
				$localConfig = require_once ROOT . '/core/config/config.local.php';
			}
			else
			{
				$localConfig = [];
			}

			$config = array_merge($masterConfig, $localConfig);
		}

		if (array_key_exists($name, $config))
		{
			return $config[$name];
		}

		if ($defaultValue !== null)
		{
			return $defaultValue;
		}

		throw new ConfigurationException("Configuration option $name not found");
	}
}