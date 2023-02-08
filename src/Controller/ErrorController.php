<?php

namespace ES\Controller;

class ErrorController extends BaseController
{
	public function getUserErrorAction() : void
	{

	}
	public function getSystemErrorAction(\Exception $e = null) : void
	{
		if($e !== null)
		{
			$log = date('Y-m-d H:i:s') .' '. $e->getCode() . $e->getMessage() . ' in file ' . $e->getFile() . ' on line ' . $e->getLine() .PHP_EOL;
			$path = ROOT . '/var/logs/errorLog.txt';
			file_put_contents($path, $log, FILE_APPEND);
		}

		echo TemplateEngine::view('layout', [
			'title' => ConfigurationController::getConfig('TITLE'),
			'content' => TemplateEngine::view('pages/404', []),
		]);
	}
}
