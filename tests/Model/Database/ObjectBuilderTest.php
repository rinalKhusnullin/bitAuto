<?php

use PHPUnit\Framework\TestCase;

class ObjectBuilderTest extends TestCase
{
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
			$this->assertEquals(\ES\Model\Order::class, $actual[$i]::class);
		}
	}
}