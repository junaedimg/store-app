<?php

namespace app\controller;

use app\core\Controller;

class Users extends Controller
{
    function index($data)
    {
        $this->getView("../view/Users/index", $data);
    }
}
