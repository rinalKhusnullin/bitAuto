<?php 

namespace ES\Model\Database\RequestSql;

use ES\config\ConfigurationController;
use ES\Model\Product;
use ES\Model\Database\ObjectBuilder;

trait ProductSql
{
    public function getProducts(int $page = 0, string $isActive = 'active') : array
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

		$countProductsOnPage = ConfigurationController::getConfig('CountProductsOnPage');
		$page = ($page > 1) ? $page * $countProductsOnPage - $countProductsOnPage : 0;
		$query = "SELECT p.id, p.name, p.IS_ACTIVE, b.brand, t.transmission, c.carcase, p.DATE_CREATION, p.DATE_UPDATE, p.FULL_DESCRIPTION, p.PRODUCT_PRICE
					FROM product p
					inner join brand b on p.ID_BRAND = b.id
					inner join carcase c on p.ID_CARCASE = c.id
					inner join transmission t on p.ID_TRANSMISSION = t.id
                    $activityQuery
			        group by p.ID
                    limit $countProductsOnPage offset $page";
		
        $result = mysqli_query($this->connection, $query);
		return ObjectBuilder::buildProducts($result);
    }

    function getProductByID($id) : ?Product
	{
		$id = mysqli_real_escape_string($this->connection, $id);
		$query = "SELECT p.id, p.name, p.IS_ACTIVE, b.brand, t.transmission, c.carcase, p.DATE_CREATION, p.DATE_UPDATE, p.FULL_DESCRIPTION, p.PRODUCT_PRICE
					FROM product p
					inner join brand b on p.ID_BRAND = b.id
					inner join carcase c on p.ID_CARCASE = c.id
					inner join transmission t on p.ID_TRANSMISSION = t.id
					where $id = p.id";
		$result = mysqli_query($this->connection, $query);
		return ObjectBuilder::buildProducts($result)[0];
	}

    function getProductsByQuery(string $sQuery, int $page = 0, string $isActive = 'active') : array
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
		$countProductOnPage = ConfigurationController::getConfig('CountProductsOnPage');
		$page = ($page > 1) ? $page * $countProductOnPage - $countProductOnPage : 0;
		$sQuery = mysqli_real_escape_string($this->connection, $sQuery);

		$query = "SELECT p.id, p.name, p.IS_ACTIVE, b.brand, t.transmission, c.carcase, p.DATE_CREATION, p.DATE_UPDATE, p.FULL_DESCRIPTION, p.PRODUCT_PRICE
			FROM product p
			inner join brand b on p.ID_BRAND = b.id
			inner join carcase c on p.ID_CARCASE = c.id
			inner join transmission t on p.ID_TRANSMISSION = t.id
			where (p.name LIKE '%$sQuery%' or p.FULL_DESCRIPTION LIKE '%$sQuery%')
			$isActiveQuery
            limit $countProductOnPage offset $page";

		$result = mysqli_query($this->connection, $query);

		return ObjectBuilder::buildProducts($result);

	}

    function getProductsByTags($brand, $carcase, $transmission, int $page = 0, string $isActive = 'active'): array
	{
		switch ($isActive)
		{
			case 'all':
				$isActiveQuery = "";
				break;
			case 'notActive':
				$isActiveQuery = " (p.IS_ACTIVE IS NULL) AND ";
				break;
			case 'active':
			default:
				$isActiveQuery = " (p.IS_ACTIVE IS NOT NULL) AND ";
				break;
		};
		$countProductOnPage = ConfigurationController::getConfig('CountProductsOnPage');
		$page = ($page > 1) ? $page * $countProductOnPage - $countProductOnPage : 0;
		$query = "SELECT p.id, p.name, p.IS_ACTIVE, b.brand, t.transmission, c.carcase, p.DATE_CREATION, p.DATE_UPDATE,  p.FULL_DESCRIPTION, p.PRODUCT_PRICE
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
        

		if (empty($tags)) return $this->getProducts(true);

		$query .= implode(' and ', $tags) . " limit $countProductOnPage offset $page";

		$result = mysqli_query($this->connection, $query);
		return ObjectBuilder::buildProducts($result);
	}

	function UpdateProduct(Product $product)
	{
		foreach ($product as $key => $value)
		{
			$product->$key = mysqli_real_escape_string($this->connection, $value);
		}
		$isActive = ($product->isActive) ? 1 : 0; 
		$brandId = $this->getIdByTagValue('Brand', $product->brandType);
		$carcaseId = $this->getIdByTagValue('Carcase', $product->carcaseType);
		$transmissionId = $this->getIdByTagValue('Transmission', $product->transmissionType);
		$query = "UPDATE product
				SET NAME = '$product->title',
					FULL_DESCRIPTION = '$product->fullDesc',
					PRODUCT_PRICE = '$product->price',
					IS_ACTIVE = $isActive,
					ID_BRAND = $brandId,
					ID_CARCASE = $carcaseId,
					ID_TRANSMISSION = $transmissionId,
					DATE_CREATION = '$product->dateCreation',
					DATE_UPDATE = '$product->dateUpdate'
				WHERE ID = '$product->id'";

		return mysqli_query($this->connection, $query);
	}
}