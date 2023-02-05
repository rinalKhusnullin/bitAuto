<?php

namespace ES\model;

abstract class DB
{
	abstract function connect();
	abstract function getData() :array;
	abstract function getDataByID($id) :array;
	abstract function getDataByTeg() :array;
	abstract function updateData();
	abstract function createData();
	abstract function deleteData();
	abstract function buildProduct($result,$connection) :array;
}