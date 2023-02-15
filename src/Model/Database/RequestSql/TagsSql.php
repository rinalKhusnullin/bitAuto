<?php 

namespace ES\Model\Database\RequestSql;

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

    function getBrands() : array
	{
		$query = "SELECT ID, BRAND FROM brand";

        $result = mysqli_query($this->connection, $query);
		$brands = [];
		while ($row = mysqli_fetch_assoc($result))
        {
            $brands[] = [ 'id' => $row['ID'], 'brand' => $row['BRAND']];
        }

		return $brands;
	}

	function getCarcases()
	{
		$query = "SELECT ID, CARCASE FROM carcase";

        $result = mysqli_query($this->connection, $query);
		$carcases = [];
		while ($row = mysqli_fetch_assoc($result))
        {
            $carcases[] = [ 'id' => $row['ID'], 'carcase' => $row['CARCASE']];
        }

		return $carcases;
	}

	function getTransmissions()
	{
		$query = "SELECT ID, TRANSMISSION FROM transmission";

        $result = mysqli_query($this->connection, $query);
		$transmissions = [];
		while ($row = mysqli_fetch_assoc($result))
        {
            $transmissions[] = [ 'id' => $row['ID'], 'transmission' => $row['TRANSMISSION']];
        }

		return $transmissions;
	}
}