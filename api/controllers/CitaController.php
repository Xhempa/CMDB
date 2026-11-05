<?php

require_once __DIR__ . "/../models/Cita.php";

class CitaController
{

    private $cita;

    public function __construct()
    {
        $this->cita = new Cita();
    }

    private function obtenerDatos()
    {

        $json = json_decode(file_get_contents("php://input"), true);

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

                "data"=>$this->cita->listar()

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

        $d = $this->obtenerDatos();

        if(

            empty($d["cliente"]) ||

            empty($d["fecha"]) ||

            empty($d["descripcion"])

        ){

            http_response_code(400);

            echo json_encode([

                "success"=>false,

                "message"=>"Todos los campos son obligatorios."

            ]);

            return;

        }

        $cliente_id = $d["cliente_id"] ?? null;

        if(

            $this->cita->registrar(

                $d["cliente"],

                $d["fecha"],

                $d["descripcion"],

                $cliente_id

            )

        ){

            echo json_encode([

                "success"=>true,

                "message"=>"Cita registrada correctamente."

            ]);

        }

    }

    public function actualizar()
    {

        $d = $this->obtenerDatos();

        $cliente_id = $d["cliente_id"] ?? null;

        if(

            $this->cita->actualizar(

                $d["id"],

                $d["cliente"],

                $d["fecha"],

                $d["descripcion"],

                $cliente_id

            )

        ){

            echo json_encode([

                "success"=>true,

                "message"=>"Cita actualizada."

            ]);

        }

    }

    public function eliminar()
    {

        $d = $this->obtenerDatos();

        if(

            $this->cita->eliminar(

                $d["id"]

            )

        ){

            echo json_encode([

                "success"=>true,

                "message"=>"Cita eliminada."

            ]);

        }

    }

}

?>