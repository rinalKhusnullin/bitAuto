<?php


use ES\Routing\Router;

Router::get('/', [new \ES\Controller\IndexController(), 'indexAction']);

Router::get('/product/:id/', [new \ES\Controller\ProductController() , 'getDetailAction']);