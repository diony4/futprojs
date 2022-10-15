<?php

/**
 * User Model
 */
class Sistemas extends Model
{
    public $verId = "IdSistema";
    protected $allowedColumns = [
        'Abreviatura',
        'Descripcion',
        'IdTipoSistema',
        'FechaCreacion',
        'IdUsuarioCreacion',
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


        //verifica si existe el nombre del sistema
        if (trim($id) == "") {
            if ($this->where('Descripcion', $DATA['Descripcion'])) {
                $this->errors['Descripcion'] = "El nombre del sistema ya existe";
            }
        } else {
            if ($this->query("select Descripcion from $this->table where Descripcion = :descripcion && IdSistema != :id","", ['descripcion' => $DATA['Descripcion'], 'id' => $id])) {
                $this->errors['Descripcion'] = "El nombre ya esta en uso";
            }
        }

        //verifica si existe la abreviatura del sistema
        if (trim($id) == "") {
            if ($this->where('Abreviatura', $DATA['Abreviatura'])) {
                $this->errors['Abreviatura'] = "La abreviatura del sistema ya existe";
            }
        } else {
            if ($this->query("select Abreviatura from $this->table where Abreviatura = :abreviatura && IdSistema != :id","", ['abreviatura' => $DATA['Abreviatura'], 'id' => $id])) {
                $this->errors['Abreviatura'] = "La abreviatura ya esta en uso";
            }
        }

        //verifica el tipo de sistema
       
        error_log("IdTipoSistema -> ".json_encode($DATA));
        if (empty($DATA['IdTipoSistema'])) {
            $this->errors['IdTipoSistema'] = "Tipo de sistema no valido";
        }

        if (count($this->errors) == 0) {
            return true;
        }

        return false;
    }



    public function listarSistemas(){
        $query = "SELECT TIS.*,TIP.Descripcion as TipoSistema,TIU.UserName FROM TI_SISTEMAS as TIS
                  JOIN TI_TIPOSISTEMA as TIP on TIP.IdTipoSistema = TIS.IdTipoSistema
                  JOIN TI_USUARIO as TIU on TIU.Idusuario = TIS.IdUsuarioCreacion
                  WHERE TIS.Activo = 1
                  ORDER BY TIP.Descripcion, TIS.Descripcion";

        $result = $this->queryPuro($query);
        return $result;
    }

    public function listarTiposDeSistemas(){
        $query = "SELECT * FROM TI_TIPOSISTEMA WHERE Activo = 1 ORDER BY Descripcion";
        $result = $this->queryPuro($query);
        return $result;
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
}
