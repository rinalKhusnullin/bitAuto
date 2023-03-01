<?php

namespace ES\Controller\Public;

use ES\Controller\BaseController;
use ES\Services\ConfigurationService;
use ES\Services\TemplateEngine;

class FormController extends BaseController
{
	public function successAction(): void
	{
		$role = array_key_exists('USER', $_SESSION) ? $_SESSION['USER']->role : 'user';
		$this->render('layout', [
			'title' => ConfigurationService::getConfig('TITLE', 'AutoBit'),
			'role' => $role,
			'content' => TemplateEngine::view('pages/success', []),
		]);
	}

	public function failedAction():void
	{
		$role = array_key_exists('USER', $_SESSION) ? $_SESSION['USER']->role : 'user';
		$this->render('layout', [
			'title' => ConfigurationService::getConfig('TITLE', 'AutoBit'),
			'role' => $role,
			'content' => TemplateEngine::view('pages/failed', []),
		]);
	}
}
