<?php

use app\config\config;
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme=dark>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STORE APP</title>
    <link rel="stylesheet" href="<?= config::BASEURL ?>store-app/public/assets/css/custom bootstrap.css">
</head>

<body>
    <div class="container-fluid vh-100 p-0" id="main-page">
        <div class="d-flex h-100">
            <div class="container w-auto p-0">
                <!-- NAVIGATION -->
                <nav class="h-100 p-2">
                    <h1 class="">Nav</h1>
                    <ul>
                        <li><a href="" class="text-nowrap">Dashboard</a></li>
                        <li><a href="" class="text-nowrap">Purchase</a></li>
                        <li><a href="" class="text-nowrap">Transaction Log</a></li>
                        <li><a href="" class="text-nowrap">Manage Inventory</a></li>
                        <li><a href="" class="text-nowrap">Chart</a></li>
                    </ul>
                </nav>
            </div>
            <div class="container-fluid p-0 d-flex flex-column">
                <!-- HEADER -->
                <header class="py-2 px-3 d-flex justify-content-between">
                    <h1 class="m-0">Header</h1>
                    <button class="btn btn-primary btn-custom shadow " id="btnSwitch">Toggle Mode</button>
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