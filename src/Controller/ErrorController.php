<?php

namespace ES\Controller;

use ES\config\ConfigurationController;
use ES\Model\Database\MySql;

class ErrorController extends BaseController
{
	public function getSystemErrorAction(\Exception $e = null) : void
	{
		$db = MySql::getInstance();
		$brands = $db->getTagByName('brand');
		$carcases = $db->getTagByName('carcase');
		$transmissions = $db->getTagByName('transmission');
		if($e !== null)
		{
			$log = date('Y-m-d H:i:s') .' '. $e->getCode() . $e->getMessage() . ' in file ' . $e->getFile() . ' on line ' . $e->getLine() .PHP_EOL;
			$path = ROOT . '/var/logs/errorLog.txt';
			file_put_contents($path, $log, FILE_APPEND);
		}
		session_start();
		$role = array_key_exists('USER' , $_SESSION)? $_SESSION['USER']->role : 'user';
		echo TemplateEngine::view('layout', [
			'title' => ConfigurationController::getConfig('TITLE'),
			'role' => $role,
			'tags' => TemplateEngine::view('components/tags', [
				'brands' => $brands,
				'carcases' => $carcases,
				'transmissions' => $transmissions,
			]),
			'content' => TemplateEngine::view('pages/404', []),
		]);
	}
}
