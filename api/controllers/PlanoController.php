<?php

require_once __DIR__ . "/../models/Plano.php";

class PlanoController
{

    private $plano;

    public function __construct()
    {
        $this->plano = new Plano();
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

                "data"=>$this->plano->listar()

            ]);

        }catch(Exception $e){

            echo json_encode([

                "success"=>false,

                "message"=>$e->getMessage()

            ]);

        }

    }

    public function registrar()
    {

        $d=$this->obtenerDatos();

        if(

            $this->plano->registrar(

                $d["nombre"],

                $d["tipo"],

                $d["descripcion"],

                $d["cliente_id"] ?? null

            )

        ){

            echo json_encode([

                "success"=>true,

                "message"=>"Plano registrado correctamente."

            ]);

        }

    }

    public function actualizar()
    {

        $d=$this->obtenerDatos();

        if(

            $this->plano->actualizar(

                $d["id"],

                $d["nombre"],

                $d["tipo"],

                $d["descripcion"],

                $d["cliente_id"] ?? null

            )

        ){

            echo json_encode([

                "success"=>true,

                "message"=>"Plano actualizado."

            ]);

        }

    }

    public function eliminar()
    {

        $d=$this->obtenerDatos();

        if(

            $this->plano->eliminar($d["id"])

        ){

            echo json_encode([

                "success"=>true,

                "message"=>"Plano eliminado."

            ]);

        }

    }

}

?>