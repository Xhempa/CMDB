<?php

require_once __DIR__ . "/../config/conexion.php";

class Cliente
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar();
    }

    /*
    |----------------------------------------------------
    | Listar clientes
    |----------------------------------------------------
    */

    public function listar()
    {
        $sql = "SELECT * FROM clientes ORDER BY id DESC";

        $resultado = $this->conexion->query($sql);

        if (!$resultado) {
            throw new Exception($this->conexion->error);
        }

        $clientes = [];

        while ($fila = $resultado->fetch_assoc()) {
            $clientes[] = $fila;
        }

        return $clientes;
    }

    /*
    |----------------------------------------------------
    | Registrar cliente
    |----------------------------------------------------
    */

    public function registrar($nombre, $telefono, $correo)
    {
        $stmt = $this->conexion->prepare(
            "INSERT INTO clientes (nombre, telefono, correo)
             VALUES (?, ?, ?)"
        );

        $stmt->bind_param(
            "sss",
            $nombre,
            $telefono,
            $correo
        );

        return $stmt->execute();
    }

    /*
    |----------------------------------------------------
    | Actualizar cliente
    |----------------------------------------------------
    */

    public function actualizar($id, $nombre, $telefono, $correo)
    {
        $stmt = $this->conexion->prepare(
            "UPDATE clientes
             SET
                nombre=?,
                telefono=?,
                correo=?
             WHERE id=?"
        );

        $stmt->bind_param(
            "sssi",
            $nombre,
            $telefono,
            $correo,
            $id
        );

        return $stmt->execute();
    }

    /*
    |----------------------------------------------------
    | Eliminar cliente
    |----------------------------------------------------
    */

    public function eliminar($id)
    {
        $stmt = $this->conexion->prepare(
            "DELETE FROM clientes
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