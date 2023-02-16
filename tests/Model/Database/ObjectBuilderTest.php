<?php

namespace ES\Model\Database;

use ES\Model\Order;
use ES\Model\Product;
use PHPUnit\Framework\TestCase;

class ObjectBuilderTest extends TestCase
{
	public static function setUpBeforeClass(): void
	{
		$connection = \ES\Model\Database\SqlConnection::getInstance()->getConnection();
		mysqli_autocommit($connection, false);
		mysqli_query($connection, 'START TRANSACTION');
	}

	public static function tearDownAfterClass(): void
	{
		$connection = \ES\Model\Database\SqlConnection::getInstance()->getConnection();
		mysqli_rollback($connection);
	}

	/**
	 * @dataProvider ordersProvider
	 */
	public function testBuildOrders($orders): void
	{
		$connection = \ES\Model\Database\SqlConnection::getInstance()->getConnection();
		foreach ($orders as $order)
		{
			$product = $order->product;
			$query = "INSERT INTO order (product_id, product_price, status, date_creation, customer_name, customer_phone, customer_mail, customer_address, comment)
					values ( $product->id, $product->price, '$order->status', '$order->dateCreation', '$order->fullName', '$order->phone', '$order->mail', '$order->address', '$order->comment' )";
			mysqli_query($connection, $query);
		}

		$id = mysqli_fetch_array(mysqli_query($connection, 'SELECT LAST_INSERT_ID()'));
		$id = (int)$id[0] - count($orders);
		$actual = mysqli_query($connection, "SELECT * FROM orders WHERE ID>{$id}");
		$actual = ObjectBuilder::buildOrders($actual);

		$this->assertSameSize($orders, $actual);

		$len = count($orders);
		for ($i = 0; $i < $len; $i++)
		{
			$actual[$i]->product->dateCreation = '';
			$actual[$i]->product->dateUpdate = '';

			$orders[$i]->product->fullDesc = str_replace(["\r\n", "\r", "\n", "\t", ' '], '',
				$orders[$i]->product->fullDesc);
			$actual[$i]->product->fullDesc = str_replace(["\r\n", "\r", "\n", "\t", ' '], '',
				$actual[$i]->product->fullDesc);
		}

		for ($i = 0; $i < $len; $i++)
		{
			$this->assertObjectEquals($orders[$i], $actual[$i]);
		}
	}

