<?php

const PATH_ROOT = __DIR__. '/';

if (!function_exists('asset')) {
    function asset($path) {
        return $_ENV['BASE_URL'] . $path;
    }
}

if (!function_exists('url')) {
    function url($uri = null) {
        return $_ENV['BASE_URL'] . $uri;
    }
}

if (!function_exists('auth_check')) {
    function auth_check() {
        if(isset($_SESSION['user'])){
            
            header('Location: ' .url('admin/'));
            exit;

        }
    }
}

if (!function_exists('is_admin')) {
    function is_admin() {
        return isset($_SESSION['user'] ) && $_SESSION['user']['role'] == 1 ;
        
    }
}



