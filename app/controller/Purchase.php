<?php

namespace app\controller;

use app\core\Controller;

class Purchase extends Controller
{
    function index($data)
    {
        $dataStock = $this->getModel("PurchaseModel")->getAvailableStock();
        $dataProduct = $this->getModel("PurchaseModel")->getProductData();
        $dataUnit = $this->getModel("PurchaseModel")->getUnit();
        $this->getView(
            "../view/Purchase/index",
            ["data_stock" => $dataStock, "data_unit" =>  $dataUnit, "data_product" => $dataProduct]
        );
    }

    function addTransaction($data)
    {
        $idUser = $this->getModel("PurchaseModel")->getIdBasedOnUsername($_SESSION['user'])[0]['id_user'];
        $data = ["data_transaction" => $data['data_rows'], "id_user" =>  $idUser];
        $this->getModel("PurchaseModel")->addTransactionData($data);
    }
}
