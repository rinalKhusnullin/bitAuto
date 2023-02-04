<?php

namespace ES\Controller;

class TemplateEngine
{
	public static function view(string $path, array $variables = []): string
	{
		if (!preg_match('/^[0-9A-Za-z\/_-]+$/', $path))
		{
			throw new \RuntimeException("Invalid template path");
		}

		$absolutePath = ROOT . "/src/View/$path.php";

		if (!file_exists($absolutePath))
		{
			throw new \RuntimeException('Template not found');
		}
		ob_start();

		extract($variables, EXTR_OVERWRITE);

		require $absolutePath;

		return ob_get_clean();
	}
}