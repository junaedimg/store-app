<?php

use app\config\config;
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STORE APP</title>
    <link rel="stylesheet" href="<?= config::BASEURL ?>store-app/public/assets/css/custom bootstrap.css">
    <script src="https://kit.fontawesome.com/1b3a0a4af2.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-fluid vh-100 p-0 " id="main-page">
        <div class="d-flex h-100">
            <div class="container w-auto p-0">
                <!-- NAVIGATION -->
                <nav class="h-100 p-3">
                    <div class="container mb-4">
                        <span>
                            <h1 class="text-nowrap">App Store</h1>
                        </span>
                    </div>
                    <ul class="link p-0">
                        <span class=""></span>
                        <li class="p-2 m-2 list-unstyled rounded-2 active">
                            <a href="javascript:void(0)" class="text-nowrap">
                                <div class="logo"><i class="fa-solid fa-chart-line"></i></div>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="p-2 m-2 list-unstyled rounded-2">
                            <a href="javascript:void(0)" class="text-nowrap">
                                <div class="logo"><i class="fa-solid fa-cart-shopping"></i></div>
                                <span>Purchase</span>
                            </a>
                        </li>
                        <li class="p-2 m-2 list-unstyled rounded-2">
                            <a href="javascript:void(0)" class="text-nowrap">
                                <div class="logo"><i class="fa-solid fa-book"></i></div> 
                                <span>Transaction Log</span>
                            </a>
                        </li>
                        <li class="p-2 m-2 list-unstyled rounded-2">
                            <a href="javascript:void(0)" class="text-nowrap">
                                <div class="logo"><i class="fa-solid fa-boxes-stacked"></i></div>
                                <span>Manage Inventory</span>
                            </a>
                        </li>
                        <li class="p-2 m-2 list-unstyled rounded-2">
                            <a href="javascript:void(0)" class="text-nowrap">
                                <div class="logo"><i class="fa-solid fa-chart-pie"></i></div>
                                <span>Chart</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="container-fluid p-0 d-flex flex-column">
                <!-- HEADER -->
                <header class="py-2 px-3 d-flex justify-content-between">
                    <h1 class="m-0 ">Header</h1>
                    <div class="option d-flex">
                        <button class="btn btn-primary btn-custom shadow " id="btnSwitch">Toggle Mode</button>
                        <div class="account p-2 ms-2 list-unstyled rounded-2">
                            <div class="user">
                                <div class="user-info">
                                    <span class="name">Junaedi M G</span>
                                    <span class="name">Admin</span>
                                </div>
                                <a href="javascript:void(0)" class="text-nowrap logout">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                            <div class="image-user"><img src="" alt=""></div>
                        </div>
                    </div>
                </header>
                <!-- MAIN -->
                <main class="flex-grow-1 ms-2 mt-2 p-2 rounded-3">
                    <h1>Main</h1>
                    <p> Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odit asperiores harum aperiam ipsa dolores velit vero consequuntur error architecto debitis doloremque voluptates, fugit alias! Rerum ipsa optio recusandae explicabo odit!</p>
                </main>
            </div>
        </div>
    </div>
</body>
<script>
    document.getElementById('btnSwitch').addEventListener('click', () => {
        if (document.documentElement.getAttribute('data-bs-theme') == 'dark') {
            document.documentElement.setAttribute('data-bs-theme', 'light')
        } else {
            document.documentElement.setAttribute('data-bs-theme', 'dark')
        }
    })
</script>

</html>