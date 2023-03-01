<?php

use ES\Services\TemplateEngine;
use PHPUnit\Framework\TestCase;

class TemplateEngineTest extends TestCase
{
	public function testInvalidPath(): void
	{
		$this->expectExceptionMessage('Invalid template path');
		TemplateEngine::view('this is in!@#$%*()_correct path');
	}

	public function testFileNotFound(): void
	{
		$this->expectExceptionMessage('Template not found');
		TemplateEngine::view('thisIsNotExistentFileName');
	}

	public function testCorrectWork(): void
	{
		$expected = '<div><div>var1<section>var2var3var4</section></div><section>var2var3var4</section></div>';
		$result = TemplateEngine::view('test-layout', [
			'var1' => TemplateEngine::view('test-layout', [
				'var1' => 'var1',
				'values' => ['var2', 'var3', 'var4'],
			]),
			'values' => ['var2', 'var3', 'var4'],
		]);
		$this->assertEquals($expected, str_replace(["\t","\n"],'',$result));
	}
}
