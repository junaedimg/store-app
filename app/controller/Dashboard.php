<?php

namespace app\controller;

use app\core\Controller;

class Dashboard extends Controller
{
    function index($data)
    {
        $this->getView("../view/Dashboard/index", $data);
    }
}
