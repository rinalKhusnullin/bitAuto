<?php

use ES\Routing\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
	public function testWorkWithParameter(): void
	{
		$pregUri = '/test/:id/';
		Router::add('GET', $pregUri, fn ($id) => "test page $id");
		$parameter = mt_rand();
		$actual = Router::find('GET', "/test/$parameter/");
		$this->assertContainsEquals($parameter, $actual->getVariables());
	}

	/**
	 * @dataProvider routesProvider
	 */
	public function testWorkRouter($method, $uri, $action): void
	{
		Router::add($method, $uri, $action);
		$actual = Router::find($method, $uri);
		$this->assertEquals($method, $actual->method);
		$this->assertEquals($uri, $actual->uri);
		$this->assertEquals($action, $actual->action);
	}

	public static function routesProvider(): array
	{
		return [
			['GET', 'testUri1', fn () => 'test page 1'],
			['POST', 'testUri2', fn () => 'test page 2'],
			['POST', 'testUri3', fn () => 'test page 3'],
		];
	}

}