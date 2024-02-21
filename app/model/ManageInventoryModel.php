<?php

namespace app\model;

use app\core\Database;
use app\core\Validation;

class ManageInventoryModel extends Validation
{
    protected $db;
    function __construct()
    {
        $this->db = new Database;
    }

    function getProductData()
    {
        // $cond = "ORDER BY no_product ASC LIMIT 20 OFFSET 0";
        return $this->db->read("product");
    }

    function addProductData($data)
    {
        $productName = trim($data['product-name']);
        $unit = trim($data['unit']);
        $price = trim($data['price']);
        $image = $_FILES['image'];

        // validation
        $productName = $this->validateInput($productName, "1");
        $unit = $this->validateInput($unit, "2");
        $price = $this->validateInput($price, "2");
        $image = $this->validateImg($image);
        echo $image;
        if ($productName and $unit and $price and ($image !== false)) {
            // echo "Data Valid\n---------\n";
            // uploadImage
            $image = ($image != null) ? $this->uploadImg($_FILES['image']) : null;
            $data = [
                "product_name" => $productName,
                "id_unit" => $unit,
                "price" => $price,
                "img" => $image,
                "product_remove" => 0
            ];
            // insert data to database
            echo $this->db->create("product", $data);
        } else {
            echo "Data Tidak Valid\n---------\n";
            return false;
        }
    }

    function getUnit()
    {
        return $this->db->read("unit");
    }

    function deleteProductData($id)
    {
        $this->db->delete("product", $id);
    }
}
