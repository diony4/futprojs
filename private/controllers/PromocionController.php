<?php
class PromocionController extends Controller
{
    public function index()
    {

         if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $promociones =  new Promocion();

        $data = $promociones->listarPromocionesMP();
        error_log("PromocionController::index -> ".json_encode($data));

        $this->view('promociones/index', [
            'rows' => $data
            
        ]);
    }

	public function create()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $errors =  array();
        $eventos =  new Evento();
        $events = $eventos->listarEventosMP();
        /*
        if (Auth::access('admin')) {
            $this->view('usuarios\create', [
                'crumbs' => $crumbs,
                'errors' => $errors
            ]);
        } else {
            $this->view('access-denied');
        } */

        $this->view('promociones/create', [
            'errors' => $errors,
            'eventos'=> $events
        ]);
    }

    public function store()
    {
        
        $errors =  array();
        if (count($_POST) > 0) {
            $promociones = new Promocion();
        
            if ($promociones->validate($_POST)){
                  
                   
                    $_POST['IdUsuarioCreacion']= Auth::getIdUser();
                  
                    error_log("datos :".json_encode($_POST));
                    $promociones->insertarPromocion($_POST);

                    $this->redirect('Promocion');
                
            }else
            $errors = $promociones->errors;    
        }

        $eventos =  new Evento();
        $events = $eventos->listarEventosMP();

        $this->view(
            'promociones/create',
            [
                'errors' => $errors,
                'eventos'=> $events
            ]
        );
    }

    public function show($id = null)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }


        $sistemas =  new Sistemas();
        $data = $sistemas->traerSistemaId($id);
        error_log("SISTEMAS::show -> ".json_encode($data));
        $this->view(
            'sistemas/show',
            [
                'row' => $data

            ]
        );
    }

    public function edit($id = null)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $promociones =  new Promocion();
        $data = $promociones->buscarPromocionId(intval($id));
        error_log("buscarPromocionId::show -> ".json_encode($data));
        $eventos =  new Evento();
        $events = $eventos->listarEventosMP();
        $errors =  array();

        $this->view(
            'promociones/edit',
            [
                'row' => $data[0],
                'errors' => $errors,
                'eventos'=>$events
            ]
        );
    }

    public function update($id = '')
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $errors = array();
      
        $promociones = new Promocion();
        $data = $promociones->buscarPromocionId(intval($id));

        if (count($_POST) > 0) {

            if ($promociones->validate($_POST, $id)) {
                $_POST['IdUsuarioCreacion']= Auth::getIdUser();
            
                error_log("editarPromocion::show -> ".json_encode($_POST));
                $promociones->editarPromocion($_POST,intval($id));
                $this->redirect('Promocion');
            } else {
                $errors = $promociones->errors;
            }
        }

        $this->view('promociones/edit', [
            'row' => $data,
            'errors' => $errors
        ]);
    }

    public function destroy($id = '')
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $promociones = new Promocion();
        $errors = array();

        if (count($_GET) > 0) {  //Auth::access('super_admin')
            error_log("borrar");
            $userId = Auth::getIdUser();
            $promociones->eliminarPromocion(intval($userId),intval($id));
            $this->redirect('Promocion');
        }

        $row =$promociones->listarPromocionesMP();

        //if (Auth::access('super_admin')) {
            $this->view('promociones/delete', [
                'row' => $row
            ]);
       /* } else {
            $this->view('access-denied');
        }*/
    }
}