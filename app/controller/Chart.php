<?php

namespace app\controller;

use app\core\Controller;

class Chart extends Controller
{
    function index($data)
    {
        $this->getView("../view/chart/index", $data);
    }
}
