<?php

namespace ES\Model\Database\RequestSql;

use ES\config\ConfigurationController;
use ES\Model\Product;
use ES\Model\Database\ObjectBuilder;

trait ProductSql
{

	public function getImagesById(string $id) : array
	{
		$query = "SELECT PATH, IS_MAIN, ID_PRODUCT FROM image where ID_PRODUCT having ('$id')";
		$result = mysqli_query($this->connection, $query);
		$images = [];

		while ($row = mysqli_fetch_assoc($result))
		{
			$images[] = [
				'id' => $row['ID_PRODUCT'],
				'path' => $row['PATH'],
				'isMain' => $row['IS_MAIN']
			];
		}
		return $images;
	}

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
		}

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
		$productById = ObjectBuilder::buildProducts($result);
		return $productById[0];
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

	function updateProduct(Product $product)
	{
		foreach ($product as $key => $value)
		{
			if($key === 'images')
			{
				$query = "SELECT
					PATH,
					IS_MAIN
				FROM image
				WHERE ID_PRODUCT = '$product->id'";
				$result = mysqli_fetch_all(mysqli_query($this->connection, $query));

				// Временная директория.
				$tmp_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/tmp/';

				// Постоянная директория.
				$path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/main/';

				if (empty($result))
				{
					$query = "INSERT INTO image (is_main, id_product, PATH)
										values ";

					foreach ($product->images as $row)
					{
						$filename = preg_replace("/[^a-z0-9\.-]/i", '', $row);
						$mainImage = $product->mainImage === $filename ? 'true' : 'false';

						if (!empty($filename) && is_file($tmp_path . $filename))
						{
							$query .= " ($mainImage, '$product->id', '$filename'),";

							// Перенос оригинального файла
							rename($tmp_path . $filename, $path . $filename);

							// Перенос превью
							$file_name = pathinfo($filename, PATHINFO_FILENAME);
							$file_ext = pathinfo($filename, PATHINFO_EXTENSION);
							$thumb = $file_name . '-thumb.' . $file_ext;
							rename($tmp_path . $thumb, $path . $thumb);

						}
					}
					$query = rtrim($query, ",") . ';';

					if (file_exists($tmp_path)) {
						$pattern = $tmp_path . '*';
						foreach (glob($pattern) as $file) {
							unlink($file);
						}
					}

					mysqli_query($this->connection, $query);
				}
				else
				{
				//другие сценарии
				}
			}

				continue; ///@todo добавить работу с картинками
			$product->$key = mysqli_real_escape_string($this->connection, $value);
		}
		$isActive = ($product->isActive) ? 1 : 0;
		$query = "UPDATE product
				SET NAME = '$product->title',
					FULL_DESCRIPTION = '$product->fullDesc',
					PRODUCT_PRICE = '$product->price',
					IS_ACTIVE = $isActive,
					ID_BRAND = $product->brandType,
					ID_CARCASE = $product->carcaseType,
					ID_TRANSMISSION = $product->transmissionType,
					DATE_CREATION = '$product->dateCreation',
					DATE_UPDATE = '$product->dateUpdate'
				WHERE ID = '$product->id'";

		return mysqli_query($this->connection, $query);
	}

	function createProduct(Product $product)
	{
		$title = mysqli_real_escape_string($this->connection, $product->title);
		$isActive = ($product->isActive) ? 1 : 0;
		$brandType = mysqli_real_escape_string($this->connection, $product->brandType);
		$transmissionType = mysqli_real_escape_string($this->connection, $product->transmissionType);
		$carcaseType = mysqli_real_escape_string($this->connection, $product->carcaseType);
		$fullDesc = mysqli_real_escape_string($this->connection, $product->fullDesc);
		$price = $product->price;

		$query = "INSERT INTO product (NAME, IS_ACTIVE, ID_BRAND,ID_TRANSMISSION, ID_CARCASE, DATE_CREATION, FULL_DESCRIPTION, PRODUCT_PRICE)
					values ('$title', $isActive, $brandType, $transmissionType, $carcaseType, CURRENT_TIMESTAMP(), '$fullDesc', $price)";

		return mysqli_query($this->connection,$query);
	}
}