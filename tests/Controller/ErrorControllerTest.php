<?php

use ES\config\ConfigurationController;
use ES\Controller\TemplateEngine;
use ES\Model\Database\MySql;
use PHPUnit\Framework\TestCase;

class ErrorControllerTest extends TestCase
{
	public function testCorrectRenderAndAddingLog(): void
	{
		$expectedCount = count(explode("\r\n", file_get_contents(ROOT . '/var/logs/errorLog.txt')));

		$errorController = new \ES\Controller\ErrorController();
		$errorController->getSystemErrorAction(new Exception("test exception"));

		$result = count(explode("\r\n", file_get_contents(ROOT . '/var/logs/errorLog.txt'))) - 1;

		$expectedPage = TemplateEngine::view('layout', [
			'title' => ConfigurationController::getConfig('TITLE'),
			'role' => array_key_exists('USER', $_SESSION) ? $_SESSION['USER']->role : 'user',
			'tags' => MySql::getInstance()->getTagList(),
			'content' => TemplateEngine::view('pages/404', []),
		]);

		$this->expectOutputString($expectedPage);
		$this->assertEquals($expectedCount, $result);
	}

}
