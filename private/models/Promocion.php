<?php

/**
 * User Model
 */
class Promocion extends Model
{
    public $verId = "IdEvento";
    protected $allowedColumns = [
        'IdEvento',
        'Tipo',
        'Titulo',
        'Descripcion',
        'FechaInicioPromocion',
        'FechaFinPromocion',
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
            $this->errors['Titulo'] = "Ingresar un titulo";
        
        }

        if (empty($DATA['Descripcion'])) {
            $this->errors['Descripcion'] = "Ingresar una descripcion";
        
        }
        if (empty($DATA['Tipo'])) {
            $this->errors['	Tipo'] = "Ingresar un tipo";
        
        }
        if (empty($DATA['FechaInicioPromocion'])) {
            $this->errors['FechaInicioPromocion'] = "Ingresar una fecha de inicio";
        
        }
        if (empty($DATA['FechaFinPromocion'])) {
            $this->errors['FechaFinPromocion'] = "Ingresar una fecha de fin";
        
        }

        //verifica el tipo de sistema
       

        if (count($this->errors) == 0) {
            return true;
        }

        return false;
    }



    public function listarPromocionesMP(){
        $query = "call SP_MANTENEDOR_PROMOCIONES(1,null,null,null,null,null,null,null,null,@resultado)";

        $result = $this->ejecutarSP($query,"select");
        error_log("DATOS listarPromocionesMP SP -> ".json_encode($result));
        return $result;
    }

    public function insertarPromocion($data){
        $query = "call SP_MANTENEDOR_PROMOCIONES(2,0,?,?,?,?,?,?,?,@resultado)";
        $database = new Database();

        $conexion = $database->connect();
        $sentencia = $conexion->prepare($query);
        $sentencia -> bindParam(1,$data["IdEvento"]);
        $sentencia -> bindParam(2,$data["Tipo"]);
        $sentencia -> bindParam(3,$data["Titulo"]);
        $sentencia -> bindParam(4,$data["Descripcion"]);
        $sentencia -> bindParam(5,$data["IdUsuarioCreacion"]);
        $sentencia -> bindParam(6,$data["FechaInicioPromocion"]);
        $sentencia -> bindParam(7,$data["FechaFinPromocion"]);
   
        $sentencia -> execute();
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $result;
      }

      public function buscarPromocionId($id){
        $query = "call SP_MANTENEDOR_PROMOCIONES(5,?,null,null,null,null,null,null,null,@resultado)";
        $database = new Database();
        error_log("DATOS SP_MANTENEDOR_PROMOCIONES SP -> ".$id);
        $conexion = $database->connect();
        $sentencia = $conexion->prepare($query);
        $sentencia -> bindParam(1,$id);

        $sentencia -> execute();
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $result;
   }

   public function editarPromocion($data,$id){
    $query = "call SP_MANTENEDOR_PROMOCIONES(3,?,?,?,?,?,?,?,?,@resultado)";
        error_log("editar SP_MANTENEDOR_PROMOCIONES SP -> ".$query." - ".$id);
        error_log("editar SP_MANTENEDOR_PROMOCIONES SP -> ".json_encode($data));
        $database = new Database();

        $conexion = $database->connect();
        $sentencia = $conexion->prepare($query);
        $sentencia -> bindParam(1,$id);
        $sentencia -> bindParam(2,$data["IdEvento"]);
        $sentencia -> bindParam(3,$data["Tipo"]);
        $sentencia -> bindParam(4,$data["Titulo"]);
        $sentencia -> bindParam(5,$data["Descripcion"]);
        $sentencia -> bindParam(6,$data["IdUsuarioCreacion"]);
        $sentencia -> bindParam(7,$data["FechaInicioPromocion"]);
        $sentencia -> bindParam(8,$data["FechaFinPromocion"]);

        $sentencia -> execute();
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function eliminarPromocion($UserId,$id){
        $query = "call SP_MANTENEDOR_PROMOCIONES(4,?,null,null,null,null,?,null,null,@resultado)";
        error_log("editar SP_MANTENEDOR_PROMOCIONES SP -> ".$query." - ".$id);
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
