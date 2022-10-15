<?php

require_once "conexion.php";


class ModeloFavoritos
{
	
	//private ModeloArea $idArea;

	public function __construct(


	) {
	
	}



	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function DAO_ListarEventosFavoritosDeUnUsuario($id)
	{
		try {
			new Conexion();
			$conexion = Conexion::Singleton();
			$sentencia = $conexion->prepare("call SP_MANTENEDOR_FAVORITOS(1,null,?,@resultado)");
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

	static public function DAO_AgregarEventoFavoritoUsuario($json)
	{
		
		$data = json_decode($json);
        try {
            new Conexion();
            $conexion = Conexion::Singleton();
            $sentencia = $conexion->prepare("call SP_MANTENEDOR_FAVORITOS(2,?,?,@resultado)");
            $sentencia->bindParam(1, $data->IdEvento);
            $sentencia->bindParam(2, $data->IdUsuario);
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
