<?php

namespace app\controller;

use app\core\Controller;

class User extends Controller
{
    function index($data)
    {
        $this->getView("../view/User/index", $data);
    }
}
