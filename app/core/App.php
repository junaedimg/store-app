<?php

namespace app\core;

use  app\controller\Main;

class App
{
    // set of classes
    private $controller = "main", $method = "index", $params = [];

    function __construct()
    {
        echo "<h1>APP</h1>";
        // segment settings to redirect (class, method, parameters)
        if (isset($_GET['path'])) {
            $urlSegments =  $this->parseUrl();
            $this->controller = $urlSegments['controller'];

            if (!empty($urlSegments['method'])) {
                
                $this->method = $urlSegments['method'];
                if (!empty($urlSegments['params'])) {
                    $this->params = $urlSegments['prams'];
                }
            }
        }
        // var_dump($urlSegments);
        $this->controller = new Main();
        call_user_func([$this->controller, $this->method], $this->params);
    }

    // accepts url input
    function parseUrl()
    {
        if (isset($_GET['path'])) {
            $url = rtrim($_GET['path'], "/");
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode("/", $url);
            $urlSegments = array(
                "controller" => !empty($url) ? array_splice($url, 0, 1)[0] : null,
                "method" => !empty($url) ? array_splice($url, 0, 1)[0] : null,
                "params" => array_values($url)
            );
            return $urlSegments;
        }
    }
}
