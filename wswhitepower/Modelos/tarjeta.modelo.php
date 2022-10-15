<?php

require_once "conexion.php";


class ModeloTarjetas
{


    public function __construct()
    {
    }



    /*=============================================
	MOSTRAR USUARIOS
	=============================================*/

    static public function DAO_MostrarTarjetasUsuario($id)
    {

        try {
            new Conexion();
            $conexion = Conexion::Singleton();
            $sentencia = $conexion->prepare("call SP_MANTENEDOR_TARJETAS(1,null,?,null,null,null,@resultado)");
            $sentencia->bindParam(1, $id);
            $sentencia->execute();
            $lista = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            //$resultado =array();
            $json = json_encode($lista);
            echo $json;
        } catch (Exception $e) {
            throw $e->getMessage();
        }
    }

    static public function DAO_BuscarTarjeta($id)
    {

        try {
            new Conexion();
            $conexion = Conexion::Singleton();
            $sentencia = $conexion->prepare("call SP_MANTENEDOR_TARJETAS(5,?,null,null,null,null,@resultado)");
            $sentencia->bindParam(1, $id);
            $sentencia->execute();
            $lista = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            //$resultado =array();
            $json = json_encode($lista);
            echo $json;
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    static public function DAO_registrarTarjeta($json)
    {
        $data = json_decode($json);
        try {
            new Conexion();
            $conexion = Conexion::Singleton();
            $sentencia = $conexion->prepare("call SP_MANTENEDOR_TARJETAS(2,null,?,?,?,?,@resultado)");
            $sentencia->bindParam(1, $data->IdUsuario);
            $sentencia->bindParam(2, $data->Numero);
            $sentencia->bindParam(3, $data->FechaVencimiento);
            $sentencia->bindParam(4, $data->CodigoCvv);
            $sentencia->execute();

            //OBTENEMOS VARIABLE RESULTADO
            $variableINOUT = $conexion->prepare('SELECT @resultado');
            $variableINOUT->execute();
            $var = $variableINOUT->fetch();

            return $var;
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    static public function DAO_EditarTarjeta($json)
    {
        $data = json_decode($json);
        try {
            new Conexion();
            $conexion = Conexion::Singleton();
            $sentencia = $conexion->prepare("call SP_MANTENEDOR_TARJETAS(3,?,?,?,?,?,@resultado)");
            $sentencia->bindParam(1, $data->IdTarjeta);
            $sentencia->bindParam(2, $data->IdUsuario);
            $sentencia->bindParam(3, $data->Numero);
            $sentencia->bindParam(4, $data->FechaVencimiento);
            $sentencia->bindParam(5, $data->CodigoCvv);
            $sentencia->execute();

            //OBTENEMOS VARIABLE RESULTADO
            $variableINOUT = $conexion->prepare('SELECT @resultado');
            $variableINOUT->execute();
            $var = $variableINOUT->fetch();

            return $var;
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }


    static public function DAO_EliminarTarjeta($json)
    {
        $data = json_decode($json);
        try {
            new Conexion();
            $conexion = Conexion::Singleton();
            $sentencia = $conexion->prepare("call SP_MANTENEDOR_TARJETAS(4,?,null,null,null,null,@resultado)");
            $sentencia->bindParam(1, $data->IdTarjeta);
            $sentencia->execute();

            //OBTENEMOS VARIABLE RESULTADO
            $variableINOUT = $conexion->prepare('SELECT @resultado');
            $variableINOUT->execute();
            $var = $variableINOUT->fetch();

            return $var;
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
