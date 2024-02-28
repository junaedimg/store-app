<?php

namespace app\model;

use app\core\Database;
use app\core\Validator;

class UserModel extends validator
{
    private $username;
    private $password;
    private $db;

    function __construct()
    {
        $this->db = new Database();
    }
    // Fungsi untuk melakukan otentikasi pengguna
    public function authenticate(string $username, string $password)
    {
        $isUser = $this->db->read('user', '1', " WHERE username = '$username' AND password = '$password'");
        $isUser = count($isUser) == 1 ? true : false;
        return $isUser;
    }

    function addUserData($data)
    {
        $username = trim($data['username']);
        $password = trim($data['password']);
        $role = trim($data['role']);
        $image = $_FILES['image'];

        // validation
        $username = $this->validateInput($username, "1");
        $password = $this->validateInput($password, "1");
        $role = $this->validateInput($role, "2");
        $image = $this->validateImg($image);
        // var_dump($username, $password, $role, $image);
        if ($username and $password and $role and ($image !== false)) {
            // echo "Data Valid\n---------\n";
            // uploadImage
            $image = ($image != null) ? $this->uploadImg($_FILES['image']) : null;
            $data = [
                "username" => $username,
                "password" => $password,
                "id_role" => $role,
                "img" => $image
            ];
            // insert data to database
            echo $this->db->create("user", $data);
        } else {
            echo "Data Tidak Valid\n---------\n";
            return false;
        }
    }

    public function getRole()
    {
        return $this->db->read("role");
    }

    public function getUsers()
    {
        return $this->db->read("user");
    }
    function deleteUserData($id)
    {
        $this->db->delete("user", $id);
    }
    function getSpecificUserData($cond)
    {
        $cond = "WHERE id_user = " . $cond['id'];
        return $this->db->read("user", "1", $cond);
    }

    function editUserData($data)
    {
        // pp($data);
        $primaryK = ["id_user" => $data['id-user']];
        $username = trim($data['username']);
        $password = trim($data['password']);
        $role = trim($data['role']);
        $image = $_FILES['image'];

        // validation
        $username = $this->validateInput($username, "1");
        $password = $this->validateInput($password, "1");
        $role = $this->validateInput($role, "2");
        $image = $this->validateImg($image);

        if ($username and $password and $role and ($image !== false)) {
            // echo "Data Valid\n---------\n";
            // uploadImage
            if ($image != null) {
                $image = $this->uploadImg($_FILES['image']);
                $data = [
                    "username" => $username,
                    "password" => $password,
                    "id_role" => $role,
                    "img" => $image

                ];
            } else {
                $data = [
                    "username" => $username,
                    "password" => $password,
                    "id_role" => $role
                ];
            }
            // insert data to database
            echo $this->db->update("user", $data, $primaryK);
            // echo "Data Valid\n---------\n";
        } else {
            echo "Data Tidak Valid\n---------\n";
            return false;
        }
    }
}
