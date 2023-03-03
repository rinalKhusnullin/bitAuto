<?php

use ES\Routing\Router;

Router::get('/', [new \ES\Controller\Public\IndexController(), 'indexAction']);

Router::get('/login/', [new \ES\Controller\LoginController(), 'getLoginAction']);
Router::post('/login/', [new \ES\Controller\LoginController(), 'getLoginAction']);

Router::get('/logout/', [new \ES\Controller\LogoutController(), 'LogoutAction']);

Router::get('/product/:id/', [new \ES\Controller\Public\ProductController(), 'getDetailAction']);
Router::post('/product/:id/', [new \ES\Controller\Public\ProductController(), 'postDetailAction']);

Router::get('/contacts/', [new \ES\Controller\Public\ContactsController(), 'getContactsAction']);

Router::get('/error/', [new \ES\Controller\Public\ErrorController(), 'getSystemErrorAction']);
Router::get('/500/', [new \ES\Controller\Public\ErrorController(), 'getSystemErrorAction']);

Router::get('/success/', [new \ES\Controller\Public\FormController(),'successAction']);

Router::get('/failed/', [new \ES\Controller\Public\FormController(),'failedAction']);

Router::get('/admin/', [new \ES\Controller\Admin\AdminController(), 'indexAction']);
Router::get('/admin/products/', [new \ES\Controller\Admin\ProductController(), 'indexAction']);
Router::get('/admin/orders/', [new \ES\Controller\Admin\OrderController(), 'indexAction']);
Router::get('/admin/users/', [new \ES\Controller\Admin\UserController(), 'indexAction']);
Router::get('/admin/brands/', [new \ES\Controller\Admin\BrandController(), 'indexAction']);
Router::get('/admin/carcases/', [new \ES\Controller\Admin\CarcaseController(), 'indexAction']);
Router::get('/admin/transmissions/', [new \ES\Controller\Admin\TransmissionController(), 'indexAction']);

Router::get('/admin/edit/products/:id/', [new \ES\Controller\Admin\ProductController(), 'editAction']);
Router::get('/admin/edit/orders/:id/', [new \ES\Controller\Admin\OrderController(), 'editAction']);
Router::get('/admin/edit/users/:id/', [new \ES\Controller\Admin\UserController(), 'editAction']);
Router::get('/admin/edit/brands/:id/', [new \ES\Controller\Admin\BrandController(), 'editAction']);
Router::get('/admin/edit/carcases/:id/', [new \ES\Controller\Admin\CarcaseController(), 'editAction']);
Router::get('/admin/edit/transmissions/:id/', [new \ES\Controller\Admin\TransmissionController(), 'editAction']);

Router::post('/admin/edit/products/:id/', [new \ES\Controller\Admin\ProductController(), 'changeItemAction']);
Router::post('/admin/edit/orders/:id/', [new \ES\Controller\Admin\OrderController(), 'changeItemAction']);
Router::post('/admin/edit/users/:id/', [new \ES\Controller\Admin\UserController(), 'changeItemAction']);
Router::post('/admin/edit/brands/:id/', [new \ES\Controller\Admin\BrandController(), 'changeItemAction']);
Router::post('/admin/edit/carcases/:id/', [new \ES\Controller\Admin\CarcaseController(), 'changeItemAction']);
Router::post('/admin/edit/transmissions/:id/', [new \ES\Controller\Admin\TransmissionController(), 'changeItemAction']);

Router::post('/admin/edit/delete/', [new \ES\Controller\Admin\AdminController(), 'deleteAction']);

Router::get('/admin/add/:type/', [new \ES\Controller\Admin\AdminController(), 'addItemAction']);

Router::post('/admin/add/product/', [new \ES\Controller\Admin\ProductController(), 'createItemAction']);
Router::post('/admin/add/order/', [new \ES\Controller\Admin\OrderController(), 'createItemAction']);
Router::post('/admin/add/user/', [new \ES\Controller\Admin\UserController(), 'createItemAction']);
Router::post('/admin/add/brand/', [new \ES\Controller\Admin\BrandController(), 'createItemAction']);
Router::post('/admin/add/carcase/', [new \ES\Controller\Admin\CarcaseController(), 'createItemAction']);
Router::post('/admin/add/transmission/', [new \ES\Controller\Admin\TransmissionController(), 'createItemAction']);

Router::post('/admin/upload-image/', [new \ES\Controller\Admin\ImageController(), 'uploadImagesAction']);

Router::get('/admin/clear/', [new \ES\Controller\Admin\ImageController(), 'clearImagesAction']);