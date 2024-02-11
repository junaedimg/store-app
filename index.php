<?php

require "vendor/autoload.php";

// Run the Application
new app\core\App();

// used temporarily for development
function ppp($data)
{
    echo "<br>";
    var_dump($data);
    echo "<br>";
}
