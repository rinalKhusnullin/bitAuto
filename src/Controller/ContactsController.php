<?php

namespace ES\Controller;

use ES\config\ConfigurationController;

class ContactsController extends BaseController
{
	public function getContactsAction(): void
	{
		session_start();
		$role = array_key_exists('USER' , $_SESSION)? $_SESSION['USER']['role'] : 'user';
		$this->render('layout', [
			'title' => ConfigurationController::getConfig('TITLE', 'AutoBit'),
			'role' => $role,
			'content' => TemplateEngine::view('pages/contacts', []),
		]);
	}
}
