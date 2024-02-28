<?php

namespace app\controller;

use app\core\Controller;

class Login extends Controller
{
    function index()
    {
        $this->getView("../view/static/login");
    }
}
