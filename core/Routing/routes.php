<?php

use ES\Controller\TemplateEngine;
use \ES\controller\Option;
use ES\Routing\Router;
use ES\Model\Products\Product;

Router::get('/', [new \ES\Controller\IndexController(), 'indexAction']);

Router::get('/product/:id/', [new \ES\controller\ProductController() , 'detailsAction']);