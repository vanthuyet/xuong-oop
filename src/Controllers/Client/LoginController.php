<?php

namespace Admin\Xuongoop\Controllers\Client;

use Admin\Xuongoop\Commons\Controller;
use Admin\Xuongoop\Models\Users;
use Exception;
use Throwable;

class LoginController extends Controller
{
    private Users $user;

    public function __construct()
    {
        $this->user = new Users();
    }
    public function showFormLogin()
    {
        auth_check();
        $this->renderViewClient('login',);
        
    }

    public function login(){
        auth_check();

        try{
        $user = $this->user->findByEmail($_POST['email']);
        if(empty($user)){
            throw new Exception('Khong ton tai email: '. $_POST['email']);
        }

        $flag = password_verify($_POST['password'], $user['password']);
        if($flag){
            $_SESSION['user'] = $user;
            header('Location: '. url(''));
            exit;
        }

        throw new Exception('Password khong dung');

        }catch( Throwable $th) {
            $_SESSION['errors'] = $th->getMessage();

            header('Location: ' . url('login'));
            exit;
        }
    } 

    public function logout(){

        unset($_SESSION['user']);
        header("Location: ". url(''));
        exit;

    }
}
