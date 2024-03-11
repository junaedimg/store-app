<?php

namespace app\model;

use app\core\Database;
use app\core\Validator;
use app\config\config;
use PDOException;


class PurchaseModel extends Validator
{

    private $db;

    function __construct()
    {
        $this->db = new Database;
    }

    function getProductData()
    {
        return $this->db->read("product");
    }

    function getAvailableStock()
    {
        return $this->db->read("stock", "1", "where qty > 0");
    }

    function getUnit()
    {
        return $this->db->read("unit");
    }

    function getIdBasedOnUsername($username)
    {
        return $this->db->read("user", 1, 'where username = ' . "'$username'");
    }

    function addTransactionData($data)
    {
        // var_dump($data);
        date_default_timezone_set(config::ZONA);
        $date = date("Y-m-d H:i:s");
        $idUser = $data['id_user'];
        $dataTransaction = $data['data_transaction'];
        // var_dump($dataTransaction);
        try {
            // Mulai transaksi
            $this->db->conn->beginTransaction();
            // Eksekusi operasi pertama: masukkan data ke tabel induk
            $stmt1 = $this->db->conn->prepare("INSERT INTO transaction (id_user, date) VALUES (:value1, :value2)");
            $stmt1->bindValue(':value1', $idUser);
            $stmt1->bindValue(':value2', $date);
            $stmt1->execute();
            $parentId = $this->db->conn->lastInsertId();
            // reduce stock based on the number of transactions
            foreach ($dataTransaction as $value) {
                // update stock
                $stock = $this->db->read("stock", "1", "where no_product =" . $value['no_product'])[0];
                $pkStock = $stock['no_stock'];
                $qtyNow = $stock['qty'] - $value['qty'];
                if ($value['qty'] > $stock['qty']) {
                    throw new PDOException("Jumlah tidak sesuai");
                }
                // $this->db->update("stock", ["qty" => $qtyNow], ['no_stock' => $pkStock]);
                $stockNow =  ["qty" => $qtyNow, 'no_stock' => $pkStock];
                $stmt1 = $this->db->conn->prepare("UPDATE stock SET qty = :qty  WHERE no_stock = :no_stock;");
                $stmt1->execute($stockNow);
                // add data transaction
                $price = $this->db->read("product", "1", "where no_product = " . $value['no_product'])[0]['price'];
                // $this->db->create("transaction_details", ["no_transaction_details" => $parentId, "no_product" => $value['no_product'], "amount" => $value['qty'], "price" => $price]);
                $transactionRow = array("no_transaction" => $parentId, "no_product" => $value['no_product'], 'qty' => $value['qty'], 'price' => $price);
                $stmt1 = $this->db->conn->prepare("INSERT INTO transaction_details VALUES( :no_transaction, :no_product, :qty,:price)");
                $stmt1->execute($transactionRow);
            }
            // Commit transaksi jika semua operasi berhasil
            $this->db->conn->commit();

            $response = [
                'status' => 'success',
                'message' => 'Transaction berhasil'
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
        } catch (PDOException $e) {
            // Rollback transaksi jika terjadi kesalahan
            $this->db->conn->rollback();
            echo "Terjadi kesalahan: " . $e->getMessage();
        }
    }
}
