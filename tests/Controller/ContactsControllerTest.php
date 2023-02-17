<?php

use PHPUnit\Framework\TestCase;

class ContactsControllerTest extends TestCase
{
	public function testWorkContactsPage(): void
	{
		$client = new GuzzleHttp\Client();
		$result = $client->request('GET', $_ENV['uri'] . '/contacts/');
		$this->assertEquals(200, $result->getStatusCode());
		$this->assertStringContainsString('class="contacts__container"', $result->getBody());
	}
}
