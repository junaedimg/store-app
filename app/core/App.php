<?php

namespace app\core;

use app\config\config as config;

class App
{
    // set of classes
    private $controller = "main", $method = "index", $params = [];
    function __construct()
    {
        // segment settings to redirect (class, method, parameters)
        if (isset($_GET['path']) || isset($_POST['path'])) {
            $urlSegments =  $this->parseUrl();
            if (class_exists("app\\controller\\" . $urlSegments['controller'])) {
                $this->controller = $urlSegments['controller'];
                $this->controller = new ("app\\controller\\" . $this->controller);
                if (!empty($urlSegments['method'])) {
                    if (method_exists($this->controller, $urlSegments['method'])) {
                        $this->method = $urlSegments['method'];
                        if (!empty($urlSegments['params'])) {
                            $this->params = $urlSegments['params'];
                        }
                    }
                }
            }
        } else {
            $this->controller = new ("app\\controller\\" . $this->controller);
        }
        call_user_func([$this->controller, $this->method], $this->params);
    }
    // accepts url input
    function parseUrl()
    {

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
