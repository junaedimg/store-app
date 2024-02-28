<?php

require "vendor/autoload.php";

new app\core\Middleware();
new app\core\App();

// used temporarily for development
function ppp($data)
{
    echo "<br>";
    var_dump($data);
    echo "<br>";
}
function pp($data)
{
    echo "<br>";
    print_r($data);
    echo "<br>";
}
