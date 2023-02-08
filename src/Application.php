<?php

namespace ES;

use ES\Exceptions\ConfigurationException;
use ES\Exceptions\MySqlException;
use ES\Exceptions\PathException;
use ES\Routing\Router;
use ES\Controller\TemplateEngine;
use \ES\controller\ConfigurationController;

class Application
{
	public function run() :void
	{
		try
		{
			$route = Router::find($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
			if ($route)
			{
				$action = $route->action;
				$variables = $route->getVariables();

				// Проверку на число до сих пор не реализовал, но оставлю это здесь
				// if (empty($variables))
				// {
				// 	echo TemplateEngine::view('layout', [
				// 		'title' => ConfigurationController::getConfig('TITLE'),
				// 		'content' => 'Ошибка: неверный тип данных для ID',
				// 	]);
				// 	exit;
				// }

				echo $action(...$variables);
			}
			else
			{
				http_response_code(404);
				$action = Router::find('GET','/error')->action;
				$action();
				exit;
			}
		}
		catch (\Exception|MySqlException|\mysqli_sql_exception|ConfigurationException|PathException $e)
		{
			http_response_code(404);
			$action = Router::find('GET','/error')->action;
			$action($e);
		}
	}
}