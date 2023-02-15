<?php 

namespace ES\Model\Database;

use ES\config\ConfigurationController;

trait AdminSql
{
    function getProductsForAdmin($page = 0)
    {
        $countProductsOnPage = ConfigurationController::getConfig('CountProductsOnPage');
		$page = ($page > 1) ? $page * $countProductsOnPage - $countProductsOnPage : 0;
		$query = "SELECT p.id, p.name, p.IS_ACTIVE, b.brand, t.transmission, c.carcase, p.DATE_CREATION, p.DATE_UPDATE, p.FULL_DESCRIPTION, p.PRODUCT_PRICE
					FROM products p
					inner join brand b on p.ID_BRAND = b.id
					inner join carcase c on p.ID_CARCASE = c.id
					inner join transmission t on p.ID_TRANSMISSION = t.id
			        group by p.ID";

        $result = mysqli_query($this->connection, $query);
		return ObjectBuilder::buildProducts($result);
    }

	function getOrders()
	{
		$query = "SELECT ID, PRODUCT_ID, PRODUCT_PRICE, STATUS, DATE_CREATION, CUSTOMER_NAME, CUSTOMER_PHONE, CUSTOMER_MAIL, CUSTOMER_ADDRESS, COMMENT
					FROM orders
					ORDER BY DATE_CREATION";
		$result = mysqli_query($this->connection, $query);
		return ObjectBuilder::buildOrders($result);
	}

	function getUsers()
	{

	}

	function getBrands() : array
	{
		$query = "SELECT ID, BRAND FROM brand";

        $result = mysqli_query($this->connection, $query);
		$brands = [];
		while ($row = mysqli_fetch_assoc($result))
        {
            $brands[] = [ 'id' => $row['ID'], 'brand' => $row['BRAND']];
        }

		return $brands;
	}

	function getCarcases()
	{
		$query = "SELECT ID, CARCASE FROM carcase";

        $result = mysqli_query($this->connection, $query);
		$carcases = [];
		while ($row = mysqli_fetch_assoc($result))
        {
            $carcases[] = [ 'id' => $row['ID'], 'carcase' => $row['CARCASE']];;
        }

		return $carcases;
	}

	function getTransmissions()
	{
		$query = "SELECT ID, TRANSMISSION FROM transmission";

        $result = mysqli_query($this->connection, $query);
		$transmissions = [];
		while ($row = mysqli_fetch_assoc($result))
        {
            $transmissions[] = [ 'id' => $row['ID'], 'transmission' => $row['TRANSMISSION']];;
        }

		return $transmissions;
	}
}