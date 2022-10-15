<?php
class EmpresaController extends Controller
{
    public function index()
    {

        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $empresas =  new Empresa();

        $data = $empresas->listarEmpresasMP();
        error_log("EmpresaController::index -> " . json_encode($data));

        $this->view('empresas/index', [
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

        $this->view('empresas/create', [
            'errors' => $errors
        ]);
    }

    public function store()
    {

        $errors =  array();

        if (count($_POST) > 0) {
            $empresa = new Empresa();

            if ($empresa->validate($_POST)) {

                error_log("datos store empresa :" . json_encode($_POST));
                $_POST['IdUsuarioCreacion'] = Auth::getIdUser();
                //$empresa->insert($_POST,$empresa->verId);
                $empresa->insertarEmpresa($_POST);

                $this->redirect('Empresa');
            } else
                $errors = $empresa->errors;
        }



        $this->view(
            'empresas/create',
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

        $empresa =  new Empresa();
        $data = $empresa->buscarEmpresaId(intval($id));
        $errors =  array();
        error_log("Empresa::show -> " . json_encode($data));
        $this->view(
            'empresas/edit',
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

        $empresas = new Empresa();
        $data = $empresas->buscarEmpresaId(intval($id));

        if (count($_POST) > 0) {

            if ($empresas->validate($_POST, $id)) {
                $_POST['IdUsuarioCreacion'] = Auth::getIdUser();
                $empresas->editarEmpresa($_POST, intval($id));
                $this->redirect('Empresa');
            } else {
                $errors = $empresas->errors;
            }
        }

        $this->view('empresas/edit', [
            'row' => $data,
            'errors' => $errors
        ]);
    }

    public function destroy($id = '')
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $empresas = new Empresa();
        $errors = array();

        if (count($_GET) > 0) {  //Auth::access('super_admin')
            error_log("borrar");
            $userId = Auth::getIdUser();
            $empresas->eliminarEmpresa(intval($userId), intval($id));
            $this->redirect('Empresa');
        }

        $row = $empresas->listarEmpresasMP();

        //if (Auth::access('super_admin')) {
        $this->view('empresas/delete', [
            'row' => $row
        ]);
        /* } else {
            $this->view('access-denied');
        }*/
    }
}
