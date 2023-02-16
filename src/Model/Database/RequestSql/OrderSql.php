<?php 

namespace ES\Model\Database\RequestSql;

use ES\Model\Order;
use ES\Model\Database\ObjectBuilder;

trait OrderSql
{

    function getOrders()
	{
		$query = "SELECT ID, PRODUCT_ID, PRODUCT_PRICE, STATUS, DATE_CREATION, CUSTOMER_NAME, CUSTOMER_PHONE, CUSTOMER_MAIL, CUSTOMER_ADDRESS, COMMENT
					FROM `order`
					ORDER BY DATE_CREATION";
		$result = mysqli_query($this->connection, $query);
		return ObjectBuilder::buildOrders($result);
	}

    function createOrder(Order $order) : bool
	{
		$productId = $order->productId;
		$productPrice = $order->productPrice;
		$status = mysqli_real_escape_string($this->connection, $order->status);
		$dateCreation = $order->dateCreation;
		$fullName = mysqli_real_escape_string($this->connection, $order->fullName);
		$phone = mysqli_real_escape_string($this->connection, $order->phone);
		$mail = mysqli_real_escape_string($this->connection, $order->mail);
		$address = mysqli_real_escape_string($this->connection, $order->address);
		$comment = mysqli_real_escape_string($this->connection, $order->comment);

		$query = "INSERT INTO `order` (product_id, product_price, status, date_creation, customer_name, customer_phone, customer_mail, customer_address, comment)
					values ( $productId, $productPrice, '$status', CURRENT_DATE(), '$fullName', '$phone', '$mail', '$address', '$comment' )";

		return mysqli_query($this->connection,$query);
	}
	function getOrderById($id)
	{
		$id = mysqli_real_escape_string($this->connection, $id);
		$query = "SELECT ID, PRODUCT_ID, PRODUCT_PRICE, STATUS, DATE_CREATION, CUSTOMER_NAME, CUSTOMER_PHONE, CUSTOMER_MAIL, CUSTOMER_ADDRESS, COMMENT
					FROM `order`
					WHERE ID = $id
					ORDER BY DATE_CREATION";
		$result = mysqli_query($this->connection, $query);
		return ObjectBuilder::buildOrders($result)[0];
	}
}