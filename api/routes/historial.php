<?php

require_once __DIR__ . "/../controllers/HistorialController.php";

$controller = new HistorialController();

$accion = $_GET["action"] ?? "";

switch($accion)
{

    case "listar":

        $controller->listar();

        break;

    case "registrar":

        $controller->registrar();

        break;

    case "eliminar":

        $controller->eliminar();

        break;

    default:

        header("Content-Type: application/json");

        http_response_code(404);

        echo json_encode([

            "success"=>false,

            "message"=>"Endpoint no encontrado."

        ]);

        break;

}

?>