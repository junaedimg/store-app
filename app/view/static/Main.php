<?php
// header("Content-Type: text/html");

use app\config\config;
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STORE APP</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="<?= config::BASEURL ?>/public/assets/css/custom-bootstrap.css">
    <script defer src="<?= config::BASEURL ?>/public/assets/js/vendor/bootstrap.js"></script>
    <!-- font& Icon -->
    <script src="https://kit.fontawesome.com/1b3a0a4af2.js" crossorigin="anonymous"></script>
    <!-- Jquery -->
    <script src="<?= config::BASEURL ?>/public/assets/js/vendor/jquery-3.7.1.js"></script>
    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- MAIN -->
    <script defer type="module" src="<?= config::BASEURL ?>/public/assets/js/main.js"></script>
    <!--  -->
    <link href="https://cdn.datatables.net/v/dt/dt-2.0.0/datatables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/v/dt/dt-2.0.0/datatables.min.js"></script>
</head>

<body>
    <div class="container-fluid p-0  min-vh-100" id="main-page">
        <div class="d-flex ">
            <div class="container w-auto p-0 ">
                <!-- NAVIGATION -->
                <nav class="p-3 h-100 min-vh-100">
                    <div class="container mb-4">
                        <span class="">
                            <h1 class="text-nowrap">App Store</h1>
                        </span>
                    </div>
                    <ul class="link p-0">
                        <span class="nav-selected rounded-2"> </span>
                        <li class="list-unstyled sub-nav">
                            <span>Management</span>
                        </li>
                        <li class="list-unstyled rounded-2 active-nav">
                            <a href="/Dashboard/index" class="text-nowrap">
                                <div class="logo"><i class="fa-solid fa-chart-line"></i></div>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="list-unstyled rounded-2">
                            <a href="/Purchase/index" class="text-nowrap">
                                <div class="logo"><i class="fa-solid fa-cart-shopping"></i></div>
                                <span>Purchase</span>
                            </a>
                        </li>
                        <li class="list-unstyled rounded-2">
                            <a href="/transaction-log/index" class="text-nowrap">
                                <div class="logo"><i class="fa-solid fa-book"></i></div>
                                <span>Transaction Log</span>
                            </a>
                        </li>
                        <li class="list-unstyled rounded-2">
                            <a href="/manage-inventory/index" class="text-nowrap">
                                <div class="logo"><i class="fa-solid fa-boxes-stacked"></i></div>
                                <span>Manage Inventory</span>
                            </a>
                        </li>
                        <li class="list-unstyled rounded-2">
                            <a href="/Chart/index" class="text-nowrap">
                                <div class="logo"><i class="fa-solid fa-chart-pie"></i></div>
                                <span>Chart</span>
                            </a>
                        </li>
                        <li class="list-unstyled sub-nav">
                            <span>Admin</span>
                        </li>
                        <li class="list-unstyled rounded-2">
                            <a href="/users/index" class="text-nowrap">
                                <div class="logo"><i class="fa-solid fa-user"></i></div>
                                <span>Users</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- END NAVIGATION -->
            </div>
            <div class="container-fluid p-0 d-flex flex-column min-vh-100">
                <!-- HEADER -->
                <header class="py-2 px-3 d-flex justify-content-between">
                    <h1 id="nav-title" class="m-0">Dashboard</h1>
                    <div class="option d-flex">
                        <button id="btn-theme" class="btn btn-primary btn-custom shadow ">Toggle Mode</button>
                        <div class="account p-2 ms-2 list-unstyled rounded-2">
                            <div class="user">
                                <div class="user-info">
                                    <span class="name">Junaedi M G</span>
                                    <span class="name">Admin</span>
                                </div>
                                <a href="" class="text-nowrap logout">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                            <div class="image-user"><img src="" alt=""></div>
                        </div>
                    </div>
                </header>
                <!-- END HEADER -->
                <!-- MODAL FOR ALL -->
                <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            sdfsdf
                        </div>
                    </div>
                    <!-- TEMPLATE BUTTON -->
                    <!-- <button type="buton" class="btn btn-primary" data-bs-target="#modal" data-bs-toggle="modal">Open first modal</button> -->
                </div>
                <!-- END MODAL -->
                <!-- MAIN -->
                <main class="flex-grow-1 ms-2 mt-2 p-2 rounded-3 h-100 pb-5">
                    <?php
                    // require "app/view/manage-inventory/index.php";
                    // persiapkan curl
                    $ch = curl_init();
                    // set url 
                    curl_setopt($ch, CURLOPT_URL, "localhost/store-app/manage-inventory/index");
                    // return the transfer as a string 
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    // $output contains the output string 
                    $output = curl_exec($ch);
                    // tutup curl 
                    curl_close($ch);
                    // menampilkan hasil curl
                    echo $output;
                    ?>
                </main>
                <!-- END MAIN -->
            </div>
        </div>
    </div>
</body>

</html>