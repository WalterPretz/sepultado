<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class usuario extends CI_Controller {
function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('Usuario_model');
	}

	private function restringirAcceso() {
		if (!isset($this->session->USUARIO)) {
			redirect("/inicio");
		}
	}

	public function index() {
		$data['base_url'] = $this->config->item('base_url');

		if (isset($this->session->USUARIO)) {
			redirect('/inicio');
		}

		if ($_POST['login'] == 'Ingresar') {
			$usuario = $_POST['usuario'];
			$clave = $_POST['clave'];
			$id = $this->Usuario_model->autenticarUsuarioSistema($usuario, $clave);

			if ($id > 0) {
				//Establecer variables de sesion
				$this->session->USUARIO = $usuario;
				$this->session->IDUSUARIO = $id[0]['id_usuario'];
				$this->session->ROL = $id[0]['rol'];
				$this->session->NOMBRE = $id[0]['nombre'];
				$this->session->APELLIDO = $id[0]['apellido'];
				redirect("/bienvenida");
			} else {
				$data["mensaje"] = "Usuario o clave incorrectos!";
			}
		}

		$this->load->view('login', $data);
	}

	public function logout() {
		$this->session->sess_destroy(); // Destruir todas las variables de sesión
		redirect("inicio");
	}

	function crear() {
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		if ($this->session->ROL == 'Director') {
			$data['cod'] = $this->Usuario_model->buscarNumero();
			$this->load->view('registrar_usuario', $data);
		} else {
			redirect("/inicio");
		}
	} 

	function crear_user(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		
		if(!empty($_POST['cod']) || !empty($_POST['nombre']) || !empty($_POST['apellido']) || !empty($_POST['cui']) || !empty($_POST['telefono']) || !empty($_POST['direccion']) || !empty($_POST['usuario']) || !empty($_POST['rol']) || !empty($_POST['clave']) || !empty($_POST['clave2']) ){
			//print_r($_POST);

			$cuitraido = $this->Usuario_model->nueroUusario();
			$anio = date("Y");
			$cui = $anio.$cuitraido;

			$data['nombre'] = $_POST['nombre'];
			$data['apellido'] = $_POST['apellido'];
			if ($_POST['cui'] == 0) {
				$data['cui'] = $cui;
			} else {
				$data['cui'] = $_POST['cui'];
			}
			$data['numero1'] = $_POST['telefono'];
			$data['numero2'] = $_POST['telefono2'];
			$data['direccion'] = $_POST['direccion'];
			$data['email'] = $_POST['email'];
			$data['cargo'] = $_POST['cargo'];
			$data['usuario'] = $_POST['usuario'];
			$data['rol'] = $_POST['rol'];
			$data['clave'] = $_POST['clave'];
			$data['clave2'] = $_POST['clave2'];

			if ($data['clave'] != $data['clave2']) {
				echo "error";
			} else if (strlen($data['clave']) < 8) {
				echo "error";
			} else {
				$us_id_usuario = $this->Usuario_model->crearUsuario($data['cui'], $data['cargo'], $data['usuario'], $data['clave'], $data['rol'], $data['email']);
				$persona = $this->Usuario_model->crearUsuarioPersona($data['nombre'], $data['apellido'], $data['direccion'], $us_id_usuario);
				$tel = $this->Usuario_model->crearUsuarioTelefono($data['numero1'], $data['numero2'], $us_id_usuario);
				$cui = $this->Usuario_model->traer_dpi($data['cui']);
				if ($us_id_usuario == $persona) {
					echo json_encode($cui, JSON_UNESCAPED_UNICODE);
				} else{
					echo "error";
				}
			}

		} else {
			echo "error";
		}
	}

	function mostrar_insercion($cui = 0){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		if ($this->session->ROL == 'Director') {
			$data['arr'] = $this->Usuario_model->mostrar_insercion_usuario($cui);
			$data['mensaje'] = "Datos ingresados exitosamente";

			if ($cui == 0) {
				redirect("/usuario/crear");
			}

			$this->load->view('usuario_mostrar_detalle', $data);
		} else {
			redirect("/inicio");
		}
	}

	function listado(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');

		if ($this->session->ROL == 'Director') {
			$data['arr'] = $this->Usuario_model->seleccionarUsuariosRegistrados();
			$this->load->view('listado_usuarios', $data);
		} else {
			redirect("/inicio");
		}
	}

	function buscar_user(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');

		if(!empty($_POST['id_usuario'])){
			$data['id_usuario'] = $_POST['id_usuario'];
			$nombre = $this->Usuario_model->selecNombreUser($data['id_usuario']);
			echo json_encode($nombre, JSON_UNESCAPED_UNICODE);
		}
	}

	function pasupdate(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');

		$data['id'] = $_POST['id'];
		$data['clave'] = $_POST['pass'];
		$data['id_usuario'] = $_POST['pass2'];

		$pass = $this->Usuario_model->updatePass($data['clave'], $data['id']);
		echo json_encode($pass, JSON_UNESCAPED_UNICODE);
	}

	function changeuss(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');

		$data['id_usuario'] = $_POST['id_us'];
		$pass = $this->Usuario_model->updateState($data['id_usuario']);
		echo json_encode($pass, JSON_UNESCAPED_UNICODE);
	}

	function updateUser(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		if ($this->session->ROL == 'Director') {
			if(!empty($_POST['cod']) || !empty($_POST['nombre']) || !empty($_POST['apellido']) || !empty($_POST['cui']) || !empty($_POST['telefono']) || !empty($_POST['direccion']) || !empty($_POST['usuario']) || !empty($_POST['rol'])){
		    $data['id_usuario'] = $_POST['cod'];
		    $data['nombre'] = $_POST['nombre'];
		    $data['apellido'] = $_POST['apellido'];
		    $data['cui'] = $_POST['cui'];
		    $data['numero1'] = $_POST['telefono'];
		    $data['numero2'] = $_POST['telefono2'];
		    $data['direccion'] = $_POST['direccion'];
		    $data['email'] = $_POST['email'];
		    $data['cargo'] = $_POST['cargo'];
		    $data['usuario'] = $_POST['usuario'];
		    $data['rol'] = $_POST['rol'];

			$this->Usuario_model->updateUsuario($data['id_usuario'], $data['cui'], $data['cargo'], $data['usuario'], $data['rol'], $data['email']);
			$this->Usuario_model->updateUsuarioPersona($data['nombre'], $data['apellido'], $data['direccion'], $data['id_usuario']);
			$cui = $this->Usuario_model->updateUsuarioTelefono($data['numero1'], $data['numero2'], $data['id_usuario']);
			
			echo json_encode($cui, JSON_UNESCAPED_UNICODE);
			} else{
				echo "error";
			}

		} else {
			redirect("/inicio");
		}
	}
}
