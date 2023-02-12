<?php

namespace ES\Controller;

use ES\config\ConfigurationController;

class ContactsController extends BaseController
{
	public function getContactsAction(): void
	{
		$this->render('layout', [
			'title' => ConfigurationController::getConfig('TITLE', 'AutoBit'),
			'content' => TemplateEngine::view('pages/contacts', []),
		]);
	}
}
