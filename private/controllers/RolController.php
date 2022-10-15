<?php
class RolController extends Controller
{
    public function index()
    {

         if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $roles =  new Rol();

        $data = $roles->listarRoles();
        error_log("ROL CONTROLLER::index -> ".json_encode($data));

        $this->view('roles/index', [
            'rows' => $data
            
        ]);
    }

	public function create()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $errors =  array();
        $roles =  new Rol();
        $opciones = $roles->listarOpciones();
        //$tipos = $roles->Permisos();
        /*
        if (Auth::access('admin')) {
            $this->view('usuarios\create', [
                'crumbs' => $crumbs,
                'errors' => $errors
            ]);
        } else {
            $this->view('access-denied');
        } */

        $this->view('roles/create', [
            'errors' => $errors,
            'opciones'=>$opciones
        ]);
    }

    public function store()
    {
        error_log("datos rol ::store :".json_encode($_POST));
        $errors =  array();
        if (count($_POST) > 0) {
            $roles = new Rol();
        
            if ($roles->validate($_POST)){
                  
                    error_log("datos :".json_encode($_POST));
                    $_POST['IdUsuarioCreacion']= Auth::getIdUser();
                    $roles->insertarRoles($_POST);

                    echo "exito";
                
            }else
            $errors = $roles->errors; 
           
        }



        error_log("ROL VALIDADO ERRORES -> ".json_encode($errors));   
        echo json_encode($errors);
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