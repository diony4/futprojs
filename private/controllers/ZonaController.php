<?php
class ZonaController extends Controller
{
    public function index()
    {

         if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $zonas =  new Zona();

        $data = $zonas->listarZonaMP();
        error_log("ZonaController::index -> ".json_encode($data));

        $this->view('zonas/index', [
            'rows' => $data
            
        ]);
    }

	public function create()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $errors =  array();
        /*
        if (Auth::access('admin')) {
            $this->view('usuarios\create', [
                'crumbs' => $crumbs,
                'errors' => $errors
            ]);
        } else {
            $this->view('access-denied');
        } */

        $this->view('zonas/create', [
            'errors' => $errors
        ]);
    }

    public function store()
    {
        
        $errors =  array();
        if (count($_POST) > 0) {
            $zonas = new Zona();
        
            if ($zonas->validate($_POST)){
                  
                   
                    $_POST['IdUsuarioCreacion']= Auth::getIdUser();
                    error_log("datos :".json_encode($_POST));
                    $zonas->insertarZona($_POST);

                    $this->redirect('Zona');
                
            }else
            $errors = $zonas->errors;    
        }

        $this->view(
            'zonas/create',
            [
                'errors' => $errors
            ]
        );
    }

    public function edit($id = '')
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $zonas =  new Zona();
        $data = $zonas->buscarZonaId(intval($id));
        error_log("buscarZonaId::show -> ".json_encode($data));

        $errors =  array();

        $this->view(
            'zonas/edit',
            [
                'row' => $data[0],
                'errors' => $errors
            ]
        );
    }

    public function update($id = '')
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $errors = array();
      
        $zonas = new Zona();
        $data = $zonas->buscarZonaId(intval($id));

        if (count($_POST) > 0) {

            if ($zonas->validate($_POST, $id)) {
                $_POST['IdUsuarioCreacion']= Auth::getIdUser();
                error_log("editarZona::show -> ".json_encode($_POST));
                $zonas->editarZona($_POST,intval($id));
                $this->redirect('Zona');
            } else {
                $errors = $zonas->errors;
            }
        }

        $this->view('zonas/edit', [
            'row' => $data,
            'errors' => $errors
        ]);
    }

    public function destroy($id = '')
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $zonas = new Zona();
        $errors = array();

        if (count($_GET) > 0) {  //Auth::access('super_admin')
            error_log("borrar");
            $userId = Auth::getIdUser();
            $zonas->eliminarZona(intval($userId),intval($id));
            $this->redirect('Zona');
        }

        $row =$zonas->listarZonaMP();

        //if (Auth::access('super_admin')) {
            $this->view('zonas/delete', [
                'row' => $row
            ]);
       /* } else {
            $this->view('access-denied');
        }*/
    }

    public function listar(){
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $zonas = new Zona();
        $row =$zonas->listarZonaMP();

        echo json_encode($row);

    }
    
    //detalle zona 
    
        public function obtenerdetallezona()
    {

         if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $detallezona =  new DetalleZona();

        $data = $detallezona->buscarDetelleZonaId($_POST);
         error_log("DetalleZonaController::obtener -> ".json_encode($data));

        echo json_encode($data);
    }
    
    
        public function guardardetallezona()
    {

         if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $detallezona =  new DetalleZona();

        $data = $detallezona->insertarDetalleZona($_POST);
        error_log("DetalleZonaController::guardar -> ".json_encode($data));

        echo json_encode($data);
    }



    public function eliminardetallezona()
    {

         if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $detallezona =  new DetalleZona();

        $data = $detallezona->eliminarDetalleZona($_POST);
        

        echo json_encode($data);
    }



    
    
}