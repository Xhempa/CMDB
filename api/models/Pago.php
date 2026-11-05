<?php

require_once __DIR__ . "/../config/conexion.php";

class Pago
{

    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar();
    }

    public function listar()
    {

        $sql = "SELECT * FROM pagos ORDER BY id DESC";

        $resultado = $this->conexion->query($sql);

        if(!$resultado){

            throw new Exception($this->conexion->error);

        }

        $pagos = [];

        while($fila = $resultado->fetch_assoc()){

            $pagos[] = $fila;

        }

        return $pagos;

    }

    public function registrar($cliente,$valor,$fecha,$cliente_id)
    {

        $stmt = $this->conexion->prepare(

            "INSERT INTO pagos
            (cliente,valor,fecha,cliente_id)
            VALUES (?,?,?,?)"

        );

        $stmt->bind_param(

            "sisi",

            $cliente,

            $valor,

            $fecha,

            $cliente_id

        );

        return $stmt->execute();

    }

    public function actualizar($id,$cliente,$valor,$fecha,$cliente_id)
    {

        $stmt = $this->conexion->prepare(

            "UPDATE pagos

            SET

            cliente=?,

            valor=?,

            fecha=?,

            cliente_id=?

            WHERE id=?"

        );

        $stmt->bind_param(

            "sisii",

            $cliente,

            $valor,

            $fecha,

            $cliente_id,

            $id

        );

        return $stmt->execute();

    }

    public function eliminar($id)
    {

        $stmt = $this->conexion->prepare(

            "DELETE FROM pagos WHERE id=?"

        );

        $stmt->bind_param("i",$id);

        return $stmt->execute();

    }

}

?>