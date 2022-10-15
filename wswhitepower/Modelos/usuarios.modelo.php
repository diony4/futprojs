<?php

require_once "conexion.php";
require_once "persona.modelo.php";




class ModeloUsuarios implements JsonSerializable
{
	private $IdUsuario;
	private $Email;
	private $UserName;
	private $Imagen;
	private $IdRol;
	private $IdEmpresa;
	private $IdTipoRegistro;
	private ModeloPersona $IdPersona;
	//private ModeloArea $idArea;

	public function __construct(
		$IdUsuario,
		$Email,
		$UserName,
		$Imagen,
		$IdRol,
		$IdEmpresa,
		$IdTipoRegistro,
		ModeloPersona $IdPersona

	) {
		$this->$IdUsuario =   	$IdUsuario;
		//	$this->$IdPersona=   	$IdPersona;
		$this->$Email =   		$Email;
		$this->$UserName =   	$UserName;
		$this->$Imagen =   		$Imagen;
		$this->$IdRol =   		$IdRol;
		$this->$IdEmpresa =   	$IdEmpresa;
		$this->$IdTipoRegistro = $IdTipoRegistro;
		$this->$IdPersona = $IdPersona;
	}
	public function jsonSerialize()
	{
		return get_object_vars($this);
		return [
			'IdUsuario' 	=> utf8_encode($this->IdUsuario),
			//'IdPersona' 		=> utf8_encode( $this->IdPersona),
			'Email' 	=> utf8_encode($this->Email),
			'UserName' 			=> utf8_encode($this->UserName),
			'Imagen'		=> utf8_encode($this->Imagen),
			'IdRol' 		=> utf8_encode($this->IdRol),
			'IdEmpresa' 		=> utf8_encode($this->IdEmpresa),
			'IdTipoRegistro' 		=> utf8_encode($this->IdTipoRegistro),
			'IdPersona' 		=> $this->IdPersona->jsonSerialize()
		];
	}
	static public function DAO_validarUsuario($usuario, $clave, $ind)
	{

		try {
			new Conexion();
			$conexion = Conexion::Singleton();
			$sentencia = $conexion->prepare("call SP_MANTENEDOR_USUARIO(7,?,null,null,null,null,null,null,null,null,null,null,null,?,?,null,null,null,null,@resultado)");
			$sentencia->bindParam(1, $ind);
			$sentencia->bindParam(2, $usuario);
			$sentencia->bindParam(3, $clave);

			$sentencia->execute();
			$lista = $sentencia->fetch(PDO::FETCH_ASSOC);
		   
			//$resultado =array();
			if (!empty($lista["resultado"])) {
				$lista["IdUsuario"] = "0";
				$lista["Email"] = "--";
				$lista["Imagen"] = "--";
				$lista["IdTipoRegistro"] = "0";
				$lista["UserName"] = "--";
				$lista["IdPersona"] = "0";
				$lista["DocTipo"] = "--";
				$lista["DocNumero"] = "--";
				$lista["Nombres"] = "--";
				$lista["Apellidos"] = "--";
				$lista["Genero"] = "--";
				$lista["Telefono"] = "--";
				$lista["FechaNacimiento"] = "1999-04-06";
				if ($lista["resultado"] == 2) {
					if ($ind == 2) {
						$lista["mensaje"] = "Email incorrecto";
					} else {
						$lista["mensaje"] = "Celular incorrecto";
					}
				} elseif ($lista["resultado"] == 3) {
					$lista["mensaje"] = "Contraseña incorrecta";
				} elseif ($lista["resultado"] == 4) {
					$lista["mensaje"] = "Error en el servicio o no tiene permisos en este sistema";
				}
				
			}else{
				$lista["resultado"] = "0";
				$lista["mensaje"] = "Inicio de sesion correcto";
			} 
			$lista["resultado"] =strval($lista["resultado"]);
			$array = array($lista);
			$json = json_encode($array);
			echo $json;
		} catch (Exception $e) {
			header("HTTP/1.0 405 Method Not Allowed");
			throw $e->getMessage();
		}
	}

	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function DAO_MostrarUsuarios()
	{

		try {
			new Conexion();
			$conexion = Conexion::Singleton();
			$sentencia = $conexion->prepare("call SP_MANTENEDOR_USUARIO(1,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,@resultado)");
			$sentencia->execute();
			$lista = $sentencia->fetchAll(PDO::FETCH_ASSOC);
			//$resultado =array();
			$json = json_encode($lista);
			echo $json;
		} catch (Exception $e) {
			throw $e->getMessage();
		}
	}

