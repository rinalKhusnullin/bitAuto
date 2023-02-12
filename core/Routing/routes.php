<?php

use ES\config\ConfigurationController;
use ES\Controller\TemplateEngine;
use ES\Routing\Router;

Router::get('/', [new \ES\Controller\IndexController(), 'indexAction']);

Router::get('/product/:id/', [new \ES\Controller\ProductController() , 'getDetailAction']);

Router::post('/product/:id/', [new \ES\Controller\ProductController() , 'postDetailAction']);

Router::get('/contacts/', [new \ES\Controller\ContactsController(),'getContactsAction']);

Router::get('/error/', [new \ES\Controller\ErrorController(),'getSystemErrorAction']);

Router::get('/success/', function () {
    echo TemplateEngine::view('layout', [
        'title' => ConfigurationController::getConfig('TITLE', 'AutoBit'),
        'content' => TemplateEngine::view('pages/success', []),
    ]);
});

Router::get('/failed/', function () {
    echo TemplateEngine::view('layout',[
        'title' => ConfigurationController::getConfig('TITLE', 'AutoBit'),
        'content' => TemplateEngine::view('pages/failed', []),
    ]);
});

Router::get('/admin/', function () {
	echo TemplateEngine::view('adminPanelLayout',[
		'title' => 'admin',
		'content' => [],
	]);
} );