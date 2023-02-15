<?php 

namespace ES\Model\Database;

use ES\Model\Database\SqlConnection;
use ES\Model\Database\AdminSql;
use ES\Model\Database\PublicSql;



class MySql
{
    use PublicSql;
    use AdminSql;

    private static $connection;
	private static ?MySql $_instance = null;

	private function __construct()
	{
		$this->connection = SqlConnection::getInstance()->getConnection();

	}

	public static function getInstance()
	{
		if (self::$_instance === null)
		{
			self::$_instance = new MySql();
		}

		return self::$_instance;
	}
}