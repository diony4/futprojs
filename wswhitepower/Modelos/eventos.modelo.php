<?php

require_once "conexion.php";


class ModeloEventos 
{
	
	//private ModeloArea $idArea;

	public function __construct(


	) {
	
	}



	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function DAO_MostrarEventos()
	{

		try {
			new Conexion();
			$conexion = Conexion::Singleton();
			$sentencia = $conexion->prepare("call SP_MANTENEDOR_EVENTOS(1,null,null,null,null,null,null,null,null,null,@resultado)");
			$sentencia->execute();
			$lista = $sentencia->fetchAll(PDO::FETCH_ASSOC);
			//$resultado =array();
			$json = json_encode($lista);
			echo $json;
		} catch (Exception $e) {
			throw $e->getMessage();
		}
	}

	static public function DAO_BuscarEvento($id)
	{
		
		try {
			new Conexion();
			$conexion = Conexion::Singleton();
			$sentencia = $conexion->prepare("call SP_MANTENEDOR_EVENTOS(5,?,null,null,null,null,null,null,null,null,@resultado)");
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
