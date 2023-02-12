<?php

namespace ES\Model;

abstract class DB
{
	abstract function getProductData($isPublic, $page) : array;
	abstract function getProductDataByID($id) : ?\ES\Model\Product;
	abstract function getProductDataByTeg($brand, $carcase, $transmission, $page) : ?array;
	abstract function getTegs() :?array;
	abstract function updateData();
	abstract function createData();
	abstract function deleteData();
	abstract function buildProduct($result) : ?array;
	abstract function getPageCount($isQuery = false, $argument = null);
	abstract function createOrder(Order $order) :bool;
}