<?php

namespace ES\Controller\Public;

use ES\Controller\BaseController;
use ES\Model\Database\MySql;
use ES\Services\ConfigurationService;
use ES\Services\TemplateEngine;

class ContactsController extends BaseController
{
	public function getContactsAction(): void
	{
		$db = MySql::getInstance();
		$brands = $db->getTagByName('brand');
		$carcases = $db->getTagByName('carcase');
		$transmissions = $db->getTagByName('transmission');
		session_start();
		$role = array_key_exists('USER' , $_SESSION)? $_SESSION['USER']->role : 'user';
		$this->render('layout', [
			'title' => ConfigurationService::getConfig('TITLE', 'AutoBit'),
			'role' => $role,
			'tags' => TemplateEngine::view('components/tags', [
				'brands' => $brands,
				'carcases' => $carcases,
				'transmissions' => $transmissions,
			]),
			'content' => TemplateEngine::view('pages/contacts', []),
		]);
	}
}
