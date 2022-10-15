<?php

/**
 * User Model
 */
class Empresa extends Model
{
    public $verId = "IdEmpresa";
    protected $allowedColumns = [
        'Nombre',
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


        if(empty($DATA['Nombre'])){
            $this->errors['Nombre'] = "Agregar un nombre";
        }

        //verifica si existe el nombre del sistema
        if (trim($id) == "") {
            if ($this->where('Nombre', $DATA['Nombre'])) {
                $this->errors['Nombre'] = "El nombre de la empresa ya existe";
            }
        } else {
            if ($this->query("select Nombre from $this->table where Nombre = :nombre && IdEmpresa != :id","", ['nombre' => $DATA['Nombre'], 'id' => $id])) {
                $this->errors['Nombre'] = "El nombre ya esta en uso";
            }
        }

        if (count($this->errors) == 0) {
            return true;
        }

        return false;
    }

    public function listarEmpresasMP(){
        $query = "call SP_MANTENEDOR_EMPRESA(1,null,null,null,@resultado)";

        $result = $this->ejecutarSP($query,"select");
        error_log("DATOS SP_MANTENEDOR_EMPRESA SP -> ".json_encode($result));
        return $result;
    }

   public function insertarEmpresa($data){
     $query = "call SP_MANTENEDOR_EMPRESA(2,0,?,?,@resultado)";
     $database = new Database();

     $conexion = $database->connect();
	 $sentencia = $conexion->prepare($query);
     $sentencia -> bindParam(1,$data["Nombre"]);
     $sentencia -> bindParam(2,$data["IdUsuarioCreacion"]);

     $sentencia -> execute();
     $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
     return $result;
   }

   public function buscarEmpresaId($id){
        $query = "call SP_MANTENEDOR_EMPRESA(5,?,null,null,@resultado)";
        $database = new Database();
        error_log("DATOS SP_MANTENEDOR_EMPRESA SP -> ".$id);
        $conexion = $database->connect();
        $sentencia = $conexion->prepare($query);
        $sentencia -> bindParam(1,$id);

        $sentencia -> execute();
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $result;
   }

   public function editarEmpresa($data,$id){
    $query = "call SP_MANTENEDOR_EMPRESA(3,?,?,?,@resultado)";
    error_log("editar SP_MANTENEDOR_EMPRESA SP -> ".$query." - ".$id);
    error_log("editar SP_MANTENEDOR_EMPRESA SP -> ".json_encode($data));
    $database = new Database();

    $conexion = $database->connect();
    $sentencia = $conexion->prepare($query);
    $sentencia -> bindParam(1,$id);
    $sentencia -> bindParam(2,$data["Nombre"]);
    $sentencia -> bindParam(3,$data["IdUsuarioCreacion"]);

    $sentencia -> execute();
    $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  public function eliminarEmpresa($UserId,$id){
    $query = "call SP_MANTENEDOR_EMPRESA(4,?,null,?,@resultado)";
    error_log("editar SP_MANTENEDOR_EMPRESA SP -> ".$query." - ".$id);
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
