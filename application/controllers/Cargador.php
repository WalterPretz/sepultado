<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cargador extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->helper('url');
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
		$this->load->view('registrar_cargador', $data);
	}

	function envia(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		$this->load->view('prueba', $data);
	}

	function listado(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		$data['arr'] = $this->Cargador_model->listarCargadores();
		$this->load->view('listado_cargadores', $data);
	}

	function crearNuevaInscripcion(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		$cui = $this->Cargador_model->nueroCargador();

		if ((!empty($_POST['nombre'])) || (!empty($_POST['apellido'])) || (!empty($_POST['fecha'])) || (!empty($_POST['edad'])) || (!empty($_POST['genero'])) || (!empty($_POST['numero1'])) || (!empty($_POST['direccion'])) || (!empty($_POST['muni'])) || (!empty($_POST['años'])) || (!empty($_POST['altura'])) || (!empty($_POST['ofrenda'])) || (!empty($_POST['descripcion'])) ) {
			
			$data['nombre'] = $_POST['nombre'];
			$data['apellido'] = $_POST['apellido'];
			if ($_POST['cui'] == 0) {
				$anio = date('Y');
				$numero = $anio.$cui;
				$data['cui'] = $numero;
			} else {
				$data['cui'] = $_POST['cui'];
			}
			$data['fecha'] = $_POST['fecha'];
			$data['edad'] = $_POST['edad'];
			$data['genero'] = $_POST['genero'];
			$data['numero1'] = $_POST['numero1'];
			$data['numero2'] = $_POST['numero2'];
			$data['direccion'] = $_POST['direccion'];
			$data['muni_id_muni'] = $_POST['muni'];
			$data['anios'] = $_POST['años'];
			$data['altura'] = $_POST['altura'];
			$data['vestimenta'] = "Cucurucho";
			$data['ofrenda'] = $_POST['ofrenda'];
			$data['descripcion'] = $_POST['descripcion'];
			$data['dosis'] = $_POST['dosis'];
			$data['fecha_registro'] = date("Y-m-d H:i:s");
			$data['us_id_usuario'] = $this->session->IDUSUARIO;
			$data['usuario_id_usuario'] = $this->session->IDUSUARIO;
			$data['col_id_colaborador'] = 1;
			$data['tipo'] = 'Cargador';
			$data['estado'] = 'A';

			$car_id_cargador = $this->Cargador_model->crearCargador($data['cui'], $data['altura'], $data['muni_id_muni'], $data['usuario_id_usuario'], $data['estado'], $data['dosis']);
			$inscripcion = $this->Cargador_model->crearCargadorInscripcion($data['anios'], $data['vestimenta'], $data['ofrenda'], $data['descripcion'], $data['fecha_registro'], $data['us_id_usuario'], $car_id_cargador, $data['col_id_colaborador'], $data['estado'], $data['tipo']);
			$this->Cargador_model->crearCargadorPersona($data['nombre'], $data['apellido'], $data['direccion'], $car_id_cargador);
			$this->Cargador_model->crearCargadorNacimiento($data['fecha'], $data['edad'], $car_id_cargador);
			$this->Cargador_model->crearCargadorGenero($data['genero'], $car_id_cargador);
			$this->Cargador_model->crearCargadorTelefono($data['numero1'], $data['numero2'], $car_id_cargador); 
			echo json_encode($inscripcion, JSON_UNESCAPED_UNICODE);
		} else {
			echo 'error';
		}
	}

	function detalle_cargador($id = 0){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		$data['arr'] = $this->Cargador_model->detalledelCargador($id);
		$this->load->view('persona_mostrar_detalle', $data);
	}

	function detalle_cargadorEditar(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		$id = $_POST['id'];
		$datos = $this->Cargador_model->detalledelCargadorEditar($id);
		echo json_encode($datos, JSON_UNESCAPED_UNICODE);
	}

	function generacion($id = 0){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		$data['arr'] = $this->Cargador_model->reciboCargador($id);
		$this->load->view('recibo', $data);
	}

	//traer el numero de turno
		function datosInfo(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		if ($this->session->ROL == 'Director') {
			$cantidad = $this->Cargador_model->buscargrupoNumero();
			echo json_encode($cantidad, JSON_UNESCAPED_UNICODE);
		}
	}

	function updategroup(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		
		if ((!empty($_POST['correlacion'])) || (!empty($_POST['nuevo'])) ) {
			$data['id_grupo'] = $_POST['correlacion'];
			$data['cantidad'] = $_POST['nuevo'];

			$grupo = $this->Cargador_model->editarGrupo($data['id_grupo'], $data['cantidad']);
			echo json_encode($grupo, JSON_UNESCAPED_UNICODE);
		} else {
			echo 'error';
		}
	}

	function datosCosto(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		$data = $this->Cargador_model->ofrenda();
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}

	function updateOfrenda(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		if ((!empty($_POST['canofren'])) || (!empty($_POST['desofren'])) ) {
			$data['id_ofrenda'] = 1;
			$data['cantidad'] = $_POST['canofren'];
			$data['descripcion'] = $_POST['desofren'];
			$datas = $this->Cargador_model->editarOfrenda($data['id_ofrenda'], $data['cantidad'], $data['descripcion']);
			echo json_encode($datas, JSON_UNESCAPED_UNICODE);
		} else {
			echo 'error';
		}
	}

	function updateCargadorData(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');

		if ((!empty($_POST['cargador'])) || (!empty($_POST['nombre'])) || (!empty($_POST['apellido'])) || (!empty($_POST['cui'])) || (!empty($_POST['direccion'])) || (!empty($_POST['fecha'])) || (!empty($_POST['edad'])) || (!empty($_POST['genero'])) || (!empty($_POST['numero1'])) || (!empty($_POST['numero2']))) {
			
			$car_id_cargador = $_POST['cargador'];
			$data['nombre'] = $_POST['nombre'];
			$data['apellido'] = $_POST['apellido'];
			$data['cui'] = $_POST['cui'];
			$data['direccion'] = $_POST['direccion'];
			$data['fecha'] = $_POST['fecha'];
			$data['edad'] = $_POST['edad'];
			$data['genero'] = $_POST['genero'];
			$data['numero1'] = $_POST['numero1'];
			$data['numero2'] = $_POST['numero2'];

			$this->Cargador_model->updateCargadorDate($data['cui'], $car_id_cargador);
			$this->Cargador_model->updateCargadorPers($data['nombre'], $data['apellido'], $data['direccion'], $car_id_cargador);
			$this->Cargador_model->updateCargadorNaci($data['fecha'], $data['edad'], $car_id_cargador);
			$this->Cargador_model->updateCargadorGene($data['genero'], $car_id_cargador);
			$resultado = $this->Cargador_model->updateCargadorTele($data['numero1'], $data['numero2'], $car_id_cargador);
			echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
		} else {
			echo 'error';
		}
	}

	function inscripcionviacrucis(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		
		$total_registro = $this->Cargador_model->contarcantidadinscripcion();
		$numeroGrupo = $this->Cargador_model->numeroCargadoresTurno();

		$por_pagina = $numeroGrupo;

		if (empty($_GET['pagina'])) {
			$pagina = 1;
		} else {
			$pagina = $_GET['pagina'];
		}
		
		$desde = ($pagina-1) * $por_pagina;
		$total_paginas = ceil($total_registro / $por_pagina);

		$data['arr'] = $this->Cargador_model->inscripcionCargadoresTurno();
		$data['grupo'] = $this->Cargador_model->numeroCargadoresTurnoData();
		$this->load->view('viacrucis', $data);
	}
	
//traer y actualizar numero de cargadores
	function trarnumero(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		$cant = $this->Cargador_model->numeroCargadoresTurno();
		echo json_encode($cant, JSON_UNESCAPED_UNICODE);
	}

	function updatetrarnumero(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		if ((!empty($_POST['nuevo'])) ){
		$data['id'] = 1;
		$data['turno'] = $_POST['nuevo'];
		$respuesta = $this->Cargador_model->updateNumeroCargadoresTurno($data['turno'], $data['id']);
		echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
		} else {
			echo 'error';
		}
	}

	function pruebass(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		$data['grupo'] = $this->Cargador_model->numeroCargadoresTurno();
		$this->load->view('prueba', $data);
	}
	////seccion de3 paginacion
	

}
