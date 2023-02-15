<?php

use ES\config\ConfigurationController;
use ES\Controller\TemplateEngine;
use PHPUnit\Framework\TestCase;

class ErrorControllerTest extends TestCase
{
	public function testCorrectRenderAndAddingLog(): void
	{
		$expectedPage = TemplateEngine::view('layout', [
			'title' => ConfigurationController::getConfig('TITLE'),
			'content' => TemplateEngine::view('pages/404', []),
		]);
		$expectedCount = count(explode("\r\n", file_get_contents(ROOT . '/var/logs/errorLog.txt')));

		$errorController = new \ES\Controller\ErrorController();
		$errorController->getSystemErrorAction(new Exception("test exception"));

		$result = count(explode("\r\n", file_get_contents(ROOT . '/var/logs/errorLog.txt')))-1;

		$this->expectOutputString($expectedPage);
		$this->assertEquals($expectedCount, $result);
	}

}
