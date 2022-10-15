<?php

require_once "conexion.php";


class ModeloVentas
{
	
	//private ModeloArea $idArea;

	public function __construct(


	) {
	
	}



	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function DAO_ListarVentasUsuario($id)
	{
		try {
			new Conexion();
			$conexion = Conexion::Singleton();
			$sentencia = $conexion->prepare("call SP_MANTENEDOR_VENTAS(2,null,?,null,null,null,null,null,null,null,null,@resultado)");
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

	static public function DAO_AgregarVenta($json)
	{
		
		$data = json_decode($json);
        try {
            new Conexion();
            $conexion = Conexion::Singleton();
			$sentencia = $conexion->prepare("call SP_MANTENEDOR_VENTAS(3,null,?,?,?,?,?,?,?,?,?,@resultado)");
            $sentencia->bindParam(1, $data->IdUsuario);
            $sentencia->bindParam(2, $data->IdTarjeta);
			$sentencia->bindParam(3, $data->IdZona);
			$sentencia->bindParam(4, $data->Monto);
			$sentencia->bindParam(5, $data->CodigoQR);
			$sentencia->bindParam(6, $data->Token);
			$sentencia->bindParam(7, $data->IdEvento);
			$sentencia->bindParam(8, $data->Entradas);
			$sentencia->bindParam(9, $data->PrecioUnitario);
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
