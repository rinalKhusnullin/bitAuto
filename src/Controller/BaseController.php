<?php

namespace ES\Controller;

use ES\Exceptions\PathException;

abstract class BaseController
{
	/**
	 * @throws PathException
	 */
	public function render(string $templateName, array $data)
	{
		if (!preg_match('/^[0-9A-Za-z\/_-]+$/', $templateName))
		{
			throw new PathException("Invalid template path $templateName");
		}

		$absolutePath = ROOT . "/src/View/" . $templateName . ".php";

		if (!file_exists($absolutePath))
		{
			throw new PathException("Template {$templateName} not found");
		}
		ob_start();

		extract($data, EXTR_OVERWRITE);

		require $absolutePath;
	}
}
