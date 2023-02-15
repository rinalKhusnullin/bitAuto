<?php

use ES\config\ConfigurationController;
use ES\Controller\TemplateEngine;
use ES\Model\Database\MySql;
use PHPUnit\Framework\TestCase;

class ProductControllerTest extends TestCase
{
	public static function setUpBeforeClass(): void
	{
		$connection = \ES\Model\Database\SqlConnection::getInstance()->getConnection();
		mysqli_autocommit($connection,false);
		mysqli_query($connection,'START TRANSACTION');
	}

	public static function tearDownAfterClass(): void
	{
		$connection = \ES\Model\Database\SqlConnection::getInstance()->getConnection();
		mysqli_rollback($connection);
	}

	/**
	 * @dataProvider ordersProvider
	 */

	public function testCreateForm(int $productId,string $lastname,string $name,string $phone,string $mail,string $address,?string $comment = ''):void
	{
		$_POST['userLastname'] = $lastname;
		$_POST["userName"] = $name;
		$_POST["userTel"] = $phone;
		$_POST["userEmail"] = $mail;
		$_POST["userAddress"] = $address;
		$_POST["userComment"] = $comment;

		$productController = new \ES\Controller\ProductController();
		$productController->postDetailAction($productId);
		$_POST = [];
		session_abort();

		$connection = \ES\Model\Database\SqlConnection::getInstance()->getConnection();
		$result = mysqli_query($connection,"SELECT * FROM orders WHERE ID = LAST_INSERT_ID()");
		$result = mysqli_fetch_assoc($result);
		extract($result);

		$this->assertEquals((int)$PRODUCT_ID, $productId);
		$this->assertStringContainsString($lastname . ' '. $name, $CUSTOMER_NAME);
		$this->assertStringContainsString($phone, $CUSTOMER_PHONE);
		$this->assertStringContainsString($mail, $CUSTOMER_MAIL);
		$this->assertStringContainsString($address, $CUSTOMER_ADDRESS);
		$this->assertStringContainsString($comment, $COMMENT);
	}

	public static function ordersProvider():array
	{
		return [
			[1,'Tevs','Daniil','89996663311','testmail@mail.com','Moscow','Please, cheese'],
			[2,'Svet','Linad','+793468989494','nightbr@mail.ru','London'],
		];
	}

	/**
	 * @dataProvider wrongIdProvider
	 */
	public function testInvalidIdProduct($id): void
	{
		$productController = new \ES\Controller\ProductController();
		$productController->getDetailAction($id);
		$httpCodeForGet = http_response_code();
		session_abort();
		$productController->postDetailAction($id);
		$httpCodeForPost = http_response_code();
		session_abort();
		ob_end_clean();
		session_abort();

		$this->assertEquals(302,$httpCodeForGet);
		$this->assertEquals(302,$httpCodeForPost);
	}

	public static function wrongIdProvider():array
	{
		return [
			[0],
			[-1],
			[-1000],
			['wrongId'],
			[PHP_INT_MAX],
		];
	}

	/**
	 * @dataProvider productDetailsProvider
	 */
	public function testDetailPage($product): void
	{
		$productController = new \ES\Controller\ProductController();
		$productController->getDetailAction($product['id']);
		$actual = ob_get_clean();
		session_abort();

		$expected = TemplateEngine::view('layout', [
			'title' => ConfigurationController::getConfig('TITLE'),
			'tags' => MySql::getInstance()->getTegs(),
			'role' => array_key_exists('USER', $_SESSION) ? $_SESSION['USER']['role'] : 'user',
			'content' => TemplateEngine::view('Product/product-detailed', (array)$product),
		]);
		$expected = str_replace(["\r\n", "\r", "\n","\t",' '], '', $expected);
		$actual = str_replace(["\r\n", "\r", "\n","\t",' '], '', $actual);

		$this->assertStringContainsString($expected, $actual);
	}

	public static function productDetailsProvider(): array
	{
		return [
			[
				[
					'id' => 7,
					'price' => 500000,
					'brand' => 'Mazda',
					'title' => 'Mazda 6',
					'carcaseType' => 'Седан',
					'transmission' => 'АКПП',
					'fullDesc' => 'Мазда 6- это модель Гольф класса, выпускающаяся в двух вариантах
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
					под верхнюю полку.',
				],
			],
			[
				'id' => 8,
				'price' => 2750000,
				'brand' => 'Toyota',
				'title' => 'Toyota LandCruiser',
				'carcaseType' => 'Кроссовер',
				'transmission' => 'АКПП',
				'fullDesc' => 'Toyota LandCruiser пятиместный кроссовер.
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
				и несколькими пассажирами на борту.',
			],
		];
	}
}
