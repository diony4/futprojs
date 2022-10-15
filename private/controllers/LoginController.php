<?php

class LoginController extends Controller{

    function index()
	{
		$errors = array();
		error_log("login::usuario -> " . $_POST['UserName']);
		error_log("login::clave -> " . $_POST['Clave']);
		if(count($_POST) > 0)
 		{
            $user = new Usuario();
 			if($row = $user->where('UserName',$_POST['UserName']))
 			{
 				$row = $row[0];
				error_log("INICIAR SESION::DATOS DEL USUARIO -> ".json_encode($row));
				$sesion = $user->iniciarSesion($_POST);
				error_log("INICIAR SESION::DATOS DEL sesion -> ".json_encode($sesion));
 				if(!empty($sesion))
 				{
					$permisos = $user->listarPermisosUsuario($row->IdUsuario);
					Auth::authenticate($sesion[0],$permisos);
 					$this->redirect('/inicio');	
 				}else{
					$errors['pass'] = "Password incorrecto";
				}
 			} else {
				$errors['email'] = "Usuario incorrecto";
			}
 		}
		// $this->redirect('/inicio');	
		
		$this->view('login',[
			'errors'=>$errors,
		]);
	}
	
	//para ver el password generado
	public function passhash($password){
		$passhash =  password_hash($password, PASSWORD_DEFAULT);
		echo $passhash;
	}

}