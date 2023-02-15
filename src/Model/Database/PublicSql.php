<?php 

namespace ES\Model\Database;
use ES\config\ConfigurationController;
use ES\Model\Product;
use ES\Model\Order;

trait PublicSql
{
    public function getProducts($page = 0) : array
	{
		$countProductsOnPage = ConfigurationController::getConfig('CountProductsOnPage');
		$page = ($page > 1) ? $page * $countProductsOnPage - $countProductsOnPage : 0;
		$query = "SELECT p.id, p.name, p.IS_ACTIVE, b.brand, t.transmission, c.carcase, p.DATE_CREATION, p.DATE_UPDATE, p.FULL_DESCRIPTION, p.PRODUCT_PRICE
					FROM products p
					inner join brand b on p.ID_BRAND = b.id
					inner join carcase c on p.ID_CARCASE = c.id
					inner join transmission t on p.ID_TRANSMISSION = t.id
                    WHERE p.IS_ACTIVE = true
			        group by p.ID
                    limit $countProductsOnPage offset $page";

        $result = mysqli_query($this->connection, $query);
		return ObjectBuilder::buildProducts($result);
    }

    function getProductByID($id) : ?Product
	{
		$id = mysqli_real_escape_string($this->connection, $id);
		$query = "SELECT p.id, p.name, p.IS_ACTIVE, b.brand, t.transmission, c.carcase, p.DATE_CREATION, p.DATE_UPDATE, p.FULL_DESCRIPTION, p.PRODUCT_PRICE
					FROM products p
					inner join brand b on p.ID_BRAND = b.id
					inner join carcase c on p.ID_CARCASE = c.id
					inner join transmission t on p.ID_TRANSMISSION = t.id
					where $id = p.id";
		$result = mysqli_query($this->connection, $query);
		return ObjectBuilder::buildProducts($result)[0];
	}

    function getProductsByQuery(string $sQuery, int $page = 0) : array
	{
		$countProductOnPage = ConfigurationController::getConfig('CountProductsOnPage');
		$page = ($page > 1) ? $page * $countProductOnPage - $countProductOnPage : 0;
		$sQuery = mysqli_real_escape_string($this->connection, $sQuery);

		$query = "SELECT p.id, p.name, p.IS_ACTIVE, b.brand, t.transmission, c.carcase, p.DATE_CREATION, p.DATE_UPDATE, p.FULL_DESCRIPTION, p.PRODUCT_PRICE
			FROM products p
			inner join brand b on p.ID_BRAND = b.id
			inner join carcase c on p.ID_CARCASE = c.id
			inner join transmission t on p.ID_TRANSMISSION = t.id
			where p.name LIKE '%$sQuery%' or p.FULL_DESCRIPTION LIKE '%$sQuery%'
            limit $countProductOnPage offset $page";

		$result = mysqli_query($this->connection, $query);

		return ObjectBuilder::buildProducts($result);

	}

    function getProductsByTeg($brand, $carcase, $transmission, $page = 0 ): array
	{
		$countProductOnPage = ConfigurationController::getConfig('CountProductsOnPage');
		$page = ($page > 1) ? $page * $countProductOnPage - $countProductOnPage : 0;
		$query = "SELECT p.id, p.name, p.IS_ACTIVE, b.brand, t.transmission, c.carcase, p.DATE_CREATION, p.DATE_UPDATE,  p.FULL_DESCRIPTION, p.PRODUCT_PRICE
					FROM products p
	 				inner join brand b on p.ID_BRAND = b.id
					inner join carcase c on p.ID_CARCASE = c.id
					inner join transmission t on p.ID_TRANSMISSION = t.id
					where ";

		$tegs = [];
		if (isset($brand))
        {
            $brand = mysqli_real_escape_string($this->connection, $brand);
            $tegs[] = "b.brand = '$brand'";
        }
		if (isset($carcase))
        {
            $carcase = mysqli_real_escape_string($this->connection, $carcase);
            $tegs[] = "c.carcase = '$carcase'";
        }
		if (isset($transmission))
        {
            $transmission = mysqli_real_escape_string($this->connection, $transmission);
            $tegs[] = "t.transmission = '$transmission'";
        }
        

		if (empty($tegs)) return $this->getProducts();

		$query .= implode(' and ', $tegs) . " limit $countProductOnPage offset $page";

		$result = mysqli_query($this->connection, $query);
		return ObjectBuilder::buildProducts($result);
	}

