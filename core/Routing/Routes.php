<?php

use ES\Controller\TemplateEngine;
use \ES\controller\Option;
use ES\Routing\Router;

use ES\Model\Products\Product;

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

Router::get('/', static function () use ($cars) {
	return TemplateEngine::view('layout', [
		'title' => Option::getConfig('TITLE'),
		'content' => TemplateEngine::view('pages/index', [
			'cars' => $cars,
		]),
	]);
});

Router::get('/product/:id/', static function ($id) {
	return TemplateEngine::view('layout', [
		'title' => Option::getConfig('TITLE'),
		'content' => TemplateEngine::view('pages/product-detailed', [
			'cars' => '',
		]), // @Todo add product page
	]);
});