<?php


namespace app\core;

class Controller
{
    static function getView(string $view, array $data = null)
    {
        require "app/view/" . $view . ".php";
    }

    static function getModel(string $model, $data = null)
    {
        require "app/model/" . $model . ".php";
    }
}
