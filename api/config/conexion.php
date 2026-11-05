<?php

/*
|--------------------------------------------------------------------------
| Conexión a la base de datos
|--------------------------------------------------------------------------
| Archivo encargado de establecer la conexión con MySQL.
| Será utilizado por todos los modelos de la API.
|--------------------------------------------------------------------------
*/

class Conexion
{

    private static $conexion = null;

    public static function conectar()
    {

        if(self::$conexion == null)
        {

            self::$conexion = new mysqli(

                "sql100.infinityfree.com",

                "if0_41730162",

                "Unr5GwMSgJ",

                "if0_41730162_cmdb"

            );

            if(self::$conexion->connect_error)
            {

                die(json_encode([

                    "success"=>false,

                    "message"=>"Error de conexión.",

                    "error"=>self::$conexion->connect_error

                ]));

            }

            self::$conexion->set_charset("utf8");

        }

        return self::$conexion;

    }

}

?>