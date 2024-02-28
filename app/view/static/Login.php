<?php
// header("Content-Type: text/html");
use app\config\config;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= config::BASEURL ?>/public/assets/css/custom-bootstrap.css">
    <script defer src="<?= config::BASEURL ?>/public/assets/js/vendor/bootstrap.js"></script>
    <title>Document</title>
</head>
<div class="container-fluid vh-100 d-grid justify-content-center align-items-center bg-body-secondary">
    <form method="post" action="" class="form-control d-flex flex-column gap-3 p-5 border-black border-opacity-10 shadow">
        <div class="d-flex justify-content-center">
            <div class="logo mb-3">
                <h1>App Store</h1>
            </div>
        </div>
        <div class="">
            <h4>Login</h4>
            <ul class="list-unstyled p-0 m-0 d-flex gap-3">
                <li>
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control">
                </li>
                <li>
                    <label for="password">Password</label>
                    <input type="text" id="password" name="password" class="form-control">
                </li>
        </div>
        </ul>
        <div class="d-flex flex-column gap-3">
            <div class="remember">
                <label for="rememberme" class="me-2">Remember me</label>
                <input type="checkbox" class="form-check-input">
            </div>
            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
        </div>
    </form>
</div>

<body>

</body>

</html>