<?php

use ES\Controller\TemplateEngine;
use PHPUnit\Framework\TestCase;

class TemplateEngineTest extends TestCase
{

	/** @test */
	public function TestInvalidPath(): void
	{
		$this->expectExceptionMessage('Invalid template path');
		TemplateEngine::view('this is in!@#$%*()_correct path');
	}

	/** @test */
	public function TestFileNotFound() : void
	{
		$this->expectExceptionMessage('Template not found');
		TemplateEngine::view('thisIsNotExistentFileName');
	}

	/** @test */
	public function TestViewFunc() : void
	{
		$this->assertEquals('12451' , \ES\Controller\TemplateEngine::view('layout', []));
	}
}
