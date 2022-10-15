<?php

/**
 * User Model
 */
class Inicio extends Model
{

    protected $allowedColumns = [];

    protected $beforeInsert = [];

    protected $beforeUpdate = [];

    protected $afterSelect = [];

    public function validate($DATA, $id = '')
    {

        return false;
    }

    public function listarDatosDashboard($id,$ind)
    {
        error_log("DATOS SP_MANTENEDOR_INICIO id -> " . $id);
        $query = "call SP_MANTENEDOR_INICIO(" . $id . ",".$ind.",@resultado)";

        $database = new Database();

        $conexion = $database->connect();
        $sentencia = $conexion->prepare($query);

        $sentencia->execute();
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        error_log("DATOS SP_MANTENEDOR_INICIO SP -> " . json_encode($result));
        return $result;

    }
}
