<?php

/**
 * User Model
 */
class Usuario extends Model
{
    public $verId = "IdUsuario";
    protected $allowedColumns = [
        'IdPersona',
        'Email',
        'UserName',
        'FechaCreacion',
        'Clave',
        'Imagen',
        'IdRol',
        'Activo'
    ];

    protected $beforeInsert = [
        'hash_password'
    ];

    protected $beforeUpdate = [
      
    ];

    protected $afterSelect = [
        'get_persona',
    ];


    public function validateEditar($DATA, $id = '')
    {
        $this->errors = array();

        //verifica email
        if (empty($DATA['Email']) || !filter_var($DATA['Email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors = "Email no es valido";
        }

        //verifica si existe email
        if (trim($id) == "") {
            if ($this->where('Email', $DATA['Email'])) {
                $this->errors = "El correo ya esta en uso";
            }
        } else {
            if ($this->query("select Email from $this->table where Email = :email && IdUsuario != :id","", ['email' => $DATA['Email'], 'id' => $id])) {
                $this->errors = "That email is already in use";
            }
        }

    
        //verifica el rol
        if (empty($DATA['IdRol']) ) {
            array_push($this->errors, "Rol no valido");
        }


        if (isset($this->errors)) {
            return true;
        }

        return false;
    }

    public function validate($DATA, $id = '')
    {
        $this->errors = array();

        //verifica email
        if (empty($DATA['Email']) || !filter_var($DATA['Email'], FILTER_VALIDATE_EMAIL)) {
            array_push($this->errors , "Email no es valido");
        }

        //verifica si existe email
        if (trim($id) == "") {
            if ($this->where('Email', $DATA['Email'])) {
                array_push($this->errors , "El correo ya esta en uso");
            }
        } else {
            if ($this->query("select Email from $this->table where Email = :email && IdUsuario != :id","", ['email' => $DATA['Email'], 'id' => $id])) {
                array_push($this->errors , "That email is already in use");
            }
        }

         //verifica USER
         if (empty($DATA['UserName'])) {
            array_push($this->errors , "El usuario no es valido");
        }

        //verifica si existe USER
        if (trim($id) == "") {
            if ($this->where('UserName', $DATA['UserName'])) {
                array_push($this->errors , "El usuario ya esta en uso");
            }
        } else {
            if ($this->query("select UserName from $this->table where UserName = :user && IdUsuario != :id","", ['user' => $DATA['UserName'], 'id' => $id])) {
                array_push($this->errors ,  "El usuario ya esta en uso");
            }
        }

        //verificar password
        if (isset($DATA['Clave'])) {

            //verifica password y password2
            if (empty($DATA['Clave']) || $DATA['Clave'] !== $DATA['Clave2']) {
                array_push( $this->errors , "Las contraseñas no coinciden");
            }

            //verifica longitud de password
            if (strlen($DATA['Clave']) < 8) {
                array_push($this->errors , "Password must be at least 8 characters long");
            }
        }

        //verifica el rol
      
        if (empty($DATA['IdRol']) ) {
            array_push($this->errors, "Rol no valido");
        }

        if (count($this->errors) == 0) {
            return true;
        }

        return false;
    }



    public function hash_password($data)
    {
        $data['Clave'] = password_hash($data['Clave'], PASSWORD_DEFAULT);
        return $data;
    }


    public function get_persona($data)
    {
        $user = new Persona();

        foreach ($data as $key => $row) {
            
            $result = $user->where('IdPersona',$row->IdPersona);
            $data[$key]->persona = is_array($result) ? $result[0] : false;
        }
        return $data;
    }

    public function iniciarSesion($data){
        $query = "call SP_MANTENEDOR_USUARIO(5,null,null,null,null,null,null,null,null,null,null,null,null,?,?,null,null,null,null,@resultado)";
        error_log("DATOS USUARIO SP -> ".json_encode($query));
        $database = new Database();
        $user = $data["UserName"];
        $clave = $data["Clave"];
        error_log("DATOS USUARIO SP -> ".json_encode($user));
        error_log("DATOS USUARIO SP -> ".json_encode($clave));
        $conexion = $database->connect();
        $sentencia = $conexion->prepare($query);
        $sentencia -> bindParam(1,$user);
        $sentencia -> bindParam(2,$clave);
   
        $sentencia -> execute();
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    
    public function guardarUsuario($data){
        $query = "call SP_MANTENEDOR_USUARIO(2,0,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,@resultado)";
        error_log("DATOS USUARIO guardarUsuario -> ".json_encode($data));
        $database = new Database();

        $conexion = $database->connect();
        $sentencia = $conexion->prepare($query);

        $sentencia -> bindParam(1,$data["DocTipo"]);
        $sentencia -> bindParam(2,$data["DocNumero"]);
        $sentencia -> bindParam(3,$data["Apellidos"]);
        $sentencia -> bindParam(4,$data["Nombres"]);
        $sentencia -> bindParam(5,$data["Genero"]);
        $sentencia -> bindParam(6,$data["Telefono"]);
        $sentencia -> bindParam(7,$data["FechaNacimiento"]);
        $sentencia -> bindParam(8,$data["IdCiudad"]); //no
        $sentencia -> bindParam(9,$data["Direccion"]); //no
        $sentencia -> bindParam(10,$data["CodigoPostal"]); //no
        $sentencia -> bindParam(11,$data["Email"]);
        $sentencia -> bindParam(12,$data["UserName"]);
        $sentencia -> bindParam(13,$data["Clave"]);
        $sentencia -> bindParam(14,$data["Imagen"]);
        $sentencia -> bindParam(15,$data["IdRol"]);
        $sentencia -> bindParam(16,$data["IdEmpresa"]);
        $sentencia -> bindParam(17,$data["IdTipoRegistro"]); //no
   
        $sentencia -> execute();
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

        
    public function editarUsuario($data,$id){
        $query = "call SP_MANTENEDOR_USUARIO(3,?,?,?,?,?,?,?,?,?,?,?,?,null,null,?,?,?,?,@resultado)";
        error_log("DATOS USUARIO editarUsuario -> ".json_encode($data));
        $database = new Database();

        $conexion = $database->connect();
        $sentencia = $conexion->prepare($query);

        $sentencia -> bindParam(1,$id);
        $sentencia -> bindParam(2,$data["DocTipo"]);
        $sentencia -> bindParam(3,$data["DocNumero"]);
        $sentencia -> bindParam(4,$data["Apellidos"]);
        $sentencia -> bindParam(5,$data["Nombres"]);
        $sentencia -> bindParam(6,$data["Genero"]);
        $sentencia -> bindParam(7,$data["Telefono"]);
        $sentencia -> bindParam(8,$data["FechaNacimiento"]);
        $sentencia -> bindParam(9,$data["IdCiudad"]); //no
        $sentencia -> bindParam(10,$data["Direccion"]); //no
        $sentencia -> bindParam(11,$data["CodigoPostal"]); //no
        $sentencia -> bindParam(12,$data["Email"]);
        $sentencia -> bindParam(13,$data["Imagen"]);
        $sentencia -> bindParam(14,$data["IdRol"]);
        $sentencia -> bindParam(15,$data["IdEmpresa"]);
        $sentencia -> bindParam(16,$data["IdTipoRegistro"]); //no
   
        $sentencia -> execute();
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    public function listarUsuariosPersonas($ind,$id){
        $query = "call SP_MANTENEDOR_USUARIO(".$ind.",null,null,null,null,null,null,null,null,null,null
                    ,null,null,null,null,null,null,".$id.",null,@resultado)";

        $result = $this->ejecutarSP($query,"select");
        error_log("DATOS USUARIO SP -> ".json_encode($result));
        return $result;
    }


    public function listarUsuariosPorId($id){
        $query = "call SP_MANTENEDOR_USUARIO(6,?,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,@resultado)";
        $database = new Database();
        error_log("DATOS SP_MANTENEDOR_USUARIO SP -> ".$id);
        $conexion = $database->connect();
        $sentencia = $conexion->prepare($query);
        $sentencia -> bindParam(1,$id);

        $sentencia -> execute();
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function activarUsuario($id){
        $query = "UPDATE TI_USUARIO SET Activo = 1 WHERE IdUsuario ='$id'";
        $res = $this->queryPuro($query);

        return true;
    }

    public function listarPermisosUsuario($id){
        $query = "SELECT TIO.*,TIR.Descripcion as Rol,TIS.Abreviatura,TIS.Descripcion as Sistema FROM TI_OPCION as TIO
                  JOIN TI_PERMISO as TIP on TIP.IdOpcion = TIO.IdOpcion
                  JOIN TI_ROL as TIR on TIR.IdRol = TIP.IdRol
                  JOIN TI_USUARIO as TIU on TIU.IdRol = TIR.IdRol
                  JOIN TI_SISTEMAS as TIS on TIS.IdSistema = TIO.IdSistema
                  WHERE TIO.Activo = 1 AND TIU.IdUsuario = '$id' ORDER BY TIO.Nivel desc";

        error_log("QUERY LISTA DE PERMISOS -> ".$query);
        $permisos = $this->queryPuro($query);
        $permisos = json_decode(json_encode($permisos), true);

        for($i = 0;  $i < sizeof($permisos);$i++){
            $array = array();
            foreach($permisos as $hijos){
                if($hijos['IdOpcionPadre']==$permisos[$i]['IdOpcion']){
                    array_push($array,$hijos);
                   
                }
            
            }
            $permisos[$i]['hijos']= $array;
        
        }

        $res = array();
        foreach($permisos as $row){
            if($row['Nivel']==0){
                array_push($res,$row);
            }
        }

        error_log("USUARIO LOGIN::liatarPermisos -> ".json_encode($res));
        return $res;
    }
}
