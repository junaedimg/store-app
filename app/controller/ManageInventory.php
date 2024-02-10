<?php

namespace app\controller;

use app\core\Controller;

class ManageInventory extends Controller
{
    function index($data)
    {
        $this->getView("../view/manage-inventory/index", $data);
    }
}
