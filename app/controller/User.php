<?php

namespace app\controller;

use app\core\Controller;

class User extends Controller
{
    // Metode untuk menampilkan halaman index
    function index($data)
    {
        $userData = $this->getModel("UserModel")->getUsers();
        $roleData = $this->getModel("UserModel")->getRole();
        $data = ['user_data' => $userData, 'role_data' => $roleData];
        $this->getView("../view/User/index", $data);
    }

    // Metode untuk logout
    function logout()
    {
        // Mulai session
        session_start();

        // Hapus semua variabel session
        session_unset();

        // Hapus session data dari penyimpanan
        session_destroy();

        // Redirect ke halaman login atau halaman lain yang diinginkan setelah logout
        header("Location: /store-app/login"); // Ganti dengan URL halaman login atau halaman lain yang diinginkan
        exit();
    }

    function addUserPage()
    {
        $role = $this->getModel("UserModel")->getRole();
        $this->getView("user/addUserView", $role);
    }

    function addUserData($data)
    {
        $this->getModel("UserModel")->addUserData($data);
    }
    function deleteUserData($data)
    {
        $this->getModel("userModel")->deleteUserData($data);
    }

    function editUserPage($data)
    {
        $dataRole = $this->getModel("UserModel")->getRole();
        $userData = $this->getModel("UserModel")->getSpecificUserData($data)[0];
        $this->getView("user/editUserView", ["data_user" => $userData, "data_role" =>  $dataRole]);
    }

    function editUserData($data)
    {
        $this->getModel("userModel")->editUserData($data);
    }
}
