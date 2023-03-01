<?php

namespace ES\Services;

use ES\Exceptions\PathException;

class TemplateEngine
{
	/**
	 * @throws PathException
	 */
	public static function view(string $path, array $variables = []): string
	{
		if (!preg_match('/^[0-9A-Za-z\/_-]+$/', $path))
		{
			throw new PathException("Invalid template path");
		}

		$absolutePath = ROOT . "/src/View/$path.php";

		if (!file_exists($absolutePath))
		{
			throw new PathException('Template not found');
		}
		ob_start();

		extract($variables, EXTR_OVERWRITE);

		require $absolutePath;

		return ob_get_clean();
	}
}