<?php

/**
 * User Model
 */
class Sede extends Model
{
    public $verId = "IdSede";
    protected $allowedColumns = [
        'IdEmpresa',
        'Nombre',
        'Ciudad',
        'Direccion',
        'longitud',
        'Latitud',
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


        if (count($this->errors) == 0) {
            return true;
        }

        return false;
    }

    public function listarSedesMP(){
        $query = "call SP_MANTENEDOR_SEDES(1,null,null,null,null,null,null,null,null,@resultado)";

        $result = $this->ejecutarSP($query,"select");
        error_log("DATOS SP_MANTENEDOR_SEDES SP -> ".json_encode($result));
        return $result;
    }

    public function insertarSede($data){
        $query = "call SP_MANTENEDOR_SEDES(2,0,?,?,?,?,?,?,?,@resultado)";
        $database = new Database();
        error_log("DATOS SP_MANTENEDOR_SEDES insertarSede -> ".$data["IdUsuarioCreacion"]);
        error_log("DATOS SP_MANTENEDOR_SEDES insertarSede2 -> ".json_encode($data));
        $conexion = $database->connect();
        $sentencia = $conexion->prepare($query);
        $sentencia -> bindParam(1,$data["IdEmpresa"]);
        $sentencia -> bindParam(2,$data["Nombre"]);
        $sentencia -> bindParam(3,$data["Ciudad"]);
        $sentencia -> bindParam(4,$data["Direccion"]);
        $sentencia -> bindParam(5,$data["Longitud"]);
        $sentencia -> bindParam(6,$data["Latitud"]);
        $sentencia -> bindParam(7,$data["IdUsuarioCreacion"]);
   
        $sentencia -> execute();
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $result;
      }

      public function buscarSedeId($id){
        $query = "call SP_MANTENEDOR_SEDES(5,?,null,null,null,null,null,null,null,@resultado)";
        $database = new Database();
        error_log("DATOS SP_MANTENEDOR_SEDES SP -> ".$id);
        $conexion = $database->connect();
        $sentencia = $conexion->prepare($query);
        $sentencia -> bindParam(1,$id);

        $sentencia -> execute();
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $result;
   }

   public function editarSede($data,$id){
        $query = "call SP_MANTENEDOR_SEDES(3,?,?,?,?,?,?,?,?,@resultado)";
        error_log("editar SP_MANTENEDOR_SEDES SP -> ".$query." - ".$id);
        error_log("editar SP_MANTENEDOR_SEDES SP -> ".json_encode($data));
        $database = new Database();

        $conexion = $database->connect();
        $sentencia = $conexion->prepare($query);
        $sentencia -> bindParam(1,$id);
        $sentencia -> bindParam(2,$data["IdEmpresa"]);
        $sentencia -> bindParam(3,$data["Nombre"]);
        $sentencia -> bindParam(4,$data["Ciudad"]);
        $sentencia -> bindParam(5,$data["Direccion"]);
        $sentencia -> bindParam(6,$data["Longitud"]);
        $sentencia -> bindParam(7,$data["Latitud"]);
        $sentencia -> bindParam(8,$data["IdUsuarioCreacion"]);

        $sentencia -> execute();
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function eliminarSede($UserId,$id){
        $query = "call SP_MANTENEDOR_SEDES(4,?,null,null,null,null,null,null,?,@resultado)";
        error_log("editar SP_MANTENEDOR_SEDES SP -> ".$query." - ".$id);
        $database = new Database();
    
        $conexion = $database->connect();
        $sentencia = $conexion->prepare($query);
        $sentencia -> bindParam(1,$id);
        $sentencia -> bindParam(2,$UserId);
    
        $sentencia -> execute();
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $result;
      }

}