    function getPageCount()
	{
		$countProductOnPage = ConfigurationController::getConfig('CountProductsOnPage');
		$query = 'SELECT COUNT(*)
				FROM products p
                WHERE p.IS_ACTIVE = true';

		$result = mysqli_query($this->connection, $query);
        $row = mysqli_fetch_row($result);
		return ceil($row[0] / $countProductOnPage);
	}

    function getPageCountByTegs($brand, $carcase, $transmission)
    {
        $countProductOnPage = ConfigurationController::getConfig('CountProductsOnPage');
        $query = "SELECT COUNT(*)
					FROM products p
	 				inner join brand b on p.ID_BRAND = b.id
					inner join carcase c on p.ID_CARCASE = c.id
					inner join transmission t on p.ID_TRANSMISSION = t.id
					where ";
		$tegs = [];
		if (isset($brand))
        {
            $brand = mysqli_real_escape_string($this->connection, $brand);
            $tegs[] = "b.brand = '$brand'";
        }
		if (isset($carcase))
        {
            $carcase = mysqli_real_escape_string($this->connection, $carcase);
            $tegs[] = "c.carcase = '$carcase'";
        }
		if (isset($transmission))
        {
            $transmission = mysqli_real_escape_string($this->connection, $transmission);
            $tegs[] = "t.transmission = '$transmission'";
        }

		if (empty($tegs)) return $this->getPageCount();
        $query .= implode(' and ', $tegs);

        $result = mysqli_query($this->connection, $query);
        $row = mysqli_fetch_row($result);
		return ceil($row[0] / $countProductOnPage);
    }

    function getPageCountByQuery(string $sQuery)
    {
        $sQuery = mysqli_real_escape_string($this->connection, $sQuery);
        $countProductOnPage = ConfigurationController::getConfig('CountProductsOnPage');
		$query = "SELECT COUNT(*)
					from products
                    where LOWER(name) LIKE '%$sQuery%' or LOWER(FULL_DESCRIPTION) LIKE '%$sQuery%'";
        $result = mysqli_query($this->connection, $query);
        $row = mysqli_fetch_row($result);
		return ceil($row[0] / $countProductOnPage);
    }
    
	function getTegs(): ?array
	{
		$queryBrand = 'Select BRAND from brand';
		$resultBrand = mysqli_query($this->connection,$queryBrand);
		$tegs = [];
        while ($row = mysqli_fetch_assoc($resultBrand))
        {
            $tegs['brand'][] = $row['BRAND'];
        }

		$queryCarcase = 'Select CARCASE from carcase';
		$resultCarcase = mysqli_query($this->connection,$queryCarcase);

		while ($row = mysqli_fetch_assoc($resultCarcase))
		{
			$tegs['carcase'][] = $row['CARCASE'];
		}

		$queryTransmission = 'Select TRANSMISSION from transmission';
		$resultTransmissoin = mysqli_query($this->connection,$queryTransmission);

		while ($row = mysqli_fetch_assoc($resultTransmissoin))
		{
			$tegs['transmission'][] = $row['TRANSMISSION'];
		}
		return $tegs;
	}

    function createOrder(Order $order) : bool
	{
		$productId = $order->product->id;
		$productPrice = $order->product->price;
		$status = mysqli_real_escape_string($this->connection, $order->status);
		$dateCreation = $order->dateCreation;
		$fullName = mysqli_real_escape_string($this->connection, $order->fullName);
		$phone = mysqli_real_escape_string($this->connection, $order->phone);
		$mail = mysqli_real_escape_string($this->connection, $order->mail);
		$address = mysqli_real_escape_string($this->connection, $order->address);
		$comment = mysqli_real_escape_string($this->connection, $order->comment);

		$query = "INSERT INTO orders (product_id, product_price, status, date_creation, customer_name, customer_phone, customer_mail, customer_address, comment)
					values ( $productId, $productPrice, '$status', CURRENT_DATE(), '$fullName', '$phone', '$mail', '$address', '$comment' )";

		return mysqli_query($this->connection,$query);
	}
}