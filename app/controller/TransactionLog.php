<?php

namespace app\controller;

use app\core\Controller;

class TransactionLog extends Controller
{
    function index($data)
    {
        $this->getView("../view/transaction-log/index", $data);
    }
}
