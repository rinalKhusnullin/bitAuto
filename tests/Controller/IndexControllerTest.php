<?php

use ES\config\ConfigurationController;
use ES\Controller\TemplateEngine;
use ES\Model\Database\MySql;
use PHPUnit\Framework\TestCase;

class IndexControllerTest extends TestCase
{
	public function testRenderMainPage(): void
	{
		$db = MySql::getInstance();
		$indexController = new \ES\Controller\IndexController();
		$indexController->indexAction();
		session_abort();
		$actual = ob_get_clean();

		$expected = TemplateEngine::view('layout', [
			'title' => ConfigurationController::getConfig('TITLE'),
			'tags' => MySql::getInstance()->getTagList(),
			'role' => array_key_exists('USER', $_SESSION) ? $_SESSION['USER']['role'] : 'user',
			'content' => TemplateEngine::view('pages/index', [
				'products' => $db->getProducts(1),
				'pagination' => TemplateEngine::view('components/pagination', [
					'currentPage' => 1,
					'countPage' => $db->getPageCount(),
				]),
			]),
		]);

		$this->assertStringContainsString($expected,$actual);
	}

}