	static public function DAO_registrarUsuario($json)
	{

		$data = json_decode($json);
		try {
			new Conexion();
			$conexion = Conexion::Singleton();
			$sentencia = $conexion->prepare("call SP_MANTENEDOR_USUARIO(2,null,?,?,?,?,?,?,?,null,null,null,?,?,?,?,0,2,?,@resultado)");
			$sentencia->bindParam(1, $data->DocTipo);
			$sentencia->bindParam(2, $data->DocNumero);
			$sentencia->bindParam(3, $data->Apellidos);
			$sentencia->bindParam(4, $data->Nombres);
			$sentencia->bindParam(5, $data->Genero);
			$sentencia->bindParam(6, $data->Telefono);
			$sentencia->bindParam(7, $data->FechaNacimiento);
			//$sentencia->bindParam(8, $data->Ciudad);
			//$sentencia->bindParam(9, $data->Direccion);
			//$sentencia->bindParam(10, $data->CodigoPostal);
			$sentencia->bindParam(8, $data->Email);
			$sentencia->bindParam(9, $data->UserName);
			$sentencia->bindParam(10, $data->Clave);
			$sentencia->bindParam(11, $data->Imagen);
			//$sentencia->bindParam(15, $data->IdRol);
			//$sentencia->bindParam(12, $data->IdEmpresa);
			$sentencia->bindParam(12, $data->IdTipoRegistro);
			$sentencia->execute();

			//OBTENEMOS VARIABLE RESULTADO
			// $variableINOUT = $conexion->prepare('SELECT resultado');
			// $variableINOUT->execute();
			$var = $sentencia->fetch(PDO::FETCH_ASSOC);
			if ($var["resultado"] == 2) {
				$var["mensaje"] = "El email ya existe";
			} elseif ($var["resultado"] == 3) {
				$var["mensaje"] = "El celular ya existe";
			} else {
				$var["mensaje"] = "Usuario registrado";
			}
			echo json_encode($var);
		} catch (Exception $e) {
			return "Error: " . $e->getMessage();
		}
	}

	static public function DAO_EditarUsuario($json)
	{
		$data = json_decode($json);
		try {
			new Conexion();
			$conexion = Conexion::Singleton();
			$sentencia = $conexion->prepare("call SP_MANTENEDOR_USUARIO(3,?,?,?,?,?,?,?,?,null,null,null,?,?,?,?,0,2,null,@resultado)");
			$sentencia->bindParam(1, $data->IdUsuario);
			$sentencia->bindParam(2, $data->DocTipo);
			$sentencia->bindParam(3, $data->DocNumero);
			$sentencia->bindParam(4, $data->Apellidos);
			$sentencia->bindParam(5, $data->Nombres);
			$sentencia->bindParam(6, $data->Genero);
			$sentencia->bindParam(7, $data->Telefono);
			$sentencia->bindParam(8, $data->FechaNacimiento);
			//$sentencia->bindParam(9, $data->Ciudad);
			//$sentencia->bindParam(10, $data->Direccion);
			//$sentencia->bindParam(11, $data->CodigoPostal);
			$sentencia->bindParam(9, $data->Email);
			$sentencia->bindParam(10, $data->UserName);
			$sentencia->bindParam(11, $data->Clave);
			$sentencia->bindParam(12, $data->Imagen);
			//$sentencia->bindParam(16, $data->IdRol);
			//$sentencia->bindParam(17, $data->IdEmpresa);
			//$sentencia->bindParam(18, $data->IdTipoRegistro);
			$sentencia->execute();

			//OBTENEMOS VARIABLE RESULTADO
			// $variableINOUT = $conexion->prepare('SELECT @resultado');
			// $variableINOUT->execute();
			$var = $sentencia->fetch(PDO::FETCH_ASSOC);
			if ($var["resultado"] == 2) {
				$var["mensaje"] = "El email ya existe";
			} elseif ($var["resultado"] == 3) {
				$var["mensaje"] = "El celular ya existe";
			} else {
				$var["mensaje"] = "Usuario actualizado";
			}
			echo json_encode($var);
		} catch (Exception $e) {
			return "Error: " . $e->getMessage();
		}
	}

	static public function DAO_EliminarUsuario($json)
	{
		$data = json_decode($json);
		try {
			new Conexion();
			$conexion = Conexion::Singleton();
			$sentencia = $conexion->prepare("call SP_MANTENEDOR_USUARIO(4,?,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,@resultado)");
			$sentencia->bindParam(1, $data->IdUsuario);
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

	static public function DAO_ListarUsuario($id)
	{

		try {
			new Conexion();
			$conexion = Conexion::Singleton();
			$sentencia = $conexion->prepare("call SP_MANTENEDOR_USUARIO(6,?,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,@resultado)");
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
