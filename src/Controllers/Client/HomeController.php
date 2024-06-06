<?php

namespace Admin\Xuongoop\Controllers\Client;

use Admin\Xuongoop\Commons\Controller;
use Admin\Xuongoop\Commons\Helper;
use Admin\Xuongoop\Models\Users;

class HomeController extends Controller
{
    public function index()
    {
        

        $this->renderViewClient('home');
        
    }
}
