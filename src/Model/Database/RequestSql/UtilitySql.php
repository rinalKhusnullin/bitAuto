<?php 

namespace ES\Model\Database\RequestSql;

use ES\config\ConfigurationController;
use ES\Model\Database\ObjectBuilder;

trait UtilitySql
{
    function getUsers()
	{
		$query = "SELECT ID, PASS, LOGIN, MAIL, ROLE, FIRST_NAME, LAST_NAME 
					FROM users";

		$result = mysqli_query($this->connection, $query);

		return ObjectBuilder::buildUsers($result);
	}

    function getPageCount(string $isActive = 'active')
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
		}

		$countProductOnPage = ConfigurationController::getConfig('CountProductsOnPage');
		$query = "SELECT COUNT(*)
				FROM products p
                $activityQuery";

		$result = mysqli_query($this->connection, $query);
        $row = mysqli_fetch_row($result);
		return ceil($row[0] / $countProductOnPage);
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
		}

        $countProductOnPage = ConfigurationController::getConfig('CountProductsOnPage');
        $query = "SELECT COUNT(*)
					FROM products p
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

		if (empty($tags))
		{
			return $this->getPageCount();
		}

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
		}

        $sQuery = mysqli_real_escape_string($this->connection, $sQuery);
        $countProductOnPage = ConfigurationController::getConfig('CountProductsOnPage');
		$query = "SELECT COUNT(*)
					from products p
                    where (name LIKE '%$sQuery%' or FULL_DESCRIPTION LIKE '%$sQuery%')
                    $isActiveQuery";
        $result = mysqli_query($this->connection, $query);
        $row = mysqli_fetch_row($result);
		return ceil($row[0] / $countProductOnPage);
    }

	function deliteItem(int $id, string $name): void
	{
		$query = "DELETE FROM '%$name%' WHERE `ID` = $id LIMIT 1";

		mysqli_query($this->connection, $query);
	}
}