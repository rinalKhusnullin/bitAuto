<?php

namespace ES\model;

abstract class DB
{
	abstract function connect() :?mysqli;
	abstract function getData() :array;
	abstract function getDataByID() :array;
	abstract function getDataByTeg() :array;
	abstract function updateData();
	abstract function createData();
	abstract function deleteData();
}