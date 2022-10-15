<?php
class Database{
    public function connect()
	{
		// code..
		$string = DBDRIVER . ":host=".DBHOST.";dbname=".DBNAME;
		error_log("DATABASE::CADENACONECCION-> " .$string);
		error_log("DATABASE::USUARIO-> " .DBUSER);
		error_log("DATABASE::PASSWORD-> " .DBPASS);
		$con = new PDO($string,DBUSER,DBPASS);
		$con->exec("SET CHARACTER SET utf8");
	
		if(!$con){
			die("no pudo conectarse a la base de datos");
			error_log("DATABASE::CONECCION-> nose pudo conectar al BD :" .$con);
		}
		return $con;
	}

	public function query($query,$nameId,$data = array(),$data_type = "object")
	{
		
		$con = $this->connect();
		$stm = $con->prepare($query);
		$dml = explode(" ", $query)[0];

		switch ($dml)
		{
			case "select" :
				$check = $stm->execute($data);
				if($check){
					if($data_type == "object"){
				
						$data = $stm->fetchAll(PDO::FETCH_OBJ);
					}else{
						$data = $stm->fetchAll(PDO::FETCH_ASSOC);
					}
	
					if(is_array($data) && count($data) >0){
						return $data;
					}
				}

				break;

			case "insert":
				$check = $stm->execute($data);
				if($check){
					$lastid = $con->lastInsertId();
					error_log("DATABASE::lastId -> ".$lastid);
					return $lastid;
				}

				break;

			case'update':
				error_log("update database -> ".json_encode($data));
				$check = $stm->execute($data);
				if ($stm->rowCount()>0){
					return true;
				}else{
					return false;
				}

				break;

			case'delete':
				$check = $stm->execute($data);
				return true;
				break;

			case'call':
			
				$check = $stm->execute($data);
				if($check){
					if($data_type == "object"){
				
						$data = $stm->fetchAll(PDO::FETCH_OBJ);
					}else{
						$data = $stm->fetchAll(PDO::FETCH_ASSOC);
					}
	
					if(is_array($data) && count($data) >0){
						return $data;
					}else{
						return true;
					}
				}
				break;
		}
		return false;
		
	}


	public function queryPuro($query,$data = array(),$data_type = "object"){
		$con = $this->connect();
		$stm = $con->prepare($query);
		$check = $stm->execute($data);
		if($check){
			if($data_type == "object"){
		
				$data = $stm->fetchAll(PDO::FETCH_OBJ);
			}else{
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);
			}

			if(is_array($data) && count($data) >0){
				return $data;
			}
		}
		
	}

	public function ejecutarConsulta_retornarID($sql,$data = array(),$data_type = "object"){
		$con = $this->connect();
		$stm = $con->prepare($sql);
		$check = $stm->execute($data);
		if($check){
			if($data_type == "object"){
		
				$data = $stm->fetchAll(PDO::FETCH_OBJ);
			}else{
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);
			}

			if(is_array($data) && count($data) >0){
				return $data;
			}
		}
	}


	public function ejecutarSP($query,$data){
		try {
			error_log("EJECUTAR SP query-> ".$query);
			error_log("EJECUTAR SP data-> ".json_encode($data));
			$conexion = $this->connect();
			$sentencia = $conexion->prepare($query);
			$consulta = 1;

			if($data != "select"){
				foreach($data as $dat){
					error_log("EJECUTAR SP dat -> ".$consulta." - ".json_encode($dat));
					$parametro = $dat;
					$sentencia -> bindParam($consulta,$parametro);
					$consulta++;
				}

	
			}
			error_log("sentencia SP  -> ".json_encode($sentencia));
			$sentencia -> execute();
			$retorno = $sentencia->fetchAll(PDO::FETCH_ASSOC);
			return $retorno;
		} catch (Exception $e) {
			error_log("EJECUTAR SP ERROR -> ".$e->getMessage());
			throw $e -> getMessage();
		}
	}

}
	