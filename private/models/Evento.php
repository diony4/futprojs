<?php

/**
 * User Model
 */
class Evento extends Model
{
    public $verId = "IdEvento";
    protected $allowedColumns = [
        'IdSede',
        'Titulo',
        'Descripcion',
        'Aforo',
        'Fecha',
        'Hora',
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


        
        if (empty($DATA['Titulo'])) {
            array_push($this->errors , "Ingresar un titulo");
        
        }

        if (empty($DATA['Descripcion'])) {
            array_push($this->errors ,"Ingresar una descripcion");
        
        }
        if (empty($DATA['Aforo'])) {
            array_push($this->errors , "Ingresar aforo");
        
        }
        if (empty($DATA['Fecha'])) {
            array_push($this->errors ,"Ingresar una fecha");
        
        }
        if (empty($DATA['Hora'])) {
            array_push($this->errors ,"Ingresar una hora");
        
        }
        //verifica el tipo de sistema
       
        error_log("IdSede -> ".json_encode($DATA));
        if (empty($DATA['IdSede'])) {
            array_push($this->errors , "Sede no valida");
        }

        if (count($this->errors) == 0) {
            return true;
        }

        return false;
    }



    public function listarEventosMP(){
        $query = "call SP_MANTENEDOR_EVENTOS(1,null,null,null,null,null,null,null,null,null,@resultado)";

        $result = $this->ejecutarSP($query,"select");
        error_log("DATOS USUARIO SP -> ".json_encode($result));
        return $result;
    }

    public function insertarEvento($data){
        $query = "call SP_MANTENEDOR_EVENTOS(2,0,?,?,?,?,?,?,?,?,@resultado)";
        $database = new Database();
        $idSede = intval($data["IdSede"]);
        $aforo = intval($data["Aforo"]);
        $conexion = $database->connect();
        $sentencia = $conexion->prepare($query);
        $sentencia -> bindParam(1,$idSede);
        $sentencia -> bindParam(2,$data["Titulo"]);
        $sentencia -> bindParam(3,$data["Descripcion"]);
        $sentencia -> bindParam(4,$aforo);
        $sentencia -> bindParam(5,$data["Fecha"]);
        $sentencia -> bindParam(6,$data["Hora"]);
        $sentencia -> bindParam(7,$data["IdUsuarioCreacion"]);
        $sentencia -> bindParam(8,$data["Imagen"]);
   
        $sentencia -> execute();
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $result;
      }

      public function buscarEventoId($id){
        $query = "call SP_MANTENEDOR_EVENTOS(5,?,null,null,null,null,null,null,null,null,@resultado)";
        $database = new Database();
        error_log("DATOS SP_MANTENEDOR_EVENTOS SP -> ".$id);
        $conexion = $database->connect();
        $sentencia = $conexion->prepare($query);
        $sentencia -> bindParam(1,$id);

        $sentencia -> execute();
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $result;
   }

   public function editarEvento($data,$id){
        $query ="call SP_MANTENEDOR_EVENTOS(3,?,?,?,?,?,?,?,?,?,@resultado)";
        error_log("editar SP_MANTENEDOR_EVENTOS SP -> ".$query." - ".$id);
        error_log("editar SP_MANTENEDOR_EVENTOS SP -> ".json_encode($data));
        $database = new Database();

        $conexion = $database->connect();
        $sentencia = $conexion->prepare($query);
        $sentencia -> bindParam(1,$id);
        $sentencia -> bindParam(2,$data["IdSede"]);
        $sentencia -> bindParam(3,$data["Titulo"]);
        $sentencia -> bindParam(4,$data["Descripcion"]);
        $sentencia -> bindParam(5,$data["Aforo"]);
        $sentencia -> bindParam(6,$data["Fecha"]);
        $sentencia -> bindParam(7,$data["Hora"]);
        $sentencia -> bindParam(8,$data["IdUsuarioCreacion"]);
        $sentencia -> bindParam(9,$data["Imagen"]);

        $sentencia -> execute();
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function eliminarEvento($UserId,$id){
        $query = "call SP_MANTENEDOR_EVENTOS(4,?,null,null,null,null,null,null,null,?,@resultado)";
        error_log("editar SP_MANTENEDOR_EVENTOS SP -> ".$query." - ".$id);
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
