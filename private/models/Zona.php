<?php

/**
 * User Model
 */
class Zona extends Model
{
    public $verId = "IdZona";
    protected $allowedColumns = [
        'Nombre',
        'Descripcion',
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


        
        if (empty($DATA['Nombre'])) {
            $this->errors['Nombre'] = "Ingresar un nombre";
        
        }

        if (empty($DATA['Descripcion'])) {
            $this->errors['Descripcion'] = "Ingresar una descripcion";
        
        }
      


        if (count($this->errors) == 0) {
            return true;
        }

        return false;
    }



    public function listarZonaMP(){
        $query = "call SP_MANTENEDOR_ZONAS(1,null,null,null,null,@resultado)";

        $result = $this->ejecutarSP($query,"select");
        error_log("DATOS USUARIO SP -> ".json_encode($result));
        return $result;
    }

    public function insertarZona($data){
        $query = "call SP_MANTENEDOR_ZONAS(2,0,?,?,?,@resultado)";
        $database = new Database();
      
        $conexion = $database->connect();
        $sentencia = $conexion->prepare($query);
        $sentencia -> bindParam(1,$data["Nombre"]);
        $sentencia -> bindParam(2,$data["Descripcion"]);
        $sentencia -> bindParam(3,$data["IdUsuarioCreacion"]);
   
        $sentencia -> execute();
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $result;
      }

      public function buscarZonaId($id){
        $query = "call SP_MANTENEDOR_ZONAS(5,?,null,null,null,@resultado)";
        $database = new Database();
        error_log("DATOS SP_MANTENEDOR_ZONAS SP -> ".$id);
        $conexion = $database->connect();
        $sentencia = $conexion->prepare($query);
        $sentencia -> bindParam(1,$id);

        $sentencia -> execute();
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $result;
   }

   public function editarZona($data,$id){
        $query ="call SP_MANTENEDOR_ZONAS(3,?,?,?,?,@resultado)";
        error_log("editar SP_MANTENEDOR_ZONAS SP -> ".$query." - ".$id);
        error_log("editar SP_MANTENEDOR_ZONAS SP -> ".json_encode($data));
        $database = new Database();

        $conexion = $database->connect();
        $sentencia = $conexion->prepare($query);
        $sentencia -> bindParam(1,$id);
        $sentencia -> bindParam(2,$data["Nombre"]);
        $sentencia -> bindParam(3,$data["Descripcion"]);
        $sentencia -> bindParam(4,$data["IdUsuarioCreacion"]);

        $sentencia -> execute();
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function eliminarZona($UserId,$id){
        $query ="call SP_MANTENEDOR_ZONAS(4,?,null,null,?,@resultado)";
        error_log("editar SP_MANTENEDOR_ZONAS SP -> ".$query." - ".$id);
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
