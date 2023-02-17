<?php

use PHPUnit\Framework\TestCase;

class IndexControllerTest extends TestCase
{
	public function testWorkMainPage(): void
	{
		$client = new GuzzleHttp\Client();
		$result = $client->request('GET', $_ENV['uri'] . '/');
		$this->assertEquals(200,$result->getStatusCode()) ;
		$content = $result->getBody();
		$this->assertStringContainsString('class="product-card__container"',$content);
		$this->assertStringContainsString('class="footer',$content);
	}
}
