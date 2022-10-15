<?php
class SistemaController extends Controller
{
    public function index()
    {

         if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $sistemas =  new Sistemas();

        $data = $sistemas->listarSistemas();
        error_log("SISTEMACONTROLLER::index -> ".json_encode($data));

        $this->view('sistemas/index', [
            'rows' => $data
            
        ]);
    }

	public function create()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $errors =  array();
        $sistemas =  new Sistemas();
        $tipos = $sistemas->listarTiposDeSistemas();
        /*
        if (Auth::access('admin')) {
            $this->view('usuarios\create', [
                'crumbs' => $crumbs,
                'errors' => $errors
            ]);
        } else {
            $this->view('access-denied');
        } */

        $this->view('sistemas/create', [
            'errors' => $errors,
            'tipos'=> $tipos
        ]);
    }

    public function store()
    {
        
        $errors =  array();
        if (count($_POST) > 0) {
            $sistemas = new Sistemas();
        
            if ($sistemas->validate($_POST)){
                  
                    error_log("datos :".json_encode($_POST));
                    $_POST['IdUsuarioCreacion']= Auth::getIdUser();
                    $sistemas->insert($_POST,$sistemas->verId);

                    $this->redirect('Sistema');
                
            }else
            $errors = $sistemas->errors;    
        }



        $this->view(
            'sistemas/create',
            [
                'errors' => $errors
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

        $sistemas =  new Sistemas();
        $data = $sistemas->traerSistemaId($id);
        $sistemas =  new Sistemas();
        $tipos = $sistemas->listarTiposDeSistemas();
        $errors =  array();

        $this->view(
            'sistemas/edit',
            [
                'row' => $data,
                'errors' => $errors,
                'tipos'=>$tipos
            ]
        );
    }

    public function update($id = '')
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $errors = array();
        $id = trim($id == '') ? Auth::getUser_id() : $id;
        $user = new Usuario();
        $data =  $user->first('IdUsuario',$id);
        $persona = new Persona();


        if (count($_POST) > 0) {

            if ($user->validate($_POST, $id)) {
                if ($persona->validate($_POST, $data->id)){
                    if ($myimage = upload_image($_FILES)) {
                        $_POST['image'] = $myimage;
                    }
                    $_POST['date'] = date("Y-m-d H:i:s");
                    $user->update($id, $_POST,$user->verId);
                    $persona->update(intval($data->id), $_POST,$persona->verId);
                    $this->redirect('Usuario');
                }else{
                    $errors = $persona->errors;    
                }
               
            } else {
                $errors = $user->errors;
            }
        }

        $this->view('usuarios/edit', [
            'row' => $data,
            'errors' => $errors
        ]);
    }

    public function destroy($id = '')
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $sistemas= new Sistemas();
        $errors = array();

        if (count($_GET) > 0) {  //Auth::access('super_admin')
            error_log("borrar");
            $sistemas->delete('IdSistema',$id);
            $this->redirect('Sistema');
        }

        $row = $sistemas->first('IdSistema', $id);

        //if (Auth::access('super_admin')) {
            $this->view('sistemas/delete', [
                'row' => $row
            ]);
       /* } else {
            $this->view('access-denied');
        }*/
    }
}