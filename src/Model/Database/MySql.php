<?php 

namespace ES\Model\Database;

use ES\Model\Database\SqlConnection;
use ES\Model\Database\RequestSql;

class MySql
{
    use RequestSql\ProductSql;
    use RequestSql\OrderSql;
	use RequestSql\TagsSql;
	use RequestSql\UtilitySql;

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