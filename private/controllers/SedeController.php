<?php
class SedeController extends Controller
{
    public function index()
    {

         if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $sedes =  new Sede();

        $data = $sedes->listarSedesMP();
        error_log("EventoController::index -> ".json_encode($data));

        $this->view('sedes/index', [
            'rows' => $data
            
        ]);
    }

	public function create()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $errors =  array();
        $empresas =  new Empresa();
        $empresas = $empresas->listarEmpresasMP();
        /*
        if (Auth::access('admin')) {
            $this->view('usuarios\create', [
                'crumbs' => $crumbs,
                'errors' => $errors
            ]);
        } else {
            $this->view('access-denied');
        } */

        $this->view('sedes/create', [
            'errors' => $errors,
            'empresas'=> $empresas
        ]);
    }

    public function store()
    {
        
        $errors =  array();
        if (count($_POST) > 0) {
            $sedes = new Sede();
        
            if ($sedes->validate($_POST)){
                  
                   
                
                    $_POST['IdUsuarioCreacion']= Auth::getIdUser();
                    $sedes->insertarSede($_POST);

                    $this->redirect('Sede');
                
            }else
            $errors = $sedes->errors;    
        }



        $this->view(
            'sedes/create',
            [
                'errors' => $errors
            ]
        );
    }


    public function edit($id = null)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $sedes =  new Sede();
        $data = $sedes->buscarSedeId(intval($id));
        error_log("buscarSedeId :".json_encode($data));
        $empresas =  new Empresa();
        $tipos = $empresas->listarEmpresasMP();
        $errors =  array();

        $this->view(
            'sedes/edit',
            [
                'row' => $data[0],
                'errors' => $errors,
                'empresas'=>$tipos
            ]
        );
    }

    public function update($id = '')
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $errors = array();
      
        $sedes = new Sede();
        $data = $sedes->buscarSedeId(intval($id));

        if (count($_POST) > 0) {

            if ($sedes->validate($_POST, $id)) {
                $_POST['IdUsuarioCreacion']= Auth::getIdUser();
                $sedes->editarSede($_POST,intval($id));
                $this->redirect('Sede');
            } else {
                $errors = $sedes->errors;
            }
        }

        $this->view('sedes/edit', [
            'row' => $data,
            'errors' => $errors
        ]);
    }

    public function destroy($id = '')
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $sedes = new Sede();
        $errors = array();

        if (count($_GET) > 0) {  //Auth::access('super_admin')
            error_log("borrar");
            $userId = Auth::getIdUser();
            $sedes->eliminarSede(intval($userId),intval($id));
            $this->redirect('Sede');
        }

        $row =$sedes->listarSedesMP();

        //if (Auth::access('super_admin')) {
            $this->view('sedes/delete', [
                'row' => $row
            ]);
       /* } else {
            $this->view('access-denied');
        }*/
    }
}