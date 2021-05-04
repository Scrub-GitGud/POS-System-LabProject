<?php

require_once '../vendor/autoload.php';
include_once "../Router.php";
include_once "../Database.php";
include_once "../Controllers/StoreCtrl.php";
include_once "../Controllers/ProductCtrl.php";
include_once "../Controllers/SupplierCtrl.php";
include_once "../Controllers/SaleCtrl.php";
include_once "../Controllers/ReportCtrl.php";
use app\Controllers\StoreCtrl;
use app\Controllers\ProductCtrl;
use app\Controllers\SupplierCtrl;
use app\Controllers\SaleCtrl;
use app\Controllers\ReportCtrl;
use app\Database;
use app\Router;

$database = new Database();
$router = new Router($database);

$router->get('/', function() {
    header('Location: /store');
    exit;
});

$router->get('/store', [StoreCtrl::class, 'index']);
$router->get('/store/active', [StoreCtrl::class, 'setActive']);
$router->get('/store/inactive', [StoreCtrl::class, 'setInactive']);
$router->post('/store/create', [StoreCtrl::class, 'create']);
$router->get('/store/get-info', [StoreCtrl::class, 'getInfo']);
$router->post('/store/update', [StoreCtrl::class, 'update']);
$router->get('/store/delete', [StoreCtrl::class, 'delete']);

$router->get('/product', [ProductCtrl::class, 'index']);
$router->get('/product/get-info', [ProductCtrl::class, 'getInfo']);
$router->post('/product/create', [ProductCtrl::class, 'create']);
$router->post('/product/update', [ProductCtrl::class, 'update']);
$router->get('/product/delete', [ProductCtrl::class, 'delete']);
$router->post('/product/purchase', [ProductCtrl::class, 'purchase']);
$router->get('/product/search', [ProductCtrl::class, 'search']);
$router->get('/product/add_to_list', [ProductCtrl::class, 'addToList']);

$router->post('/supplier/create', [SupplierCtrl::class, 'create']);

$router->get('/sale', [SaleCtrl::class, 'index']);
$router->post('/sale/create', [SaleCtrl::class, 'create']);

$router->get('/report', [ReportCtrl::class, 'index']);


$router->resolve();