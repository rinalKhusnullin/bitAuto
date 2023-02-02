<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../boot.php';

use \ES\Model\Products\Product;
use \ES\View\TemplateEngine;

$cars = [
	new Product(
		1,
		'Mazda',
		'Mazda 3',
		'Хэтчбэк',
		'АКПП',
		450000
	),

	new Product(
		2,
		'Mazda',
		'Mazda CX-5',
		'Кроссовер',
		'АКПП',
		2700000
	),

	new Product(
		3,
		'Toyota',
		'Toyota Camry',
		'Седан',
		'АКПП',
		2498000
	),

	new Product(
		4,
		'Toyota',
		'Toyota Solara',
		'Купе',
		'АКПП',
		600000
	),

	new Product(
		5,
		'Volkswagen',
		'Volkswagen Multivan',
		'Минивэн',
		'МКПП',
		1150000
	),

	new Product(
		6,
		'Volkswagen',
		'Volkswagen Passat',
		'Универсал',
		'АКПП',
		1150000
	),
];

try
{
	echo TemplateEngine::view('layout', [
		'title' => 'AUTOBIT',
		'content' => TemplateEngine::view('pages/index', [
			'cars' => $cars,
			]),
	]);
}
catch (Exception $e)
{
	echo TemplateEngine::view('layout', [
		'title' => 'AUTOBIT',
		'content' => 'Сервис временно не доступен',
	]);
}
