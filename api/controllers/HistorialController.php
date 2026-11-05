<?php

require_once __DIR__ . "/../models/Historial.php";

class HistorialController
{

    private $historial;

    public function __construct()
    {
        $this->historial = new Historial();
    }

    private function obtenerDatos()
    {

        $json = json_decode(file_get_contents("php://input"),true);

        if(!empty($json)){

            return $json;

        }

        return $_POST;

    }

    public function listar()
    {

        header("Content-Type: application/json");

        try{

            echo json_encode([

                "success"=>true,

                "data"=>$this->historial->listar()

            ]);

        }catch(Exception $e){

            http_response_code(500);

            echo json_encode([

                "success"=>false,

                "message"=>$e->getMessage()

            ]);

        }

    }

    public function registrar()
    {

        $d=$this->obtenerDatos();

        if(empty($d["accion"])){

            http_response_code(400);

            echo json_encode([

                "success"=>false,

                "message"=>"La acción es obligatoria."

            ]);

            return;

        }

        if(

            $this->historial->registrar(

                $d["accion"]

            )

        ){

            echo json_encode([

                "success"=>true,

                "message"=>"Registro agregado correctamente."

            ]);

        }

    }

    public function eliminar()
    {

        $d=$this->obtenerDatos();

        if(

            $this->historial->eliminar(

                $d["id"]

            )

        ){

            echo json_encode([

                "success"=>true,

                "message"=>"Registro eliminado."

            ]);

        }

    }

}

?>