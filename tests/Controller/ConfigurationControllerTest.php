<?php

use ES\Exceptions\ConfigurationException;
use ES\Services\ConfigurationService;
use PHPUnit\Framework\TestCase;

class ConfigurationControllerTest extends TestCase
{
	/**
	 * @dataProvider configParameterProvider
	 * @return void
	 * @throws ConfigurationException
	 */
	public function testParameterFound($expected,$parameter) : void
	{
		$this->assertEquals($expected, ConfigurationService::getConfig($parameter));
	}

	public function testParameterNotFound() : void
	{
		$this->expectExceptionMessage("Configuration option NO_EXISTS_PARAMETER not found");
		ConfigurationService::getConfig('NO_EXISTS_PARAMETER');
	}

	public static function configParameterProvider(): array
	{
		return[
			['BitAuto','TITLE'],
			[10,'CountProductsOnPage'],
		];
	}
}