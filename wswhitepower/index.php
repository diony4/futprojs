<?php
require_once 'Modelos/usuarios.modelo.php';
require_once 'Modelos/eventos.modelo.php';
require_once 'Modelos/promociones.modelo.php';
require_once 'Modelos/tarjeta.modelo.php';
require_once 'Modelos/favoritos.modelo.php';
require_once 'Modelos/ventas.modelo.php';
require_once 'Modelos/zona.modelo.php';

$requestMethod = $_SERVER["REQUEST_METHOD"];
switch ($requestMethod) {
    case 'GET':
        $OPCIONOBJETO = $_GET['OpcionObjeto'];
        $OPCION = $_GET['Opcion'];

        switch ($OPCIONOBJETO) {
            case 1:
                //USUARIOS
                switch ($OPCION) {
                        //LISTAR USUARIOS
                    case 1:
                        ModeloUsuarios::DAO_MostrarUsuarios();
                        break;

                        //INICIAR SESION
                    case 2:
                        $Usuario = $_GET['Usuario'];
                        $Clave = $_GET['Clave'];
                        $ind = $_GET['ind'];
                        ModeloUsuarios::DAO_validarUsuario($Usuario, $Clave,$ind);

                        break;

                        //LISTAR USUARIO
                    case 3:
                        $Usuario = $_GET['IdUsuario'];
                        ModeloUsuarios::DAO_ListarUsuario($Usuario);
                        break;


                    default:
                        header("HTTP/1.0 405 Method Not Allowed");
                }
                break;

                //EVENTOS
            case 2:
                switch ($OPCION) {
                        //LISTAR EVENTOS
                    case 1:
                        ModeloEventos::DAO_MostrarEventos();
                        break;

                        //BUSCAR EVENTO 
                    case 2:
                        $idEvento = $_GET['IdEvento'];
                        ModeloEventos::DAO_BuscarEvento($idEvento);
                        break;


                    default:
                        header("HTTP/1.0 405 Method Not Allowed");
                }
                break;

                //PROMOCIONES
            case 3:
                switch ($OPCION) {
                        //LISTAR PROMOCIONES
                    case 1:
                        ModeloPromociones::DAO_MostrarPromociones();
                        break;

                        //BUSCAR PROMOCION 
                    case 2:
                        $IdPromocion = $_GET['IdPromocion'];
                        ModeloPromociones::DAO_BuscarPromocion($IdPromocion);
                        break;


                    default:
                        header("HTTP/1.0 405 Method Not Allowed");
                }
                break;

                //TARJETAS
            case 4:
                switch ($OPCION) {
                        //LISTAR TARJETAS USUARIO
                    case 1:
                        $IdUsuario = $_GET['IdUsuario'];
                        ModeloTarjetas::DAO_MostrarTarjetasUsuario($IdUsuario);
                        break;

                        //BUSCAR TARJETA 
                    case 2:
                        $IdTarjeta = $_GET['IdTarjeta'];
                        ModeloTarjetas::DAO_BuscarTarjeta($IdTarjeta);
                        break;


                    default:
                        header("HTTP/1.0 405 Method Not Allowed");
                }
                break;

                //FAVORITOS
            case 5:
                switch ($OPCION) {
                        //LISTAR EVENTOS FAVORITOS DE UN USUARIO
                    case 1:
                        $IdUsuario = $_GET['IdUsuario'];
                        ModeloFavoritos::DAO_ListarEventosFavoritosDeUnUsuario($IdUsuario);
                        break;

                    default:
                        header("HTTP/1.0 405 Method Not Allowed");
                }
                break;

                //VENTAS
            case 6:
                switch ($OPCION) {
                        //LISTAR VENTAS DE UN USUARIO
                    case 1:
                        $IdUsuario = $_GET['IdUsuario'];
                        ModeloVentas::DAO_ListarVentasUsuario($IdUsuario);
                        break;

                    default:
                        header("HTTP/1.0 405 Method Not Allowed");
                }
                break;

                //ZONAS
            case 7:
                switch ($OPCION) {
                        //LISTAR ZONAS
                    case 1:
                        
                        ModeloZona::DAO_MostrarZonas();
                        break;

                        //LISTAR ZONA POR ID
                    case 2:
                        $Id = $_GET['IdZona'];
                        ModeloZona::DAO_BuscarZona($Id);
                        break;

                    default:
                        header("HTTP/1.0 405 Method Not Allowed");
                }
                break;

            default:
                header("HTTP/1.0 405 Method Not Allowed");
        }

        break;

    case 'POST':

        $OPCIONOBJETO = $_GET['OpcionObjeto'];
        $OPCION = $_GET['Opcion'];

        switch ($OPCIONOBJETO) {
            case 1:
                //USUARIOS
                switch ($OPCION) {

                        //INSERTAR USUARIO
                    case 1:
                        $json = file_get_contents('php://input');
                        ModeloUsuarios::DAO_registrarUsuario($json);
                        break;

                        //EDITAR USUARIO
                    case 2:
                        $json = file_get_contents('php://input');
                        ModeloUsuarios::DAO_EditarUsuario($json);
                        break;

                        //ELIMINAR USUARIO
                    case 3:
                        $json = file_get_contents('php://input');
                        ModeloUsuarios::DAO_EliminarUsuario($json);
                        break;

                    default:
                        header("HTTP/1.0 405 Method Not Allowed");
                }
                break;

                //TARJETAS
            case 2:

                switch ($OPCION) {

                        //INSERTAR TARJETA
                    case 1:
                        $json = file_get_contents('php://input');
                        ModeloTarjetas::DAO_registrarTarjeta($json);
                        break;

                        //EDITAR TARJETA
                    case 2:
                        $json = file_get_contents('php://input');
                        ModeloTarjetas::DAO_EditarTarjeta($json);
                        break;

                        //ELIMINAR TARJETA
                    case 3:
                        $json = file_get_contents('php://input');
                        ModeloTarjetas::DAO_EliminarTarjeta($json);
                        break;

                    default:
                        header("HTTP/1.0 405 Method Not Allowed");
                }
                break;

                //FAVORITOS
            case 3:
                switch ($OPCION) {
                        //AGREGAR EVENTOS FAVORITOS DE UN USUARIO
                    case 1:
                        $json = file_get_contents('php://input');
                        ModeloFavoritos::DAO_AgregarEventoFavoritoUsuario($json);
                        break;

                    default:
                        header("HTTP/1.0 405 Method Not Allowed");
                }

                break;

                //VENTAS
            case 4:
                switch ($OPCION) {
                        //AGREGAR VENTA
                    case 1:
                        $json = file_get_contents('php://input');
                        ModeloVentas::DAO_AgregarVenta($json);
                        break;

                    default:
                        header("HTTP/1.0 405 Method Not Allowed");
                }

                break;
            default:
                header("HTTP/1.0 405 Method Not Allowed");
        }
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
