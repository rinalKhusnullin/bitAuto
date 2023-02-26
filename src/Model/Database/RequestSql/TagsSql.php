<?php 

namespace ES\Model\Database\RequestSql;

use ES\Model\Database\ObjectBuilder;
use ES\Model\Tag;

trait TagsSql
{

	function getTagByName(string $tag) : array
	{
		$query = "SELECT ID, $tag FROM $tag";

        $result = mysqli_query($this->connection, $query);

		return ObjectBuilder::buildTags($result, $tag);
	}

	function getTagById($id, string $tag) : ?Tag 
	{
		$id = mysqli_real_escape_string($this->connection, $id);

		$query = "SELECT ID, $tag FROM $tag WHERE ID = $id";

        $result = mysqli_query($this->connection, $query);

		return ObjectBuilder::buildTags($result, $tag)[0];
	}

	function updateTags(string $tag,int $id,string $value)
	{
		$title = mysqli_real_escape_string($this->connection, $value);
		$tag = mysqli_real_escape_string($this->connection, $tag);

		$query = "UPDATE $tag
			SET $tag = '$value'
			where ID = $id";

		return mysqli_query($this->connection,$query);
	}

	function createTags(string $tag,string $value)
	{
		$title = mysqli_real_escape_string($this->connection, $value);
		$tag = mysqli_real_escape_string($this->connection, $tag);

		$query = "INSERT INTO $tag ($tag)
					VALUES ('$value')";

		return mysqli_query($this->connection,$query);
	}
}