<?php

namespace app\controller;

use app\config\config;
use app\core\Controller;

class ManageInventory extends Controller
{
    function index($data)
    {
        $this->getView("manage-inventory/index");
    }

    function listProductPage()
    {
        $dataProduct = $this->getModel("ManageInventoryModel")->getProductData();
        $dataUnit = $this->getModel("ManageInventoryModel")->getUnit();
        // VIEW
        $dataView = ["data_product" => $dataProduct, "data_unit" => $dataUnit];
        $this->getView("manage-inventory/listProductView", $dataView);
    }

    function addProductPage($data)
    {
        $dataUnit = $this->getModel("ManageInventoryModel")->getUnit();;
        $this->getView("manage-inventory/addProductView", $dataUnit);
    }

    function addProductData($data)
    {
        $this->getModel("ManageInventoryModel")->addProductData($data);
    }

    function deleteProductData($data)
    {
        $this->getModel("ManageInventoryModel")->deleteProductData($data);
    }
}
