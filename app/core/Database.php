<?php

namespace app\core;

use app\config\config;
use Error;
use PDO;
use PDOException;

class Database
{
    public $conn;
    // private $connPdo;
    function __construct()
    {
        $dsn = "mysql:host=" . config::HOSTNAME . ";dbname=" . config::DATABASE_NAME;
        $this->conn  = new PDO($dsn, config::DATABASE_USERNAME, config::DATABSE_PASSWORD);
    }

    private function query($query)
    {
        return $this->conn->query($query);
    }

    // read data
    public function read(string $table, string $mode = '1', string $cond = "")
    {
        $query = "SELECT * FROM $table $cond";
        // Persiapkan statement
        $stmt = $this->conn->prepare($query);
        // Eksekusi statement
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // server_side / client_side
        switch ($mode) {
            case '1':
                return $data;
                break;
            case '2':
                header('Content-Type: application/json');
                echo json_encode($data);
                break;
        }
    }
    // // read data
    // public function read(string $table, string $mode = '1', string $cond = "", array $params = [])
    // {
    //     $query = "SELECT * FROM $table $cond";
    //     // Persiapkan statement
    //     $stmt = $this->conn->prepare($query);
    //     // Bind parameter jika ada
    //     foreach ($params as $key => $value) {
    //         $stmt->bindParam(":$key", $value);
    //     }
    //     // Eksekusi statement
    //     $stmt->execute();
    //     $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //     // server_side / client_side
    //     switch ($mode) {
    //         case '1':
    //             return $data;
    //             break;
    //         case '2':
    //             header('Content-Type: application/json');
    //             echo json_encode($data);
    //             break;
    //     }
    // }


    public function customQuery(string $quer, string $method)
    {
        $res = $this->conn->query($quer);
        if ($method === "SELECT") {
            $data = $res->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } elseif ($method === "INSERT" || $method === "UPDATE" || $method === "DELETE") {
            // Jika method adalah INSERT, UPDATE, atau DELETE, kembalikan jumlah baris yang terpengaruh
            $res->closeCursor();
            // Sekarang Anda dapat menjalankan pernyataan SQL tambahan
            $result = $this->conn->query("SELECT @result_message")->fetchColumn();
            if ($result == true) {
                $response = [
                    'status' => 'success',
                    'message' => 'Data berhasil diperbarui'
                ];
                header('Content-Type: application/json');
                echo json_encode($response);
            }
        } else {
            // Jika method tidak valid, kembalikan null atau lakukan tindakan lain sesuai kebutuhan
            return null;
        }
    }

    // create data
    public function create(string $table, array $data)
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $stmt = "INSERT INTO $table ($columns) VALUES ($placeholders)";

        try {
            $stmt = $this->conn->prepare($stmt);
            if ($stmt->execute($data)) {
                $response = [
                    'status' => 'success',
                    'message' => 'Data berhasil diperbarui'
                ];
            }
        } catch (PDOException $e) {
            echo $e;
            $response = [
                'status' => 'error',
                'message' => 'Gagal memperbarui data'
            ];
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    // update
    public function update($table, $data, $primaryK)
    {
        $setClause = '';
        foreach ($data as $key => $value) {
            $setClause .= "$key = :$key, "; // Membentuk bagian SET dalam query
        }
        $setClause = rtrim($setClause, ', '); // Menghapus koma ekstra di akhir string

        // Contoh penggunaan WHERE clause: diasumsikan Anda memiliki sebuah kunci unik untuk row yang ingin diupdate
        $whereClause = 'WHERE ' . array_key_first($primaryK) . '= :' . array_key_first($primaryK); // Ganti dengan kunci unik yang sesuai dengan tabel Anda
        $query = "UPDATE $table SET $setClause $whereClause";
        try {
            $stmt = $this->conn->prepare($query);
            // Bind parameter untuk setiap placeholder
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            // Bind parameter untuk WHERE clause jika diperlukan
            // Misalnya, jika menggunakan WHERE clause untuk id, lalu Anda memiliki data id di $data juga
            // Anda bisa mengikatnya seperti ini:
            $stmt->bindValue(":" . array_key_first($primaryK), reset($primaryK));

            if ($stmt->execute()) {
                $response = [
                    'status' => 'success',
                    'message' => 'Data berhasil diperbarui'
                ];
            }
        } catch (PDOException $e) {
            echo "Gagal melakukan update: " . $e->getMessage() . "\n\n";
            $response = [
                'status' => 'error',
                'message' => 'Gagal memperbarui data'
            ];
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function delete($table, array $data)
    {
        $key = array_key_first($data);
        $value = reset($data);
        if ($this->query("DELETE FROM $table WHERE $key = $value")) {
            // Jika berhasil, kirim respons sukses
            $response = [
                'status' => 'success',
                'message' => 'Data berhasil diperbarui'
            ];
        } else {
            // Jika gagal, kirim respons error
            $response = [
                'status' => 'error',
                'message' => 'Gagal memperbarui data'
            ];
        }
        // Keluarkan respons sebagai JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
