<?php

class Controller
{

    static function init($NameController, $model)
    {
        require_once __DIR__ . "./../controller/$NameController.php";
        return new $NameController($model);
    }
}
