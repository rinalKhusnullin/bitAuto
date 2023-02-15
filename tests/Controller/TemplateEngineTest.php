<?php

use ES\Controller\TemplateEngine;
use PHPUnit\Framework\TestCase;

class TemplateEngineTest extends TestCase
{
	public function testInvalidPath(): void
	{
		$this->expectExceptionMessage('Invalid template path');
		TemplateEngine::view('this is in!@#$%*()_correct path');
	}

	public function testFileNotFound() : void
	{
		$this->expectExceptionMessage('Template not found');
		TemplateEngine::view('thisIsNotExistentFileName');
	}

	public function testCorrectWork() : void
	{
		$expected = require_once ROOT . '/src/View/layout.php';
		$result = TemplateEngine::view('layout', []);
		$this->assertStringContainsString($expected,$result);
	}
}
