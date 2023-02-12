<?php

namespace ES;

use ES\Controller\ConfigurationController;

class Migration
{
	public static function migrate($connection): void
	{
		function getMigrationFiles($connection) {

			$base_dir = ROOT . '/src/Migration/';
			$sqlFolder = str_replace('\\', '/', realpath($base_dir) . '/');
			$allFiles = glob($sqlFolder . '*.sql');

			$query = sprintf
			(
				'show tables from `%s` like "%s"',
				ConfigurationController::getConfig('DB_NAME'),
				ConfigurationController::getConfig('DB_TABLE_MIGRATION')
			);
			$data = $connection->query($query);
			$firstMigration = !$data->num_rows;

			if ($firstMigration) {
				return $allFiles;
			}

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

			return array_diff($allFiles, $migrationFiles);
		}

		function migrate($connection, $file) {

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

		$files = getMigrationFiles($connection);

		if (!empty($files))
		{
			foreach ($files as $file) {
				migrate($connection, $file);
			}
		}
	}
}