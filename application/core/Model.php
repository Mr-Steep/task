<?php

class Model
{
    static function init($NameModel)
    {
        require_once __DIR__ . "./../models/$NameModel.php";
        return new $NameModel();
    }
}
