<?php

require_once __DIR__ . "/../models/Usuario.php";

class AuthController
{

    private $usuario;

    public function __construct()
    {
        $this->usuario = new Usuario();
    }

    private function obtenerDatos()
    {

        $json = json_decode(file_get_contents("php://input"),true);

        if(!empty($json)){

            return $json;

        }

        return $_POST;

    }

    public function login()
    {

        header("Content-Type: application/json");

        $d=$this->obtenerDatos();

        if(

            empty($d["usuario"]) ||

            empty($d["password"])

        ){

            http_response_code(400);

            echo json_encode([

                "success"=>false,

                "message"=>"Debe enviar usuario y contraseña."

            ]);

            return;

        }

        $respuesta = $this->usuario->login(

            $d["usuario"],

            $d["password"]

        );

        if($respuesta){

            echo json_encode([

                "success"=>true,

                "usuario"=>$respuesta

            ]);

        }else{

            http_response_code(401);

            echo json_encode([

                "success"=>false,

                "message"=>"Usuario o contraseña incorrectos."

            ]);

        }

    }

}