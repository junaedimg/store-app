<?php

namespace app\core;

class App
{
    // Set of Classes (Default)
    private $_controller = "main", $_methode = "index", $_params = [];

    // Start App
    function __construct()
    {
        $req = $this->getRequest();
        $this->_controller = new ("app\\controller\\" . $req['controller']);
        call_user_func([$this->_controller, $req['methode']], $req['params']);
    }

    // Accepts Request
    function getRequest()
    {
        // Check if the Data is provided in the $_POST data, otherwise check $_GET data
        $req = isset($_GET['path']) ? $_GET['path'] : "";
        $req = $this->parseRequest($req);
        $this->validateReq($req);

        $req = ["controller" => $this->_controller, "methode" => $this->_methode, "params" => $this->_params];
        return $req;
    }

    // Parse Req into segments (Controller,Method,Params)
    function parseRequest($req)
    {
        // Parse Path
        $req = rtrim(filter_var($req, FILTER_SANITIZE_URL), '/');
        $req = explode("/", $req);
        // Determine Parameters based on the Request Method
        $params = ($_SERVER['REQUEST_METHOD'] === "GET") ? $_GET : (($_SERVER['REQUEST_METHOD'] === "POST") ? $_POST : null);
        unset($params['path']);
        // 
        return [
            "controller" => $req ? array_shift($req) : null,
            "methode" => $req ? array_shift($req) : null,
            "params" => $params
        ];
    }

    // Validate if the Controller and methode is exist 
    function validateReq($url)
    {
        // Validate is the URL valid?
        $urlSegment = $url;
        if ($urlSegment != NULL) {
            // Segment settings to redirect (class, method, parameters)
            $controllerClassName = "app\\controller\\" . $urlSegment['controller'];
            // Check if the contoller  exist?
            if (class_exists($controllerClassName)) {
                // Check if the methode exist?
                if (!empty($urlSegment['methode'])) {
                    if (method_exists($controllerClassName, $urlSegment['methode'])) {
                        // Set Controller, Method and Params, based on Valid Request
                        $this->setRequest($urlSegment);
                    }
                } // If the methode does not exist, use default class (MAIN/index.php)
            } // If the class/controlller does not exist, use default class (MAIN/index.php)
        } // If URL null, use default class (MAIN/index.php)
    }

    // Set valid Request
    function setRequest($urlSegment)
    {
        // if the controller and methode is exist, SET!
        $this->_controller = $urlSegment['controller'];
        $this->_methode = $urlSegment['methode'];
        // the parameter may or may not exist, so it is not mandatory
        $this->_params = $urlSegment['params'] ?? $this->_params;
    }
}
