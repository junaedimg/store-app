<?php

namespace app\model;

use app\core\Database;
use app\core\Validator;

class ManageInventoryModel extends Validator
{
    protected $db;
    function __construct()
    {
        $this->db = new Database;
    }

    function getProductData()
    {
        return $this->db->read("product");
    }

    function getSpecificProductData($cond)
    {
        $cond = " WHERE no_product = " . $cond['id'];
        return $this->db->read("product", "1", $cond);
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
        // $this->db->delete("product", $id);
        $result = $this->db->customQuery("
        CALL delete_product(" . reset($id) . ", @result_message);
        SELECT @result_message AS result_message;
        ", "DELETE");
    }

    function editProductData($data)
    {

        $primaryK = ["no_product" => $data['no-product']];
        $productName = trim($data['product-name']);
        $unit = trim($data['unit']);
        $price = trim($data['price']);
        $image = $_FILES['image'];

        // validation
        $productName = $this->validateInput($productName, "1");
        $unit = $this->validateInput($unit, "2");
        $price = $this->validateInput($price, "2");
        $image = $this->validateImg($image);

        if ($productName and $unit and $price and ($image !== false)) {
            // echo "Data Valid\n---------\n";
            // uploadImage
            if ($image != null) {
                $image = $this->uploadImg($_FILES['image']);
                $data = [
                    "product_name" => $productName,
                    "id_unit" => $unit,
                    "price" => $price,
                    "img" => $image,
                    "product_remove" => 0
                ];
            } else {
                $data = [
                    "product_name" => $productName,
                    "id_unit" => $unit,
                    "price" => $price,
                    "product_remove" => 0
                ];
            }
            // insert data to database
            echo $this->db->update("product", $data, $primaryK);
            // echo "Data Valid\n---------\n";
        } else {
            echo "Data Tidak Valid\n---------\n";
            return false;
        }
    }

    function addStockData($data)
    {
        $noProduct = $data['no-product'];
        $qty = $data['qty'];
        // validation
        $noProduct = $this->validateInput($noProduct, "2");
        $qty = $this->validateInput($qty, "2");
        // check whether stock is available
        $stockProduct = $this->db->read("stock", '1', "where no_product = " . $noProduct);
        $productInStock = count($stockProduct) == 1 ? true : false;
        if ($productInStock) {
            if ($noProduct and $qty) {
                $data = [
                    "qty" => $qty + $stockProduct[0]['qty'],
                ];
                $primaryK = ["no_stock" => $stockProduct[0]['no_stock']];
                echo $this->db->update("stock", $data, $primaryK);
            } else {
                echo "Data Tidak Valid\n---------\n";
                return false;
            }
        } else {
            // create stock of new products
            if ($noProduct and $qty) {
                // echo "Data Valid\n---------\n";
                $data = [
                    "no_product" => $noProduct,
                    "qty" => $qty,
                ];
                // insert data to database
                echo $this->db->create("stock", $data);
            } else {
                echo "Data Tidak Valid\n---------\n";
                return false;
            }
        }
    }
    function deleteStockData($id)
    {
        $this->db->delete("stock", $id);
    }

    function getStockData()
    {
        $query = "SELECT stock.no_stock, stock.qty,  product.product_name, unit.unit_name, product.img, product.price FROM stock LEFT JOIN product ON stock.no_product = product.no_product LEFT JOIN unit ON product.id_unit = unit.id_unit";
        // 
        return $this->db->customQuery($query, "SELECT");
    }

    function editStockData($data)
    {
        $noStock = $data['no-stock'];
        $noProduct = $data['no-product'];
        $qty = $data['qty'];
        // validation
        $noProduct = $this->validateInput($noProduct, "2");
        $qty = $this->validateInput($qty, "2");
        // check whether stock is available
        if ($noProduct and $qty) {
            $data = [
                "qty" => $qty,
            ];
            $primaryK = ["no_stock" => $noStock];
            echo $this->db->update("stock", $data, $primaryK);
        } else {
            echo "Data Tidak Valid\n---------\n";
            return false;
        }
    }

    function getSpecificStockData($cond)
    {
        $cond = "WHERE no_stock = " . $cond['id'];
        return $this->db->read("stock", "1", $cond);
    }
}
