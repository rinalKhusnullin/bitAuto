<?php

use ES\config\ConfigurationController;
use ES\Controller\TemplateEngine;
use ES\Routing\Router;

Router::get('/', [new \ES\Controller\IndexController(), 'indexAction']);

Router::get('/login/', [new \ES\Controller\LoginController(),'getLoginAction']);
Router::post('/login/', [new \ES\Controller\LoginController(),'getLoginAction']);

Router::get('/logout/', [new \ES\Controller\LogoutController(),'LogoutAction']);

Router::get('/product/:id/', [new \ES\Controller\ProductController() , 'getDetailAction']);
Router::post('/product/:id/', [new \ES\Controller\ProductController() , 'postDetailAction']);

Router::get('/contacts/', [new \ES\Controller\ContactsController(),'getContactsAction']);

Router::get('/error/', [new \ES\Controller\ErrorController(),'getSystemErrorAction']);

Router::get('/success/', function () {
	session_start();
	$role = array_key_exists('USER' , $_SESSION)? $_SESSION['USER']->role : 'user';
    echo TemplateEngine::view('layout', [
        'title' => ConfigurationController::getConfig('TITLE', 'AutoBit'),
		'role' => $role,
        'content' => TemplateEngine::view('pages/success', []),
    ]);
});

Router::get('/failed/', function () {
	session_start();
	$role = array_key_exists('USER' , $_SESSION)? $_SESSION['USER']->role : 'user';
    echo TemplateEngine::view('layout',[
        'title' => ConfigurationController::getConfig('TITLE', 'AutoBit'),
		'role' => $role,
        'content' => TemplateEngine::view('pages/failed', []),
    ]);
});

Router::get('/admin/', [new \ES\Controller\AdminController(), 'adminAction']);

Router::get('/admin/edit/', [new \ES\Controller\AdminController(), 'adminEditAction']);

Router::post('/admin/edit/', [new \ES\Controller\AdminController(), 'adminChangeItem']);

Router::get('/admin/edit/delete/', [new \ES\Controller\AdminController(),'adminDeleteAction']);

Router::get('/admin/add/', [new \ES\Controller\AdminController(), 'adminAddAction']);
Router::post('/admin/add/', [new \ES\Controller\AdminController(), 'adminAddItem']);