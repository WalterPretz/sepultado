<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class inicio extends CI_Controller {
function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('usuario_model');
	}

	private function restringirAcceso() {
		if (!isset($this->session->USUARIO)) {
			redirect("usuario");
		}
	}

	public function index()
	{
		$data['base_url'] = $this->config->item('base_url');
		$this->load->view('inicio', $data);
	}

	public function docs()
	{
		$data['base_url'] = $this->config->item('base_url');
		$this->load->view('docs', $data);
	}
}
