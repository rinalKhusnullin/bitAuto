<?php 

namespace ES\Model\Database\RequestSql;

use ES\Model\Database\ObjectBuilder;
use ES\Model\Tag;

trait TagsSql
{
    function getTagList(): ?array
	{
		$queryBrand = 'Select BRAND from brand';
		$resultBrand = mysqli_query($this->connection,$queryBrand);
		$tags = [];
        while ($row = mysqli_fetch_assoc($resultBrand))
        {
            $tags['brand'][] = $row['BRAND'];
        }

		$queryCarcase = 'Select CARCASE from carcase';
		$resultCarcase = mysqli_query($this->connection,$queryCarcase);

		while ($row = mysqli_fetch_assoc($resultCarcase))
		{
			$tags['carcase'][] = $row['CARCASE'];
		}

		$queryTransmission = 'Select TRANSMISSION from transmission';
		$resultTransmissoin = mysqli_query($this->connection,$queryTransmission);

		while ($row = mysqli_fetch_assoc($resultTransmissoin))
		{
			$tags['transmission'][] = $row['TRANSMISSION'];
		}
		return $tags;
	}


	function getTags(string $tag) : array
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
}