<?php

namespace app\controller;

use app\config\config;
use app\core\Controller;

class ManageInventory extends Controller
{
    // SELECT stock.no_stock, stock.qty,  product.product_name, unit.unit_name, product.img, product.price FROM stock left join product on stock.no_product = product.no_product left join unit on product.id_unit = unit.id_unit
    function index($data)
    {
        // $dataStock = $this->getModel("ManageInventoryModel")->getStockData();
        $stockData =  $this->getModel("ManageInventoryModel")->getStockData();
        $this->getView("manage-inventory/index", $stockData);
    }
    // PAGE / VIEW
    // --Product
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
        $dataUnit = $this->getModel("ManageInventoryModel")->getUnit();
        $this->getView("manage-inventory/addProductView", $dataUnit);
    }
    function editProductPage($data)
    {
        $dataProduct = $this->getModel("ManageInventoryModel")->getSpecificProductData($data)[0];
        $dataUnit = $this->getModel("ManageInventoryModel")->getUnit();
        $this->getView("manage-inventory/editProductView", ["data_product" => $dataProduct, "data_unit" =>  $dataUnit]);
    }

    // -- Stock
    function addStockPage($data)
    {
        $dataUnit = $this->getModel("ManageInventoryModel")->getUnit();
        $dataProduct = $this->getModel("ManageInventoryModel")->getProductData();
        $data = ['data_unit' => $dataUnit, 'data_product' => $dataProduct];
        $this->getView("manage-inventory/addStockView", $data);
    }
    function editStockPage($data)
    {
        $dataProduct = $this->getModel("ManageInventoryModel")->getProductData();
        $dataStock = $this->getModel("ManageInventoryModel")->getSpecificStockData($data)[0];
        $this->getView("manage-inventory/editStockView", ["data_product" => $dataProduct, "data_stock" =>  $dataStock]);
    }
    // END PAGE / VIEW 
    // 
    // CRUD
    // --Product
    function addProductData($data)
    {
        $this->getModel("ManageInventoryModel")->addProductData($data);
    }

    function deleteProductData($data)
    {
        $this->getModel("ManageInventoryModel")->deleteProductData($data);
    }
    function deleteStockData($data)
    {
        $this->getModel("ManageInventoryModel")->deleteStockData($data);
    }

    function editProductData($data)
    {
        $this->getModel("ManageInventoryModel")->editProductData($data);
    }
    // -- Stock
    function addStockData($data)
    {
        // var_dump($data);
        $this->getModel("ManageInventoryModel")->addStockData($data);
    }
    function editStockData($data)
    {
        $this->getModel("ManageInventoryModel")->editStockData($data);
    }
    // END CRUD
}
