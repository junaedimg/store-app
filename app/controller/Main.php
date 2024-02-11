<?php

namespace app\controller;

use app\core\Controller;

class Main extends Controller
{
    function index($data)
    {
        $this->getView("../view/static/main", $data);
    }
}
