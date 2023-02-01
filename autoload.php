<?php

spl_autoload_register(function ($class) {
	$prefix = 'ES\\';

	$directories = ['/src/', '/core/'];

	$len = strlen($prefix);
	if (strncmp($prefix, $class, $len) !== 0)
	{
		return;
	}

	$relative_class = substr($class, $len);

	foreach ($directories as $directory)
	{
		$base_dir = __DIR__ . $directory;
		$file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

		if (file_exists($file))
		{
			require $file;
			break;
		}
	}
});
