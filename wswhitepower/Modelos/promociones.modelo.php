<?php

require_once "conexion.php";


class ModeloPromociones 
{
	
	
	public function __construct(


	) {
	
	}



	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function DAO_MostrarPromociones()
	{

		try {
			new Conexion();
			$conexion = Conexion::Singleton();
			$sentencia = $conexion->prepare("call SP_MANTENEDOR_PROMOCIONES(1,null,null,null,null,null,null,null,null,@resultado)");
			$sentencia->execute();
			$lista = $sentencia->fetchAll(PDO::FETCH_ASSOC);
			//$resultado =array();
			$json = json_encode($lista);
			echo $json;
		} catch (Exception $e) {
			throw $e->getMessage();
		}
	}

	static public function DAO_BuscarPromocion($id)
	{
		
		try {
			new Conexion();
			$conexion = Conexion::Singleton();
			$sentencia = $conexion->prepare("call SP_MANTENEDOR_PROMOCIONES(5,?,null,null,null,null,null,null,null,@resultado)");
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
}
