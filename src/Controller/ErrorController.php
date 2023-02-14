<?php

namespace ES\Controller;

use ES\config\ConfigurationController;

class ErrorController extends BaseController
{
	public function getSystemErrorAction(\Exception $e = null) : void
	{

		if($e !== null)
		{
			$log = date('Y-m-d H:i:s') .' '. $e->getCode() . $e->getMessage() . ' in file ' . $e->getFile() . ' on line ' . $e->getLine() .PHP_EOL;
			$path = ROOT . '/var/logs/errorLog.txt';
			file_put_contents($path, $log, FILE_APPEND);
		}
		session_start();
		$role = array_key_exists('USER' , $_SESSION)? $_SESSION['USER']['role'] : 'user';
		echo TemplateEngine::view('layout', [
			'title' => ConfigurationController::getConfig('TITLE'),
			'role' => $role,
			'content' => TemplateEngine::view('pages/404', []),
		]);
	}
}
