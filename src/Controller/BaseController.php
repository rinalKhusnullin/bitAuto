<?php

namespace ES\Controller;

abstract class BaseController
{
	public function render(string $templateName, array $data)
	{
		if (!preg_match('/^[0-9A-Za-z\/_-]+$/', $templateName))
		{
			throw new \RuntimeException("Invalid template path");
		}

		$absolutePath = ROOT . "/src/View/" . $templateName . ".php";

		if (!file_exists($absolutePath))
		{
			throw new \RuntimeException("Template {$templateName} not found");
		}
		ob_start();

		extract($data, EXTR_OVERWRITE);

		require $absolutePath;
	}
}
