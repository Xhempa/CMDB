<?php

require_once __DIR__ . "/../controllers/AuthController.php";

$controller = new AuthController();

$accion = $_GET["action"] ?? "";

switch($accion)
{

    case "login":

        $controller->login();

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