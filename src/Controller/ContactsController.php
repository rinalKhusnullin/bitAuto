<?php

namespace ES\Controller;

use ES\config\ConfigurationController;
use ES\Model\Database\MySql;

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
			'title' => ConfigurationController::getConfig('TITLE', 'AutoBit'),
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
