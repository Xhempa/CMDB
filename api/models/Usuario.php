<?php

require_once __DIR__ . "/../config/conexion.php";

class Usuario
{

    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar();
    }

    /*
    |--------------------------------------------------------------------------
    | Iniciar sesión
    |--------------------------------------------------------------------------
    */

    public function login($usuario,$password)
    {

        $stmt = $this->conexion->prepare(

            "SELECT *
             FROM usuarios
             WHERE usuario=?"

        );

        $stmt->bind_param("s",$usuario);

        $stmt->execute();

        $resultado = $stmt->get_result();

        if($resultado->num_rows==0){

            return false;

        }

        $usuarioBD = $resultado->fetch_assoc();

        /*
        |--------------------------------------------------
        | Si en tu sistema la contraseña está cifrada:
        |
        | password_verify($password,$usuarioBD["password"])
        |
        | Si está guardada en texto plano:
        */

        if($usuarioBD["password"]==$password){

            unset($usuarioBD["password"]);

            return $usuarioBD;

        }

        return false;

    }

}