<?php

require_once __DIR__ . "/../config/conexion.php";

class Cita
{

    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar();
    }

    /*
    |----------------------------------------------------
    | Listar citas
    |----------------------------------------------------
    */

    public function listar()
    {

        $sql = "SELECT * FROM citas ORDER BY id DESC";

        $resultado = $this->conexion->query($sql);

        if(!$resultado){

            throw new Exception($this->conexion->error);

        }

        $citas = [];

        while($fila = $resultado->fetch_assoc()){

            $citas[] = $fila;

        }

        return $citas;

    }

    /*
    |----------------------------------------------------
    | Registrar cita
    |----------------------------------------------------
    */

    public function registrar($cliente,$fecha,$descripcion,$cliente_id)
    {

        $stmt = $this->conexion->prepare(

            "INSERT INTO citas
            (cliente,fecha,descripcion,cliente_id)
            VALUES (?,?,?,?)"

        );

        $stmt->bind_param(

            "sssi",

            $cliente,

            $fecha,

            $descripcion,

            $cliente_id

        );

        return $stmt->execute();

    }

    /*
    |----------------------------------------------------
    | Actualizar cita
    |----------------------------------------------------
    */

    public function actualizar($id,$cliente,$fecha,$descripcion,$cliente_id)
    {

        $stmt = $this->conexion->prepare(

            "UPDATE citas

            SET

            cliente=?,

            fecha=?,

            descripcion=?,

            cliente_id=?

            WHERE id=?"

        );

        $stmt->bind_param(

            "sssii",

            $cliente,

            $fecha,

            $descripcion,

            $cliente_id,

            $id

        );

        return $stmt->execute();

    }

    /*
    |----------------------------------------------------
    | Eliminar cita
    |----------------------------------------------------
    */

    public function eliminar($id)
    {

        $stmt = $this->conexion->prepare(

            "DELETE FROM citas

            WHERE id=?"

        );

        $stmt->bind_param(

            "i",

            $id

        );

        return $stmt->execute();

    }

}

?>