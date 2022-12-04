<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class celador extends CI_Controller {
function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('Celador_model');
		$this->load->model('Cargador_model');
	}

	private function restringirAcceso() {
		if (!isset($this->session->USUARIO)) {
			redirect("usuario");
		}
	}

	function index(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');

		if ($this->session->ROL == 'Director') {
			$this->load->view('registrar_celador', $data);
		} else {
			redirect("/inicio");
		}
	}

	function colaborador(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		$this->load->view('registrar_colaborador', $data);
	}

	public function departamento($id = 0) {
		//$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');

		$data['departamento'] =  $this->Celador_model->seleccionarDepartamento(); //Selelcciona el departemanto
		echo '<option selected disabled value="">Seleccionar depto</option>';
		foreach ($data['departamento'] as $key) {
		if ($id == $key['id_departamento']) {
			echo '<option selected value="'.$key['id_departamento'].'">'.$key['nombre_depto'].'</option>'."\n";
			}else {
				echo '<option value="'.$key['id_departamento'].'">'.$key['nombre_depto'].'</option>'."\n";
			}
		}
	}

	public function municipio($id = 0) {
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');

		$id_depto = $_POST['departamento'];
		$data['municipio'] =  $this->Celador_model->seleccionarMunicipio($id_depto); //Selelcciona el municipio
		echo '<option selected disabled value="">Seleccionar municipio</option>';
		foreach ($data['municipio'] as $key) {
			echo '<option selected value="'.$key['id_municipio'].'">'.$key['nombre_mun'].'</option>'."\n";
		}
	}

	function crearCelador(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		$cui = $this->Celador_model->nueroCelador();

		if ((!empty($_POST['nombre'])) || (!empty($_POST['apellido'])) || (!empty($_POST['nacimiento'])) || (!empty($_POST['edad'])) || (!empty($_POST['genero'])) || (!empty($_POST['numero'])) || (!empty($_POST['direccion'])) || (!empty($_POST['muni'])) || (!empty($_POST['tipo'])) || (!empty($_POST['ofrenda'])) || (!empty($_POST['descripcion'])) ) {

			$data['nombre'] = $_POST['nombre'];
			$data['apellido'] = $_POST['apellido'];
			if ($_POST['cui'] == 0) {
				$anio = date('Y');
				$numero = $anio.$cui;
				$data['cui'] = $numero;
			} else {
				$data['cui'] = $_POST['cui'];
			}
			$data['fecha'] = $_POST['nacimiento'];
			$data['edad'] = $_POST['edad'];
			$data['genero'] = $_POST['genero'];
			$data['numero1'] = $_POST['numero'];
			$data['numero2'] = $_POST['numero2'];
			$data['direccion'] = $_POST['direccion'];
			$data['muni_id_muni'] = $_POST['muni'];
			$data['tipo'] = $_POST['tipo'];
			$data['anios'] = $_POST['años'];
            $data['ofrenda'] = $_POST['ofrenda'];
            $data['descripcion'] = $_POST['descripcion'];
            $data['cargar'] = $_POST['cargar'];
            $data['comision'] = $_POST['comision'];
            $data['descripcion2'] = $_POST['descripcion2'];

            $data['vestimenta'] = 'No';
            $data['fecha_registro'] = date("Y-m-d H:i:s");
            $data['us_id_usuario'] = $this->session->IDUSUARIO;
            $data['car_id_cargador'] = '1';
            $data['estado'] = 'A';
			$col_id_colaborador = $this->Celador_model->crearCelador($data['cui'], $data['muni_id_muni'], $data['tipo'], $data['anios'], $data['ofrenda'], $data['descripcion'], $data['cargar'], $data['comision'], $data['descripcion2']);
			$this->Celador_model->crearCeladorPersona($data['nombre'], $data['apellido'], $data['direccion'], $col_id_colaborador);
			$this->Celador_model->crearCeladorNacimiento($data['fecha'], $data['edad'], $col_id_colaborador);
			$this->Celador_model->crearCeladorGenero($data['genero'], $col_id_colaborador);
			$this->Celador_model->crearCeladorTelefono($data['numero1'], $data['numero2'], $col_id_colaborador); 
			$inscripcion = $this->Celador_model->crearCeladorNuevoIncripcion($data['anios'], $data['vestimenta'], $data['ofrenda'], $data['descripcion'], $data['fecha_registro'], $data['us_id_usuario'], $data['car_id_cargador'], $col_id_colaborador, $data['estado'], $data['tipo']);
			
			echo json_encode($inscripcion, JSON_UNESCAPED_UNICODE);
			//echo json_encode($col_id_colaborador, JSON_UNESCAPED_UNICODE);
			
		} else {
			echo 'error';
		}
	}

	function listado(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');

		if ($this->session->ROL == 'Director') {
			$data['arr'] = $this->Celador_model->listadoCelador();
			$this->load->view('listado_celadores', $data);
		} else {
			redirect("/inicio");
		}
	}

	function detalle($id = 0){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');

		if ($this->session->ROL == 'Director') {
			$data['arr'] = $this->Celador_model->listadoCeladorPersona($id);
			$this->load->view('persona_mostrar_detalle', $data);
		} else {
			redirect("/inicio");
		}
	}

	function buscarpersona(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');

		if ($this->session->ROL == 'Director') {
			$data['id_colaborador'] = $_POST['colaborador'];
			$resultado = $this->Celador_model->buscarPersonaEliminar($data['id_colaborador']);
			echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
		} else {
			redirect("/inicio");
		}
	}

	function changepersona(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');

		if ($this->session->ROL == 'Director') {
			$data['id_colaborador'] = $_POST['persona'];
			$resultado = $this->Celador_model->personaEliminar($data['id_colaborador']);
			echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
		} else {
			redirect("/inicio");
		}
	}

	function listadoColaborador(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');

		if ($this->session->ROL == 'Director') {
			$data['arr'] = $this->Celador_model->listadoColaborador();
			$this->load->view('listado_colaboradores', $data);
		} else {
			redirect("/inicio");
		}
	}

	function coordinador(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');

		if ($this->session->ROL == 'Director') {
			$data['arr'] = $this->Celador_model->listadoCoordinador();
			$this->load->view('listado_coordinador', $data);
		} else {
			redirect("/inicio");
		}
	}

	function editarDatos(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');

		if ($this->session->ROL == 'Director') {
			if ((!empty($_POST['nombre'])) || (!empty($_POST['apellido'])) || (!empty($_POST['nacimiento'])) || (!empty($_POST['edad'])) || (!empty($_POST['genero'])) || (!empty($_POST['numero'])) || (!empty($_POST['direccion'])) || (!empty($_POST['muni'])) || (!empty($_POST['tipo']))) {

			$data['id_colaborador'] = $_POST['personas'];
			$data['nombre'] = $_POST['nombre'];
			$data['apellido'] = $_POST['apellido'];
			$data['cui'] = $_POST['cui'];
			$data['fecha'] = $_POST['nacimiento'];
			$data['edad'] = $_POST['edad'];
			$data['genero'] = $_POST['genero'];
			$data['numero1'] = $_POST['numero'];
			$data['numero2'] = $_POST['numero2'];
			$data['direccion'] = $_POST['direccion'];
			$data['muni_id_muni'] = $_POST['muni'];
			$data['tipo'] = $_POST['tipo'];

			$this->Celador_model->updateCelador($data['id_colaborador'], $data['cui'], $data['muni_id_muni'], $data['tipo']);
			$this->Celador_model->updateCeladorPersona($data['nombre'], $data['apellido'], $data['direccion'], $data['id_colaborador']);
			$this->Celador_model->updateCeladorNacimiento($data['fecha'], $data['edad'], $data['id_colaborador']);
			$this->Celador_model->updateCeladorGenero($data['genero'], $data['id_colaborador']);
			$resultado = $this->Celador_model->updateCeladorTelefono($data['numero1'], $data['numero2'], $data['id_colaborador']); 

			echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
			
			} else {
				echo 'error';
			}
			
		} else {
			redirect("/inicio");
		}
	}

	function comrpobante($id = 0){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		$data['arr'] = $this->Celador_model->listadoCeladorPersona($id);
		$this->load->view('compro', $data);
	}

	//para listar cargadores honorarios
	function inscripcionhonor(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		$data['arr'] = $this->Celador_model->listadoCeladorHonor();
		$data['arr1'] = $this->Celador_model->listadoCeladorHonor1();
		$data['grupo'] = $this->Cargador_model->numeroCargadoresTurnoData();
		$this->load->view('listado_honor', $data);
	}

	function comisiones(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		$data['arr'] = $this->Cargador_model->listadocomisiones();
		$this->load->view('listado_comision', $data);
	}
}
