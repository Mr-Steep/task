<?
require_once __DIR__ . "/../core/Model.php";
require_once __DIR__ . "/../core/View.php";
require_once __DIR__ . "/../core/Controller.php";

class Route
{
    static function core($Name)
    {
        $model = Model::init("Model$Name");
        $controller = Controller::init("Controller$Name", $model);
        $view = View::init("View$Name", $controller, $model);
        return $view;
    }
}