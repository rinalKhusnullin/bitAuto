<?php

use PHPUnit\Framework\TestCase;

class ErrorControllerTest extends TestCase
{
	public function testCorrectRenderAndAddingLog(): void
	{
		$client = new GuzzleHttp\Client();
		$result = $client->request('GET', 'http://www.matavest.beget.tech/error/');
		$this->assertEquals(200,$result->getStatusCode()) ;
		$this->assertStringContainsString('class="error_img"',$result->getBody());
	}
}
