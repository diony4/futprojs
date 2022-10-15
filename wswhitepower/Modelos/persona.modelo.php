<?php

require_once "conexion.php";

class ModeloPersona implements JsonSerializable
{
	private $IdPersona ;
	private $DocTipo;
	private $DocNumero;
	private $Nombres;
	private $Apellidos	;
	private $Genero;
	private $Telefono;
	private $FechaNacimiento;
	private $IdCiudad;
	private $Direccion;
	private $CodigoPostal;

	public function __construct(
		$IdPersona ,
		$DocTipo,
		$DocNumero,
		$Nombres,
		$Apellidos,
		$Genero,
		$Telefono,
		$FechaNacimiento,
		$IdCiudad,
		$Direccion,
		$CodigoPostal
	)
	{
		$this->$IdPersona 		= $IdPersona ;
		$this->$DocTipo			= $DocTipo;
		$this->$DocNumero		= $DocNumero;
		$this->$Nombres			= $Nombres;
		$this->$Apellidos		= $Apellidos;
		$this->$Genero			= $Genero;
		$this->$Telefono		= $Telefono;
		$this->$FechaNacimiento	= $FechaNacimiento;
		$this->$IdCiudad		= $IdCiudad;
		$this->$Direccion		= $Direccion;		
		$this->$CodigoPostal= $CodigoPostal ;	
	}

	static function DAO_listaTipoUsuarios($cadena)
	{
		try {
			new Conexion();
			$conexion = Conexion::Singleton();
			$sentencia = $conexion->prepare("call SP_MANTENEDOR_TIPOUSUARIO (1,null,?,null,1,@res)");
			$sentencia->bindParam(1, $cadena);
			$sentencia->execute();
			return $sentencia->fetchAll();
		} catch (Exception $e) {
			throw $e->getMessage();
		}
	}

	public function jsonSerialize()
	{
		return get_object_vars($this);
		return [
			'IdPersona' => utf8_encode($this->IdPersona),
			'DocTipo' 	=> utf8_encode($this->DocTipo ),
			'DocNumero' 	=> utf8_encode($this->DocNumero ),
			'Nombres' 	=> utf8_encode($this->Nombres ),
			'Apellidos' 	=> utf8_encode($this->Apellidos ),
			'Genero' 	=> utf8_encode($this->Genero ),
			'Telefono' 	=> utf8_encode($this->Telefono ),
			'FechaNacimiento' 	=> utf8_encode($this->FechaNacimiento ),
			'IdCiudad' 	=> utf8_encode($this->IdCiudad ),
			'Direccion' 	=> utf8_encode($this->Direccion ),
			'CodigoPostal' 			=> utf8_encode($this->CodigoPostal)
		];
	}
}
