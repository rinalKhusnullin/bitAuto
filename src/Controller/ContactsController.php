<?php

namespace ES\Controller;

use ES\config\ConfigurationController;
use ES\Model\Database\MySql;

class ContactsController extends BaseController
{
	public function getContactsAction(): void
	{
		$tags = MySql::getInstance()->getTagList();
		session_start();
		$role = array_key_exists('USER' , $_SESSION)? $_SESSION['USER']->role : 'user';
		$this->render('layout', [
			'title' => ConfigurationController::getConfig('TITLE', 'AutoBit'),
			'role' => $role,
			'tags' => $tags,
			'content' => TemplateEngine::view('pages/contacts', []),
		]);
	}
}
