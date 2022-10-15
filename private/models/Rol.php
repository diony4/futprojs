<?php

/**
 * User Model
 */
class Rol extends Model
{
    public $verId = "IdRol";
    protected $allowedColumns = [
        'Descripcion',
        'IdUsuarioCreacion',
        'FechaCreacion',
        'Activo'
    ];

    protected $beforeInsert = [
       
    ];

    protected $beforeUpdate = [
        
    ];

    protected $afterSelect = [
      
    ];

    public function validate($DATA, $id = '')
    {
        $this->errors = array();

        error_log("VERIFICAR NOMBRE ROL -> ".json_encode($DATA));

        if(empty($DATA['Descripcion'])){
            array_push($this->errors, "Falta poner una descripcion");
        }

        if($DATA["Permisos"]=="none"){
            array_push($this->errors,"Escoger al menos un permiso");
        }
        //verifica si existe el rol
        if (trim($id) == "") {
            if ($this->where('Descripcion', $DATA['Descripcion'])) {
                array_push($this->errors,"El nombre del rol ya existe");
            }
        } else {
            if ($this->query("select Descripcion from $this->table where Descripcion = :descripcion && IdRol != :id","", ['descripcion' => $DATA['Descripcion'], 'id' => $id])) {
                array_push($this->errors, "El nombre ya esta en uso");
            }
        }


        if (count($this->errors) == 0) {
            return true;
        }

        return false;
    }



    public function listarRoles(){
        $query = "SELECT TIR.*,TIU.UserName FROM TI_ROL as TIR
                  JOIN TI_USUARIO as TIU on TIU.Idusuario = TIR.IdUsuarioCreacion
                  WHERE TIR.Activo = 1
                  ORDER BY TIR.Descripcion";

        $result = $this->queryPuro($query);
        return $result;
    }

    public function listarOpciones(){
        $query = "SELECT * FROM TI_OPCION WHERE Activo = 1 ORDER BY Nivel desc";
        $result = $this->queryPuro($query);
        $result = json_decode(json_encode($result), true);
       
        for($i = 0;  $i < sizeof($result);$i++){
                $array = array();
                foreach($result as $hijos){
                    if($hijos['IdOpcionPadre']==$result[$i]['IdOpcion']){
                        array_push($array,$hijos);
                       
                    }
                
                }
                $result[$i]['hijos']= $array;
            
        }

        $res = array();
        foreach($result as $row){
            if($row['Nivel']==0){
                array_push($res,$row);
            }
        }

        error_log("ROL::listarOpciones -> ".json_encode($res));
        return $res;
    }

    public function traerSistemaId($value)
	{

		$query = "select TIS.*,TIP.Descripcion as tipoSistema,TIU.UserName
                  from TI_SISTEMAS as TIS
                  join TI_TIPOSISTEMA as TIP on TIP.IdTipoSistema = TIS.IdTipoSistema
                  join TI_USUARIO as TIU on TIU.IdUsuario = TIS.IdUsuarioCreacion
                  where TIS.IdSistema = :value";
		$data = $this->query($query,"", [
			'value' => $value
		]);
		
		//run functions after select
		if (is_array($data)) {
			if (property_exists($this, 'afterSelect')) {
				foreach ($this->afterSelect as $func) {
					$data = $this->$func($data);
				}
			}
		}

		if (is_array($data)) {
			$data = $data[0];
		}
		return $data;
	}


    public function insertarRoles($data){
        $descripcion = $data["Descripcion"];
        $permisos = $data["Permisos"];
        $idUser = $data["IdUsuarioCreacion"];
        $queryRol = "INSERT INTO TI_ROL(Descripcion,IdUsuarioCreacion) VALUES('$descripcion','$idUser') RETURNING IdRol";
        $retorno = json_decode(json_encode($this->ejecutarConsulta_retornarID($queryRol)), true); 
        error_log("IDROL RETORNADO -> ".json_encode($retorno));
        $idRol = $retorno[0]["IdRol"];
        foreach($permisos as $per) {
          
            foreach($per["Hijos"] as $hijo){
                $idHijo = $hijo["IdOpcion"];
                $query_hijo = "INSERT INTO TI_PERMISO(IdRol,IdOpcion,IdUsuarioCreacion) VALUES('$idRol','$idHijo','$idUser')";
                error_log("RETURN INSERT hijos:: -> ".$query_hijo);
                $ret = $this->queryPuro($query_hijo);
            }

            $idPer = $per["IdOpcion"];
            $query_permisos = "INSERT INTO TI_PERMISO(IdRol,IdOpcion,IdUsuarioCreacion) VALUES('$idRol','$idPer','$idUser')";
            error_log("QUERY INSERT PERMISOS:: -> ".$query_permisos);
            $return = $this->queryPuro($query_permisos);

            $idPadre = $per["IdOpcionPadre"];
            $query_padre = "INSERT INTO TI_PERMISO(IdRol,IdOpcion,IdUsuarioCreacion) VALUES('$idRol','$idPadre','$idUser')";
            error_log("RETURN INSERT PADRE:: -> ".$query_padre);
            $return = $this->queryPuro($query_padre);
        }

        return true;
    }
}
