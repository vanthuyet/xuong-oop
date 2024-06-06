<?php

use Admin\Xuongoop\Controllers\Client\AboutController;
use Admin\Xuongoop\Controllers\Client\ContactController;
use Admin\Xuongoop\Controllers\Client\HomeController;
use Admin\Xuongoop\Controllers\Client\LoginController;
use Admin\Xuongoop\Controllers\Client\ProductController;



// trang web có các trang
// trang chủ
// giới thiệu
// sản phẩm
// chi tiết sp
// liên hệ


// để định nghĩa dc , đầu tiên phải tạo controller
//tiep tuc khai bao fun ttuongw unsg ddeer xu ly
//dinh nghia dg dan

$router->get('/',               HomeController::class     . '@index');
$router->get('/about',          AboutController::class    . '@index');

$router->get('/contact',        ContactController::class  . '@index');
$router->post('/contact/store', HomeController::class     . '@store');

$router->get('/product',        ProductController::class  . '@index');
$router->get('/product/{id}',   ProductController::class  . '@detail');

$router->get('/login',          LoginController::class    . '@showFormLogin');
$router->post('/handle-login',  LoginController::class    . '@login');
$router->get('/logout',        LoginController::class    . '@logout');

