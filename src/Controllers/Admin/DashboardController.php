<?php

namespace Admin\Xuongoop\Controllers\Admin;

use Admin\Xuongoop\Commons\Controller;

class DashboardController extends Controller
{
    public function dashboard(){
        $this->renderViewAdmin(__FUNCTION__);
    }
}