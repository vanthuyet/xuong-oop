<?php 

session_start();    

require_once './vendor/autoload.php';
require_once './helper.php';


use Admin\Xuongoop\Commons\Helper;
Dotenv\Dotenv::createImmutable(__DIR__)->load();

require_once __DIR__.'./routes/index.php';

