<?php

use ES\controller\ConfigurationController;
use ES\Controller\TemplateEngine;
use ES\Routing\Router;

Router::get('/', [new \ES\Controller\IndexController(), 'indexAction']);

Router::get('/product/:id/', [new \ES\Controller\ProductController() , 'getDetailAction']);

Router::post('/product/:id/', [new \ES\Controller\ProductController() , 'postDetailAction']);

Router::get('/contacts', [new \ES\Controller\ContactsController(),'getContactsAction']);

Router::get('/error', [new \ES\Controller\ErrorController(),'getSystemErrorAction']);
