<?php

use ES\config\ConfigurationController;
use ES\Model\Database\MySql;
use ES\Model\Database\SqlConnection;
use ES\Model\Product;
use PHPUnit\Framework\TestCase;

class ProductSqlTest extends TestCase
{
	/** TODO tests for:
	 * getProductsByTeg
	 *
	 * getPageCountByTegs
	 * getPageCountByQuery
	 * getTegs
	 * createOrder
	 */
	public static function setUpBeforeClass(): void
	{
		$connection = SqlConnection::getInstance()->getConnection();
		mysqli_autocommit($connection, false);
		mysqli_query($connection, 'START TRANSACTION');
	}

	public static function tearDownAfterClass(): void
	{
		$connection = SqlConnection::getInstance()->getConnection();
		mysqli_rollback($connection);
	}

	public function testGetProducts(): void
	{
		$connection = SqlConnection::getInstance()->getConnection();
		$numberProduct = ConfigurationController::getConfig('CountProductsOnPage');
		$expected = mysqli_query($connection, "SELECT p.id, p.name, p.IS_ACTIVE, b.brand, t.transmission, c.carcase, p.DATE_CREATION, p.DATE_UPDATE, p.FULL_DESCRIPTION, p.PRODUCT_PRICE
					FROM product p
					inner join brand b on p.ID_BRAND = b.id
					inner join carcase c on p.ID_CARCASE = c.id
					inner join transmission t on p.ID_TRANSMISSION = t.id
                    WHERE p.IS_ACTIVE = true
			        group by p.ID
                    limit $numberProduct");
		$expected = array_map(function ($product) {
			return new ES\Model\Product(...$product);
		}, mysqli_fetch_all($expected));

		$db = MySql::getInstance();
		$actual = $db->getProducts();

		$this->assertSameSize($expected, $actual);

		$len = count($expected);
		for ($i = 0; $i < $len; $i++)
		{
			$this->assertObjectEquals($expected[$i], $actual[$i]);
		}
	}

	/**
	 * @dataProvider productDetailsProvider
	 */
	public function testGetProductByID($id, $expected): void
	{
		$db = MySql::getInstance();
		$actual = $db->getProductById($id);
		//Костыль
		$expected->fullDesc = str_replace(["\r\n", "\r", "\n", "\t", ' '], '',$expected->fullDesc);
		$actual->fullDesc = str_replace(["\r\n", "\r", "\n", "\t", ' '], '',$actual->fullDesc);
		$actual->dateCreation = '';
		$actual->dateUpdate = '';

		$this->assertObjectEquals($expected,$actual);
	}

	public static function productDetailsProvider(): array
	{
		return [
			[
				1,
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
							под верхнюю полку.', 450000),
			],
			[
				2,
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
							и несколькими пассажирами на борту.', 2700000),
			],
		];
	}

	public function testGetPageCount():void
	{
		$expected = ceil((int)mysqli_fetch_array(mysqli_query(SqlConnection::getInstance()->getConnection(),'SELECT COUNT(*)
				FROM product p
                WHERE p.IS_ACTIVE = true'))[0] / ConfigurationController::getConfig('CountProductsOnPage'));
		$db = MySql::getInstance();
		$actual = $db->getPageCount();
		$this->assertEquals($expected,$actual);
	}
}