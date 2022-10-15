<?php
class InicioController extends Controller
{
	public function index()
	{
		if (!Auth::logged_in()) {

			$this->redirect('login');
		}
		$datos = Auth::getUser();
		error_log("INICIOCONTROLLER:: logout" . json_encode($datos));
		$inicioView = strtolower($datos["Empresa"]) . "/index";
		$inicio = new Inicio();
		

		if ($datos["IdEmpresa"] == 1) {
			$totalusuario = $inicio->listarDatosDashboard($datos["IdEmpresa"],1);
			$this->view($inicioView, [
				'datos' => $totalusuario[0],
			]);
		} elseif ($datos["IdEmpresa"] == 2) {
			error_log("INICIOCONTROLLER:: WHITEPOWER");
			$totalusuario = $inicio->listarDatosDashboard($datos["IdEmpresa"],1);
			//$ventasmes = $inicio->listarDatosDashboard($datos["IdEmpresa"],2);
			$datosinicio["TotalUsuario"] = $totalusuario[0]["TotalUsuarios"];
			//$datosinicio["VentasMes"] = $ventasmes;
			error_log("INICIOCONTROLLER:: VentasMes ".json_encode($datosinicio));
		
			$this->view($inicioView, [
				'datos' =>$datosinicio,
			]);
		} else {
			$datosinicio = $inicio->listarDatosDashboard($datos["IdEmpresa"],1);
			$this->view($inicioView, [
				'datos' => $datosinicio[0],
			]);
		}
	}

	public function ventasmes(){
		$inicio = new Inicio();
		$datos = Auth::getUser();
		$ventasmes = $inicio->listarDatosDashboard($datos["IdEmpresa"],2);

		echo json_encode($ventasmes);
	}
}
