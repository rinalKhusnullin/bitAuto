<?php

namespace ES;

use ES\config\ConfigurationController;

class Migrator
{
	public static function migrate($connection): void
	{
		$base_dir = ROOT . '/core/Migration/';
		$sqlFolder = str_replace('\\', '/', realpath($base_dir) . '/');
		$allFiles = glob($sqlFolder . '*.sql');
		$files = [];

		$query = sprintf
		(
			'show tables from `%s` like "%s"',
			ConfigurationController::getConfig('DB_NAME'),
			ConfigurationController::getConfig('DB_TABLE_MIGRATION')
		);
		$data = $connection->query($query);
		$firstMigration = !$data->num_rows;

		if ($firstMigration) {
			$files = $allFiles;
		}
		else
		{
			$migrationFiles = array();

			$query = sprintf
			(
				'select `name` from `%s`',
				ConfigurationController::getConfig('DB_TABLE_MIGRATION')
			);
			$data = $connection->query($query)->fetch_all(MYSQLI_ASSOC);

			foreach ($data as $row) {
				array_push($migrationFiles, $sqlFolder . $row['name']);
			}

			$files = array_diff($allFiles, $migrationFiles);
		}

		if (!empty($files))
		{
			foreach ($files as $file) {
				$fileContent = file_get_contents($file);
				mysqli_query($connection, $fileContent);

				$baseName = basename($file);

				$query = sprintf
				(
					'insert into `%s` (`name`) values("%s")',
					ConfigurationController::getConfig('DB_TABLE_MIGRATION'),
					$baseName
				);
				$connection->query($query);
			}
		}
	}
}