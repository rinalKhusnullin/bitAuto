<?php

use ES\controller\ConfigurationController;
use ES\Controller\TemplateEngine;
use ES\Routing\Router;

Router::get('/', [new \ES\Controller\IndexController(), 'indexAction']);

Router::get('/product/:id/', [new \ES\Controller\ProductController() , 'getDetailAction']);

Router::post('/product/:id/', [new \ES\Controller\ProductController() , 'getDetailAction']);

Router::get('/contacts', function () {
    echo TemplateEngine::view('layout', [
        'title' => ConfigurationController::getConfig('TITLE', 'AutoBit'),
        'content' => TemplateEngine::view('pages/contacts', [])
    ]);
});
