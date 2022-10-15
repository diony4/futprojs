<?php
class EventoController extends Controller
{
    public function index()
    {

        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $evento =  new Evento();
        $zonas = new Zona();
        $data = $evento->listarEventosMP();
        $datazona = $zonas->listarZonaMP();
        error_log("EventoController::index -> " . json_encode($data));

        $this->view('eventos/index', [
            'rows' => $data,
            'zonas' => $datazona
        ]);
    }

    public function create()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $errors =  array();
        $sedes =  new Sede();
        $sedes = $sedes->listarSedesMP();
        /*
        if (Auth::access('admin')) {
            $this->view('usuarios\create', [
                'crumbs' => $crumbs,
                'errors' => $errors
            ]);
        } else {
            $this->view('access-denied');
        } */

        $this->view('eventos/create', [
            'errors' => $errors,
            'sedes' => $sedes
        ]);
    }

    public function validar()
    {

        $errors =  array();
        if (count($_POST) > 0) {
            $eventos = new Evento();

            if ($eventos->validate($_POST)) {


                echo "ok";
            } else
                $errors = $eventos->errors;
        }

        echo json_encode($errors);
    }

    public function validareditar()
    {

        $errors =  array();
        if (count($_POST) > 0) {
            $eventos = new Evento();

            if ($eventos->validate($_POST)) {


                echo "ok";
            } else
                $errors = $eventos->errors;
        }

        echo json_encode($errors);
    }

    public function store()
    {

        $errors =  array();
        if (count($_POST) > 0) {
            $eventos = new Evento();

            if ($eventos->validate($_POST)) {


                $_POST['IdUsuarioCreacion'] = Auth::getIdUser();
                error_log("datos :" . json_encode($_POST));
                $eventos->insertarEvento($_POST);

                echo "ok";
            } else
                $errors = $eventos->errors;
        }

        echo json_encode($errors);
    }

    public function show($id = null)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }


        $sistemas =  new Sistemas();
        $data = $sistemas->traerSistemaId($id);
        error_log("SISTEMAS::show -> " . json_encode($data));
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

        $eventos =  new Evento();
        $data = $eventos->buscarEventoId(intval($id));
        error_log("buscarEventoId::show -> " . json_encode($data));
        $sedes =  new Sede();
        $sedes = $sedes->listarSedesMP();
        $errors =  array();

        $this->view(
            'eventos/edit',
            [
                'row' => $data[0],
                'errors' => $errors,
                'sedes' => $sedes
            ]
        );
    }

    public function update($id = '')
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $errors = array();

        $eventos = new Evento();
        $data = $eventos->buscarEventoId(intval($id));

        if (count($_POST) > 0) {

            if ($eventos->validate($_POST, $id)) {
                $_POST['IdUsuarioCreacion'] = Auth::getIdUser();
                error_log("editarEvento::show -> " . json_encode($_POST));
                $eventos->editarEvento($_POST, intval($id));
                $this->redirect('Evento');
            } else {
                $errors = $eventos->errors;
            }
        }

        $this->view('eventos/edit', [
            'row' => $data,
            'errors' => $errors
        ]);
    }

    public function destroy($id = '')
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $eventos = new Evento();
        $errors = array();

        if (count($_GET) > 0) {  //Auth::access('super_admin')
            error_log("borrar");
            $userId = Auth::getIdUser();
            $eventos->eliminarEvento(intval($userId), intval($id));
            $this->redirect('Evento');
        }

        $row = $eventos->listarEventosMP();

        //if (Auth::access('super_admin')) {
        $this->view('eventos/delete', [
            'row' => $row
        ]);
        /* } else {
            $this->view('access-denied');
        }*/
    }
}
