<?php

/**
 * User Model
 */
class DetalleZona extends Model
{
    
    protected $allowedColumns = [
        'IdZona',
        'IdEvento',
        'Aforo',
        'Precio',
        'Flag'
    ];

    protected $beforeInsert = [
       
    ];

    protected $beforeUpdate = [
        
    ];

    protected $afterSelect = [
      
    ];




    public function insertarDetalleZona($data){
        $query = "call SP_MANTENEDOR_DETALLEZONA(2,?,?,?,?,@resultado)";
        $database = new Database();
      
        $conexion = $database->connect();
        $sentencia = $conexion->prepare($query);
        $sentencia -> bindParam(1,$data["IdZona"]);
        $sentencia -> bindParam(2,$data["IdEvento"]);
        $sentencia -> bindParam(3,$data["Aforo"]);
        $sentencia -> bindParam(4,$data["Precio"]);
   
        $sentencia -> execute();
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $result;
      }

      public function buscarDetelleZonaId($data){
        $query = "call SP_MANTENEDOR_DETALLEZONA(1,?,?,null,null,@resultado)";
        $database = new Database();

       
        $conexion = $database->connect();
        $sentencia = $conexion->prepare($query);
        $sentencia -> bindParam(1,$data["IdZona"]);
        $sentencia -> bindParam(2,$data["IdEvento"]);

        $sentencia -> execute();
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $result;
   }

    public function eliminarDetalleZona($data){
        $query = "call SP_MANTENEDOR_DETALLEZONA(4,?,?,null,null,@resultado)";
        $database = new Database();

    
        $conexion = $database->connect();
        $sentencia = $conexion->prepare($query);
        $sentencia -> bindParam(1,$data["IdZona"]);
        $sentencia -> bindParam(2,$data["IdEvento"]);

        $sentencia -> execute();
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


 
}
