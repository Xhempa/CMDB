<?php

/*
|--------------------------------------------------------------------------
| Rutas API Clientes
|--------------------------------------------------------------------------
*/

require_once __DIR__ . "/../controllers/ClienteController.php";

header("Content-Type: application/json");

$controller = new ClienteController();

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

        http_response_code(404);

        echo json_encode([

            "success"=>false,

            "message"=>"Endpoint no encontrado."

        ]);

        break;

}

?>