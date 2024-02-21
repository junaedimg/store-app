<?php

namespace app\core;

use app\config\config;
use Error;
use PDO;
use PDOException;

class Database
{
    private $conn;
    private $connPdo;
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
    public function read(string $table, $mode = '1', string $cond = "")
    {
        $res = $this->conn->query("SELECT * FROM $table $cond");
        $data = $res->fetchAll(PDO::FETCH_ASSOC);
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

    private function getType($value)
    {
        if (is_int($value)) return 'i';
        if (is_double($value)) return 'd';
        if (is_string($value)) return 's';
        if (is_bool($value)) return 'b';
        if (is_null($value)) return 's'; // Assuming null as string
        return ''; // Unknown type
    }
}
