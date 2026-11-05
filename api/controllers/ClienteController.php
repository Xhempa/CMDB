<?php

/*
|--------------------------------------------------------------------------
| ClienteController
|--------------------------------------------------------------------------
| Controlador encargado de administrar las solicitudes del módulo Clientes.
|--------------------------------------------------------------------------
*/

require_once __DIR__ . "/../models/Cliente.php";

class ClienteController
{

    private $cliente;

    public function __construct()
    {
        $this->cliente = new Cliente();
    }

    /*
    |--------------------------------------------------------------------------
    | Obtener datos enviados
    |--------------------------------------------------------------------------
    */

    private function obtenerDatos()
    {

        $json = json_decode(file_get_contents("php://input"), true);

        if (!empty($json)) {

            return $json;

        }

        return $_POST;

    }

    /*
    |--------------------------------------------------------------------------
    | Listar clientes
    |--------------------------------------------------------------------------
    */

    public function listar()
    {

        header("Content-Type: application/json");

        try{

            echo json_encode([

                "success" => true,

                "data" => $this->cliente->listar()

            ]);

        }catch(Exception $e){

            http_response_code(500);

            echo json_encode([

                "success" => false,

                "message" => $e->getMessage()

            ]);

        }

    }

    /*
    |--------------------------------------------------------------------------
    | Registrar cliente
    |--------------------------------------------------------------------------
    */

    public function registrar()
    {

        header("Content-Type: application/json");

        $datos = $this->obtenerDatos();

        if (

            empty($datos["nombre"]) ||

            empty($datos["telefono"]) ||

            empty($datos["correo"])

        ) {

            http_response_code(400);

            echo json_encode([

                "success" => false,

                "message" => "Todos los campos son obligatorios."

            ]);

            return;

        }

        if(

            $this->cliente->registrar(

                trim($datos["nombre"]),

                trim($datos["telefono"]),

                trim($datos["correo"])

            )

        ){

            http_response_code(201);

            echo json_encode([

                "success" => true,

                "message" => "Cliente registrado correctamente."

            ]);

        }else{

            http_response_code(500);

            echo json_encode([

                "success" => false,

                "message" => "No fue posible registrar el cliente."

            ]);

        }

    }

    /*
    |--------------------------------------------------------------------------
    | Actualizar cliente
    |--------------------------------------------------------------------------
    */

    public function actualizar()
    {

        header("Content-Type: application/json");

        $datos = $this->obtenerDatos();

        if (

            empty($datos["id"]) ||

            empty($datos["nombre"]) ||

            empty($datos["telefono"]) ||

            empty($datos["correo"])

        ) {

            http_response_code(400);

            echo json_encode([

                "success" => false,

                "message" => "Todos los campos son obligatorios."

            ]);

            return;

        }

        if(

            $this->cliente->actualizar(

                $datos["id"],

                trim($datos["nombre"]),

                trim($datos["telefono"]),

                trim($datos["correo"])

            )

        ){

            echo json_encode([

                "success" => true,

                "message" => "Cliente actualizado correctamente."

            ]);

        }else{

            http_response_code(500);

            echo json_encode([

                "success" => false,

                "message" => "No fue posible actualizar el cliente."

            ]);

        }

    }

    /*
    |--------------------------------------------------------------------------
    | Eliminar cliente
    |--------------------------------------------------------------------------
    */

    public function eliminar()
    {

        header("Content-Type: application/json");

        $datos = $this->obtenerDatos();

        if (empty($datos["id"])) {

            http_response_code(400);

            echo json_encode([

                "success" => false,

                "message" => "Debe indicar el ID del cliente."

            ]);

            return;

        }

        if(

            $this->cliente->eliminar(

                $datos["id"]

            )

        ){

            echo json_encode([

                "success" => true,

                "message" => "Cliente eliminado correctamente."

            ]);

        }else{

            http_response_code(500);

            echo json_encode([

                "success" => false,

                "message" => "No fue posible eliminar el cliente."

            ]);

        }

    }

}

?>