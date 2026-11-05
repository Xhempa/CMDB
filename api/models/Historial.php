<?php

require_once __DIR__ . "/../config/conexion.php";

class Historial
{

    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar();
    }

    /*
    |----------------------------------------------------
    | Listar historial
    |----------------------------------------------------
    */

    public function listar()
    {

        $sql = "SELECT * FROM historial ORDER BY id DESC";

        $resultado = $this->conexion->query($sql);

        if(!$resultado){

            throw new Exception($this->conexion->error);

        }

        $historial = [];

        while($fila = $resultado->fetch_assoc()){

            $historial[] = $fila;

        }

        return $historial;

    }

    /*
    |----------------------------------------------------
    | Registrar acción
    |----------------------------------------------------
    */

    public function registrar($accion)
    {

        $stmt = $this->conexion->prepare(

            "INSERT INTO historial (accion)
            VALUES (?)"

        );

        $stmt->bind_param("s",$accion);

        return $stmt->execute();

    }

    /*
    |----------------------------------------------------
    | Eliminar registro
    |----------------------------------------------------
    */

    public function eliminar($id)
    {

        $stmt = $this->conexion->prepare(

            "DELETE FROM historial
            WHERE id=?"

        );

        $stmt->bind_param("i",$id);

        return $stmt->execute();

    }

}

?>