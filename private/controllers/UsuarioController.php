<?php
class UsuarioController extends Controller
{
    public function index()
    {

         if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $usuario =  new Usuario();
        $datosUsuario = Auth::getUser();
        if($datosUsuario["IdEmpresa"]==1){
            $data = $usuario->listarUsuariosPersonas(1,0);
            error_log("USUARIOCONTROLLER::index -> ".json_encode($data));
        }else{
            $data = $usuario->listarUsuariosPersonas(8,$datosUsuario["IdEmpresa"]);
            error_log("USUARIOCONTROLLER::index -> ".json_encode($data));
        }
        
        
        $this->view('usuarios/index', [
            'rows' => $data
        ]);
    }

	public function create()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $errors =  array();
        $rol = new Rol();
        $empresa = new Empresa();
        /*
        if (Auth::access('admin')) {
            $this->view('usuarios\create', [
                'crumbs' => $crumbs,
                'errors' => $errors
            ]);
        } else {
            $this->view('access-denied');
        } */
        $roles = $rol->listarRoles();
        $empresas = $empresa->listarEmpresasMP();
        $this->view('usuarios/create', [
            'errors' => $errors,
            'roles'=>$roles,
            'empresas'=>$empresas
        ]);
    }

    public function validar(){
        $rol = new Rol();
        $errors =  array();
        if (count($_POST) > 0) {
            $persona = new Persona();
            $usuario =  new Usuario();
            if ($persona->validate($_POST)){
                if ($usuario->validate($_POST)) {
                    
                    echo "ok";
                }else
                    $errors = $usuario->errors;    
            }else
            $errors = $persona->errors;    
        }

        echo json_encode($errors);

    }

    public function validareditar(){

        $rol = new Rol();
        $errors =  array();
        if (count($_POST) > 0) {
            $persona = new Persona();
            $usuario =  new Usuario();
            if ($persona->validate($_POST)){
              
                if ($usuario->validateEditar($_POST)) {
                
                    echo "ok";
                }else
                   
                    $errors = $usuario->errors;    
            }else
           
            $errors = $persona->errors;    
        }
       
        echo json_encode($errors);

    }

    public function store()
    {
        $rol = new Rol();
        $errors =  array();
        if (count($_POST) > 0) {
            $persona = new Persona();
            $usuario =  new Usuario();
            if ($persona->validate($_POST)){
                if ($usuario->validate($_POST)) {
                    
                    error_log("datos :".json_encode($_POST));
                    $_POST['IdCiudad']= 1;
                    $_POST['Direccion']= "NN";
                    $_POST['CodigoPostal']= "NN";
                    $_POST['IdTipoRegistro']= 1;
                    $usuario->guardarUsuario($_POST);

                    echo "ok";
                }else
                    $errors = $usuario->errors;    
            }else
            $errors = $persona->errors;    
        }


        echo json_encode($errors);
    }

    public function show($id = '')
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }


        $usuario =  new Usuario();
        $data = $usuario->listarUsuariosPorId($id);
        error_log("USARIOS::show -> ".json_encode($data));
        $this->view(
            'usuarios/show',
            [
                'row' => $data[0]

            ]
        );
    }

    public function edit($id = null)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $usuario =  new Usuario();
        $empresa = new Empresa();
        $data = $usuario->listarUsuariosPorId($id);
        error_log("EDITAR USUARIO -> ".json_encode($data));
        $rol = new Rol();
        $errors =  array();
        $roles = $rol->listarRoles();
        $empresas = $empresa->listarEmpresasMP();
        $this->view(
            'usuarios/edit',
            [
                'row' => $data[0],
                'errors' => $errors,
                'roles'=>$roles,
                'empresas'=>$empresas
            ]
        );
    }

    public function update($id = '')
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        error_log("update ".$id);
        $id = trim($id == '') ? Auth::getUser_id() : $id;
        $user = new Usuario();

        if (count($_POST) > 0) {
            error_log("editarUsuario ".json_encode($_POST));
            $user->editarUsuario($_POST,$id);    
            echo 'ok';
               
          
        }

    }

    public function destroy($id = '')
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $user = new Usuario();
        $errors = array();

        if (count($_GET) > 0) {  //Auth::access('super_admin')
            error_log("borrar");
            $user->delete('IdUsuario',$id);
            $this->redirect('Usuario');
        }

        $row = $user->first('IdUsuario', $id);

        //if (Auth::access('super_admin')) {
            $this->view('usuarios/delete', [
                'row' => $row
            ]);
       /* } else {
            $this->view('access-denied');
        }*/
    }

    public function activar($id = '')
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $user = new Usuario();
       

        if (count($_GET) > 0) {  //Auth::access('super_admin')
            error_log("borrar");
            $user->activarUsuario($id);
            $this->redirect('Usuario');
        }

      
    }
}