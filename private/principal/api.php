<?php 

switch ($_GET["op"]) {

    case 'guardarRol':
        $descripcion = $_POST["Descripcion"];
        $permisos = $_POST["Permisos"];
        error_log("API::guardarRol descripcion-> ".$descripcion);
        error_log("API::guardarRol permisos-> ".$permisos);
        echo 'si llego';
        break;
}
?>