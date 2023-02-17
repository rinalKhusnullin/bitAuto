<?php

use PHPUnit\Framework\TestCase;

class ObjectBuilderTest extends TestCase
{
	/**TODO make tests for:
	 *buildUsers
	 * buildTags
	 */
	public function testBuildProducts(): void
	{
		$testData = [
			[1, 'Test1', true, 'brand1', 'transmission1', 'carcase1', 'date1', null, 'description1', 1000],
			[2, 'Test2', true, 'brand2', 'transmission2', 'carcase2', 'date2', null, 'description2', 2000],
			[3, 'Test3', true, 'brand3', 'transmission3', 'carcase3', 'date3', null, 'description3', 3000],
			[2, 'Test4', true, 'brand4', 'transmission4', 'carcase4', 'date4', null, 'description2', 4000],
		];

		$actual = \ES\Model\Database\ObjectBuilder::buildProducts($testData);

		$this->assertSameSize($testData, $actual);

		$len = count($testData);
		for ($i = 0; $i < $len; $i++)
		{
			$this->assertObjectEquals(new \ES\Model\Product(...$testData[$i]), $actual[$i]);
		}
	}

	public function testBuildOrders(): void
	{
		$testData = [
			[1, 'Name1', '89006008011', 'test1@mail.ru', 'address1', 'comment1', 1, 1000, 'date1'],
			[2, 'Name2', '89006008022', 'test2@mail.ru', 'address2', 'comment2', 2, 2000, 'date2','done'],
			[3, 'Name3', '89006008033', 'test3@mail.ru', 'address2', 'comment3', 3, 3000, 'date3'],
		];

		$actual = \ES\Model\Database\ObjectBuilder::buildOrders($testData);

		$this->assertSameSize($testData, $actual);

		$len = count($testData);
		for ($i = 0; $i < $len; $i++)
		{
			$this->assertObjectEquals(new \ES\Model\Order(...$testData[$i]), $actual[$i]);
		}
	}
}