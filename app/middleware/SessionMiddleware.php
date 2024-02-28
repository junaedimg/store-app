<?php

namespace app\middleware;

use app\config\config;

session_start();

class SessionMiddleware
{
    public function handle()
    {    
   
        // pp(session_name()  . '=' . session_id());
        $isLogin = $this->checkSession();
        if (!$isLogin) {
            if ($_SERVER['REQUEST_URI'] !== '/store-app/login') {
                header("Location:  /store-app/login");
                exit();
            }
        } else {
            if ($_SERVER['REQUEST_URI'] == '/store-app/login') {
                header("Location:  /store-app ");
                exit();
            }
        }

        return;
    }

    public function checkSession()
    {
        return isset($_SESSION['login']) ? true : false;
    }
}
