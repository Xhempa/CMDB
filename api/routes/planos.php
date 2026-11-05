<?php

require_once __DIR__ . "/../controllers/PlanoController.php";

$controller = new PlanoController();

$accion = $_GET["action"] ?? "";

switch($accion)
{

    case "listar":

        $controller->listar();

        break;

    case "registrar":

        $controller->registrar();

        break;

    case "actualizar":

        $controller->actualizar();

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