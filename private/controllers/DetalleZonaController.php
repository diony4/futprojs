<?php
class DetalleZonaController extends Controller
{
    public function guardar()
    {

         if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $detallezona =  new DetalleZona();

        $data = $detallezona->insertarDetalleZona($_POST);
        error_log("DetalleZonaController::guardar -> ".json_encode($data));

        echo json_encode($data);
    }


    public function obtener()
    {

         if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $detallezona =  new DetalleZona();

        $data = $detallezona->buscarDetelleZonaId($_POST);
         error_log("DetalleZonaController::obtener -> ".json_encode($data));

        echo json_encode($data);
    }

    public function eliminar()
    {

         if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $detallezona =  new DetalleZona();

        $data = $detallezona->eliminarDetalleZona($_POST);
        

        echo json_encode($data);
    }


    public function listar(){
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $zonas = new Zona();
        $row =$zonas->listarZonaMP();

        echo json_encode($row);

    }
}