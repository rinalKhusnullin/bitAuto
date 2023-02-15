<?php

use ES\config\ConfigurationController;
use ES\Controller\TemplateEngine;
use ES\Model\Database\MySql;
use PHPUnit\Framework\TestCase;

class ContactsControllerTest extends TestCase
{
	public function testRenderContactsPage(): void
	{
		$contactsController = new \ES\Controller\ContactsController();
		$contactsController->getContactsAction();
		$result = ob_get_clean();

		$expected = TemplateEngine::view('layout', [
			'title' => ConfigurationController::getConfig('TITLE'),
			'tags' => MySql::getInstance()->getTegs(),
			'role' => array_key_exists('USER', $_SESSION) ? $_SESSION['USER']['role'] : 'user',
			'content' => TemplateEngine::view('pages/contacts', []),
		]);

		$this->assertStringContainsString($expected, $result);
	}
}
