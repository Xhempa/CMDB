<?php
    
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/*
|--------------------------------------------------------------------------
| API CMDB
|--------------------------------------------------------------------------
| Punto de entrada principal de todos los servicios web.
|--------------------------------------------------------------------------
*/

header("Content-Type: application/json");

$module = $_GET["module"] ?? "";

switch($module)
{

    case "clientes":

        require_once __DIR__ . "/routes/clientes.php";

        break;

    case "citas":

        require_once __DIR__ . "/routes/citas.php";

        break;

    case "pagos":

        require_once __DIR__ . "/routes/pagos.php";

        break;

    case "planos":

        require_once __DIR__ . "/routes/planos.php";

        break;

    case "historial":

        require_once __DIR__ . "/routes/historial.php";

        break;

    case "login":

        require_once __DIR__ . "/routes/login.php";

        break;

    default:

        http_response_code(404);

        echo json_encode([

            "success"=>false,

            "message"=>"Módulo no encontrado."

        ]);

        break;

}

?>

            "message" => "Módulo no encontrado."

        ]);

        break;

}

?>