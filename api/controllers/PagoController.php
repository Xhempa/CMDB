<?php

require_once __DIR__ . "/../models/Pago.php";

class PagoController
{

    private $pago;

    public function __construct()
    {
        $this->pago = new Pago();
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

                "data"=>$this->pago->listar()

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

            $this->pago->registrar(

                $d["cliente"],

                $d["valor"],

                $d["fecha"],

                $d["cliente_id"] ?? null

            )

        ){

            echo json_encode([

                "success"=>true,

                "message"=>"Pago registrado correctamente."

            ]);

        }

    }

    public function actualizar()
    {

        $d=$this->obtenerDatos();

        if(

            $this->pago->actualizar(

                $d["id"],

                $d["cliente"],

                $d["valor"],

                $d["fecha"],

                $d["cliente_id"] ?? null

            )

        ){

            echo json_encode([

                "success"=>true,

                "message"=>"Pago actualizado."

            ]);

        }

    }

    public function eliminar()
    {

        $d=$this->obtenerDatos();

        if(

            $this->pago->eliminar(

                $d["id"]

            )

        ){

            echo json_encode([

                "success"=>true,

                "message"=>"Pago eliminado."

            ]);

        }

    }

}

?>