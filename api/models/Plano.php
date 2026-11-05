<?php

require_once __DIR__ . "/../config/conexion.php";

class Plano
{

    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar();
    }

    public function listar()
    {

        $sql = "SELECT * FROM planos ORDER BY id DESC";

        $resultado = $this->conexion->query($sql);

        if(!$resultado){

            throw new Exception($this->conexion->error);

        }

        $planos = [];

        while($fila = $resultado->fetch_assoc()){

            $planos[] = $fila;

        }

        return $planos;

    }

    public function registrar($nombre,$tipo,$descripcion,$cliente_id)
    {

        $stmt = $this->conexion->prepare(

            "INSERT INTO planos
            (nombre,tipo,descripcion,cliente_id)
            VALUES (?,?,?,?)"

        );

        $stmt->bind_param(

            "sssi",

            $nombre,

            $tipo,

            $descripcion,

            $cliente_id

        );

        return $stmt->execute();

    }

    public function actualizar($id,$nombre,$tipo,$descripcion,$cliente_id)
    {

        $stmt = $this->conexion->prepare(

            "UPDATE planos

            SET

            nombre=?,

            tipo=?,

            descripcion=?,

            cliente_id=?

            WHERE id=?"

        );

        $stmt->bind_param(

            "sssii",

            $nombre,

            $tipo,

            $descripcion,

            $cliente_id,

            $id

        );

        return $stmt->execute();

    }

    public function eliminar($id)
    {

        $stmt = $this->conexion->prepare(

            "DELETE FROM planos WHERE id=?"

        );

        $stmt->bind_param("i",$id);

        return $stmt->execute();

    }

}

?>