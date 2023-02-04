<?php

namespace ES;

use ES\Routing\Router;
use ES\Controller\TemplateEngine;
use \ES\controller\Option;

class Application
{
	public function run()
	{
		try
		{
			$route = Router::find($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
			if ($route)
			{
				$action = $route->action;
				$variables = $route->getVariables();

				// Проверка на число
				if (empty($variables))
				{
					echo TemplateEngine::view('layout', [
						'title' => Option::getConfig('TITLE'),
						'content' => 'Ошибка: неверный тип данных для ID',
					]);
					exit;
				}

				echo $action(...$variables);
			}
			else
			{
				http_response_code(404);
				echo TemplateEngine::view('layout', [
					'title' => Option::getConfig('TITLE'),
					'content' => 'page not found',
				]);
				exit;
			}
		}
		catch (Exception $e)
		{
			echo TemplateEngine::view('layout', [
				'title' => Option::getConfig('TITLE'),
				'content' => 'Сервис временно не доступен',
			]);
		}
	}
}