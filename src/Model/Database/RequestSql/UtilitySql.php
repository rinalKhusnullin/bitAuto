<?php 

namespace ES\Model\Database\RequestSql;

use ES\config\ConfigurationController;
use ES\Model\Database\ObjectBuilder;
use ES\Model\User;

trait UtilitySql
{
	function getUsers(): array
	{
		$query = "SELECT ID, PASS, LOGIN, MAIL, ROLE, FIRST_NAME, LAST_NAME 
					FROM user";

		$result = mysqli_query($this->connection, $query);

		return ObjectBuilder::buildUsers($result);
	}

	function getUserById($id): ?User
	{
		$id = mysqli_real_escape_string($this->connection, $id);
		$query = "SELECT ID, PASS, LOGIN, MAIL, ROLE, FIRST_NAME, LAST_NAME 
					FROM user WHERE ID = $id";

		$result = mysqli_query($this->connection, $query);

		return ObjectBuilder::buildUsers($result)[0];
	}

	function updateUser(User $user)
	{
		foreach ($user as $key => $value)
		{
			$user->$key = mysqli_real_escape_string($this->connection, $value);
		}
		$password = password_hash($user->password,PASSWORD_DEFAULT);
		$query = "UPDATE user
		SET PASS = '$password',
		    LOGIN = '$user->login',
		    MAIL = '$user->mail',
		    ROLE = '$user->role',
		    FIRST_NAME = '$user->firstName',
		    LAST_NAME = '$user->lastName'
		    where ID = '$user->id'";

		return mysqli_query($this->connection, $query);
	}

	function createUser(User $user)
	{
		foreach ($user as $key => $value)
		{
			$user->$key = mysqli_real_escape_string($this->connection, $value);
		}

		$password = password_hash($user->password,PASSWORD_DEFAULT);

		$query = "INSERT INTO user (PASS,LOGIN,MAIL,ROLE,FIRST_NAME,LAST_NAME)
					values ('$password','$user->login','$user->mail','$user->role','$user->firstName','$user->lastName' )";

		return mysqli_query($this->connection, $query);
	}

    function getPageCount(string $isActive = 'active', string $table = 'product')
	{
		$activityQuery = '';
		if ($table ==='product')
		{
			switch ($isActive)
			{
				case 'all':
					$activityQuery = "";
					break;
				case 'notActive':
					$activityQuery = " WHERE (p.IS_ACTIVE IS NULL) ";
					break;
				case 'active':
				default:
					$activityQuery = " WHERE (p.IS_ACTIVE IS NOT NULL) ";
					break;
			};
			$table .= ' p';
		}
		$countProductOnPage = ConfigurationController::getConfig('CountProductsOnPage');
		$query = "SELECT COUNT(*)
				FROM $table
                $activityQuery";

		$result = mysqli_query($this->connection, $query);
        $row = mysqli_fetch_row($result);
		$result = ceil($row[0] / $countProductOnPage);
		return ($result == 1) ? 0: $result;
	}

    function getPageCountByTags($brand, $carcase, $transmission, string $isActive = 'active')
    {
        switch ($isActive)
		{
			case 'all':
				$isActiveQuery = "";
				break;
			case 'notActive':
				$isActiveQuery = " (p.IS_ACTIVE IS NULL) AND";
				break;
			case 'active':
			default:
				$isActiveQuery = " (p.IS_ACTIVE IS NOT NULL) AND";
				break;
		};

        $countProductOnPage = ConfigurationController::getConfig('CountProductsOnPage');
        $query = "SELECT COUNT(*)
					FROM product p
	 				inner join brand b on p.ID_BRAND = b.id
					inner join carcase c on p.ID_CARCASE = c.id
					inner join transmission t on p.ID_TRANSMISSION = t.id
					where $isActiveQuery";
                    
        $tags = [];
		if (isset($brand))
        {
            $brand = mysqli_real_escape_string($this->connection, $brand);
            $tags[] = "(b.brand = '$brand')";
        }
		if (isset($carcase))
        {
            $carcase = mysqli_real_escape_string($this->connection, $carcase);
            $tags[] = "(c.carcase = '$carcase')";
        }
		if (isset($transmission))
        {
            $transmission = mysqli_real_escape_string($this->connection, $transmission);
            $tags[] = "(t.transmission = '$transmission')";
        }

		if (empty($tags)) return $this->getPageCount();
        $query .= implode(' and ', $tags);
        $result = mysqli_query($this->connection, $query);
        $row = mysqli_fetch_row($result);
		return ceil($row[0] / $countProductOnPage);
    }

    function getPageCountByQuery(string $sQuery, string $isActive = 'active')
    {
        switch ($isActive)
		{
			case 'all':
				$isActiveQuery = "";
				break;
			case 'notActive':
				$isActiveQuery = " AND (p.IS_ACTIVE IS NULL)";
				break;
			case 'active':
			default:
				$isActiveQuery = " AND (p.IS_ACTIVE IS NOT NULL)";
				break;
		};
        $sQuery = mysqli_real_escape_string($this->connection, $sQuery);
        $countProductOnPage = ConfigurationController::getConfig('CountProductsOnPage');
		$query = "SELECT COUNT(*)
					from product p
                    where (name LIKE '%$sQuery%' or FULL_DESCRIPTION LIKE '%$sQuery%')
                    $isActiveQuery";
        $result = mysqli_query($this->connection, $query);
        $row = mysqli_fetch_row($result);
		return ceil($row[0] / $countProductOnPage);
    }

	function deleteItem(string $name, int $id)
	{
		// session_start();
		// if (isset($_SESSION['USER']))
		// {
		//
		// }
		// else
		// {
		// 	header('Location: /login/');
		// }

		$tableName = mysqli_real_escape_string($this->connection, $name);
		$idItem = mysqli_real_escape_string($this->connection, $id);
		$query = "DELETE FROM $tableName WHERE id = $idItem";

		mysqli_query($this->connection, $query);
		header("Location: /admin/?{$name}s&delete={$id}");
	}
}