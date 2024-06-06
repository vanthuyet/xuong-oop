<?php

namespace Admin\Xuongoop\Commons;

use eftec\bladeone\BladeOne;

class Controller
{
    protected function renderViewClient($view, $data =[]){

        $templatePath = __DIR__.'/../Views/Client';
        $compiledPath = __DIR__.'/../Views/Compiles';

        $blade = new BladeOne($templatePath,$compiledPath);

        $name = "Thuyet117";
        

        echo $blade->run($view, $data);
        
    }

    protected function renderViewAdmin($view, $data =[]){

        $templatePath = __DIR__.'/../Views/Admin';
        $compiledPath = __DIR__.'/../Views/Compiles';

        $blade = new BladeOne($templatePath,$compiledPath);

         
        

        echo $blade->run($view, $data);
        
    }
}