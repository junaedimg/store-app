<?php

namespace app\controller;

use app\core\Controller;

class Purchase extends Controller
{
    function index($data)
    {
        $this->getView("../view/Purchase/index", $data);
    }
}