	public static function ordersProvider(): array
	{
		return [
			[
				[
					new Order('Bob', 'Tom', '89009006936', 'test@mail.ru', 'Moscow', 'any comment',
						new Product(1, 'Mazda 3', true, 'Mazda', 'АКПП', 'Хэтчбек', '', '',
							'Мазда 3- это модель Гольф класса, выпускающаяся в двух вариантах
							исполнения: пятидверный хэтчбек и седан.
							Его габаритные размеры составляют:
							длина 4460 мм, ширина 1795 мм, высота 1435 мм, а колесная база- 2725 мм.
							Дорожный просвет довольно скромный. Между нижней точкой днища и асфальтом
							остается всего 135 миллиметров. Что касается самой платформы, то с моделью
							произошло глобальное изменение. Она основывается на модернизированной базе
							Skyactiv-Vehiche с передним поперечным расположением силового агрегата.
							На передней оси расположились независимые стойки McPherson с жесткими рычагами,
							подрамником и стабилизатором поперечной устойчивости. Сзади же, в свою очередь,
							вместо полностью независимой многорычажной конструкции, будет находиться более
							простая полузависимая торсионная балка. Производитель заверяет, что такое решение
							позволило не только удешевить производство, но также повысить плавность хода,
							особенно на небольших неровностях. Что касается размера багажника, то седан сможет
							предложить 450 литров свободного пространства, а хэтчбек до 358 литров при загрузке
							под верхнюю полку.', 450000), date("Y-m-d H:i:s")),
					new Order('Kit', 'Kat', '80000000000', 'rooot@mail.com', 'London', 'any comment',
						new Product(2, 'Mazda CX-5', true, 'Mazda', 'АКПП', 'Кроссовер', '', '',
							'Mazda CX-5 пятиместный кроссовер.
							Его габаритные размеры составляют: длина 4550 мм,
							ширина 1840 мм, высота 1690 мм, колесная база 2700 мм,
							а величина дорожного просвета равняется 192 миллиметрам.
							Такой клиренс свойственен автомобилям, подготовленным к
							тяжелым условиям эксплуатации . Они с легкостью перенесут
							поездку по грунтовке, смогут штурмовать бордюры во время парковки
							и сохранят приемлемую плавность хода во время движения по разбитой дороге
							с твердым покрытием.
							Багажник Mazda CX-5 обладает неплохой вместительностью.
							При поднятых спинках второго ряда сидений, сзади остается вплоть
							до 505 литров свободного пространства. Благодаря такому объему,
							автомобиль отлично справится с повседневными задачами городского жителя
							и не ударит в грязь лицом даже во время длительной поездки с обилием багажа
							и несколькими пассажирами на борту.', 2700000), date("Y-m-d H:i:s")),
				],
			],
		];
	}

	/**
	 * @dataProvider productProvider
	 */
	public function testBuildProduct($expected, $limit, $offset): void
	{
		$connection = SqlConnection::getInstance()->getConnection();
		$query = "SELECT p.id, p.name, p.IS_ACTIVE, b.brand, t.transmission, c.carcase, p.DATE_CREATION, p.DATE_UPDATE, p.FULL_DESCRIPTION, p.PRODUCT_PRICE
					FROM product p
					inner join brand b on p.ID_BRAND = b.id
					inner join carcase c on p.ID_CARCASE = c.id
					inner join transmission t on p.ID_TRANSMISSION = t.id
					group by p.ID
					LIMIT {$limit}
					OFFSET {$offset}";
		$products = ObjectBuilder::buildProducts(mysqli_query($connection, $query));

		$this->assertSameSize($expected, $products);

		//Костыль
		$len = count($products);
		for ($i = 0; $i < $len; $i++)
		{
			$products[$i]->dateCreation = '';
			$products[$i]->dateUpdate = '';
			$expected[$i]->fullDesc = str_replace(["\r\n", "\r", "\n"], '', $expected[$i]->fullDesc);
			$products[$i]->fullDesc = str_replace(["\r\n", "\r", "\n"], '', $products[$i]->fullDesc);
		}

		for ($i = 0; $i < $len; $i++)
		{
			$this->assertObjectEquals($expected[$i], $products[$i]);
		}
	}

	public static function productProvider(): array
	{
		return [
			[
				[
					new Product(1, 'Mazda 3', true, 'Mazda', 'АКПП', 'Хэтчбек',
						'', '', 'Мазда 3- это модель Гольф класса, выпускающаяся в двух вариантах
исполнения: пятидверный хэтчбек и седан.
Его габаритные размеры составляют:
длина 4460 мм, ширина 1795 мм, высота 1435 мм, а колесная база- 2725 мм.
Дорожный просвет довольно скромный. Между нижней точкой днища и асфальтом
 остается всего 135 миллиметров. Что касается самой платформы, то с моделью
произошло глобальное изменение. Она основывается на модернизированной базе
 Skyactiv-Vehiche с передним поперечным расположением силового агрегата.
На передней оси расположились независимые стойки McPherson с жесткими рычагами,
 подрамником и стабилизатором поперечной устойчивости. Сзади же, в свою очередь,
 вместо полностью независимой многорычажной конструкции, будет находиться более
 простая полузависимая торсионная балка. Производитель заверяет, что такое решение
 позволило не только удешевить производство, но также повысить плавность хода,
 особенно на небольших неровностях. Что касается размера багажника, то седан сможет
 предложить 450 литров свободного пространства, а хэтчбек до 358 литров при загрузке
под верхнюю полку.', 450000),
				],
				1,
				0,
			],
			[
				[
					new Product(6, 'VolksWagen Passat', true, 'VolksWagen', 'АКПП', 'Универсал',
						'', '', 'Volkswagen Passat — семейство среднеразмерных автомобилей компании Volkswagen,
 производившееся с 1973 по 2022 год. Название Пассат произошло от
одноимённого ветра.
Volkswagen Passat B8 впервые был показан в потсдамском дизайн-центре Volkswagen
3 июля 2014 года. Новый Passat B8 был построен на новой платформе MQB,
 на которой также базировалось семейство VW Golf[25]. По сравнению с предшественником B6,
седан Passat B8 стал короче на 2 мм (4767 мм), а колёсная база выросла на 79 мм (до 2791 мм),
 33 мм прибавилось к длине салона. Ширина увеличилась на 12 мм (до 1832 мм),
 а высота уменьшилась на 14 мм (1456 мм). Свесы кузова стали короче на 67 мм спереди
и 13 мм сзади.', 1150000),
					new Product(7, 'Mazda 6', true, 'Mazda', 'АКПП', 'Седан',
						'', '', 'Мазда 6- это модель Гольф класса, выпускающаяся в двух вариантах
исполнения: пятидверный хэтчбек и седан.
Его габаритные размеры составляют:
длина 4460 мм, ширина 1795 мм, высота 1435 мм, а колесная база- 2725 мм.
Дорожный просвет довольно скромный. Между нижней точкой днища и асфальтом
 остается всего 135 миллиметров. Что касается самой платформы, то с моделью
произошло глобальное изменение. Она основывается на модернизированной базе
 Skyactiv-Vehiche с передним поперечным расположением силового агрегата.
На передней оси расположились независимые стойки McPherson с жесткими рычагами,
 подрамником и стабилизатором поперечной устойчивости. Сзади же, в свою очередь,
 вместо полностью независимой многорычажной конструкции, будет находиться более
 простая полузависимая торсионная балка. Производитель заверяет, что такое решение
 позволило не только удешевить производство, но также повысить плавность хода,
 особенно на небольших неровностях. Что касается размера багажника, то седан сможет
 предложить 450 литров свободного пространства, а хэтчбек до 358 литров при загрузке
под верхнюю полку.', 500000),
					new Product(8, 'Toyota LandCruiser', true, 'Toyota', 'АКПП', 'Кроссовер',
						'', '', 'Toyota LandCruiser пятиместный кроссовер.
Его габаритные размеры составляют: длина 4550 мм,
ширина 1840 мм, высота 1690 мм, колесная база 2700 мм,
а величина дорожного просвета равняется 192 миллиметрам.
Такой клиренс свойственен автомобилям, подготовленным к
тяжелым условиям эксплуатации . Они с легкостью перенесут
поездку по грунтовке, смогут штурмовать бордюры во время парковки
 и сохранят приемлемую плавность хода во время движения по разбитой дороге
 с твердым покрытием.
Багажник Toyota LandCruiser обладает неплохой вместительностью.
При поднятых спинках второго ряда сидений, сзади остается вплоть
до 505 литров свободного пространства. Благодаря такому объему,
автомобиль отлично справится с повседневными задачами городского жителя
и не ударит в грязь лицом даже во время длительной поездки с обилием багажа
и несколькими пассажирами на борту.', 2750000),
				],
				3,
				5,
			],

		];
	}
}