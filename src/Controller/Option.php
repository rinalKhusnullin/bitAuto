<?php

namespace ES\controller;

class option
{
	static function getConfig(string $name, $defaultValue = null)
	{
		/** @var array $config */
		static $config = null;

		if ($config === null)
		{
			$masterConfig = require_once ROOT . '/core/config/config.php';
			if (file_exists(ROOT . '/config.local.php'))
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

		throw new Exception("Configuration option $name not found");
	}
}