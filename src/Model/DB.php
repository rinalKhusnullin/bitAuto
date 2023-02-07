<?php

namespace ES\Model;

abstract class DB
{
	abstract function getData($isPublic, $page) : array;
	abstract function getDataByID($id) : ?Products\Product;
	abstract function getDataByTeg($brand, $carcase, $transmission, $page) : ?array;
	abstract function updateData();
	abstract function createData();
	abstract function deleteData();
	abstract function buildProduct($result,$connection) : ?array;
	abstract function getPageCount();
	abstract function createOrder(Order $order) :bool;
}