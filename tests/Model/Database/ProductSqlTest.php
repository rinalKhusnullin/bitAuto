<?php

use ES\Model\Database\MySql;
use ES\Model\Product;
use ES\Services\ConfigurationService;
use PHPUnit\Framework\TestCase;

class ProductSqlTest extends TestCase
{
	/**TODO
	 * getProductsByQuery
	 * getProductsByTags
	 * UpdateProduct
	 */
	public function testGetProduct(): void
	{
		$products = MySql::getInstance()->getProducts();
		$this->assertTrue(ConfigurationService::getConfig('CountProductsOnPage')>=count($products));
		foreach ($products as $product)
		{
			$this->assertEquals(Product::class,$product::class);
		}
	}

	public function testGetProductByID() : void
	{
		mysqli_query(\ES\Model\Database\SqlConnection::getInstance()->getConnection(),
			"INSERT IGNORE INTO `order` VALUE(1,'Test','Desc',true,1000,'2023-02-17 00:00:00',null,1,1,1)");
		$product = MySql::getInstance()->getProductByID(1);
		$this->assertEquals(Product::class,$product::class);
		$this->assertEquals(1,$product->id);
	}


}