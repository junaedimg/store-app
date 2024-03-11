<?php

namespace app\middleware;

use app\model\user;
use app\config\config;
use app\model\UserModel;

class AuthMiddleware
{
    public function handle()
    {
        if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $isValidUser = (new UserModel())->authenticate($username, $password);
            if ($isValidUser) {
                
                $_SESSION['role'] =  (new UserModel())->getUserRole($username);
                $_SESSION['user'] = $username;
                header('location:' . config::BASEURL);
            }
        }
    }
}
