<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class listados extends CI_Controller {
function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('Listado_model');
	}

	private function restringirAcceso() {
		if (!isset($this->session->USUARIO)) {
			redirect("usuario");
		}
	}

	function usesistem(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		$data['arr'] = $this->Listado_model->seleccionarUsuarios();
		$this->load->view('listado_usuarios', $data);
	}

	function ingreso(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		//$data['arr'] = $this->Listado_model->seleccionarUsuarios();
		$this->load->view('finanza', $data);
	}

	function ingresocargadores(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		if ($this->session->ROL == 'Director') {

			$año = date("Y");
  			$inicio = $año.'-01-05 00:00:00';
  			$fin = $año.'-12-30 23:59:59';

	        $arr = $this->Listado_model->traerOfrendasCargadores($inicio, $fin);
	        $result = $arr;

	        $detalleTabla   = '';
	        $detalleTotales = '';
	        $tl_sniva     = 0;
	        $subtotal        = 0;
	        $arrayData    = array();

	        if ($result > 0) {
	          foreach ($arr as $a) {
	        
	        $tl_sniva = round(($a['valor'] * $a['cantidad']), 2);
	        $subtotal = round($tl_sniva + $subtotal, 2);
	        $total 	  = number_format($subtotal,2);
	      
	          $detalleTabla .=  "<tr>
	              <td>".$a['descripcion']."</td>
	              <td class='text-center'>Q. ".$a['valor']."</td>
	              <td class='text-center'>".$a['cantidad']."</td>
	              <td class='text-right' >Q. ".$a['ofrenda']."</td>
	          </tr>";
	          }
	        }
	       
	        $detalleTotales = '
	        <tr>
	          <td colspan="3" class="text-right" style="font-weight: bold; font-size: 16px;">TOTAL Q.</td> 
	          <td class="text-right" style="font-weight: bold; font-size: 16px;">'.$total.'</td>   
	        </tr>
	        ';

	        $arrayData['detalle'] = $detalleTabla;
	        $arrayData['totales'] = $detalleTotales;
	        echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);

        } else {
			redirect("/Inicio");
		}
	}

	function ingresocolaboradores(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		if ($this->session->ROL == 'Director') {

			$año = date("Y");
  			$inicio = $año.'-01-05 00:00:00';
  			$fin = $año.'-12-30 23:59:59';

	        $arr = $this->Listado_model->traerOfrendasColaboradores($inicio, $fin);
	        $result = $arr;

	        $detalleTabla   = '';
	        $detalleTotales = '';
	        $tl_sniva     = 0;
	        $subtotal        = 0;
	        $arrayData    = array();

	        if ($result > 0) {
	          foreach ($arr as $a) {
	        
	        $tl_sniva = round(($a['valor'] * $a['cantidad']), 2);
	        $subtotal = round($tl_sniva + $subtotal, 2);
	        $total 	  = number_format($subtotal,2);
	      
	          $detalleTabla .=  "<tr>
	              <td>".$a['descripcion']."</td>
	              <td class='text-center'>Q. ".$a['valor']."</td>
	              <td class='text-center'>".$a['cantidad']."</td>
	              <td class='text-right' >Q. ".$a['ofrenda']."</td>
	          </tr>";
	          }
	        }
	       
	        $detalleTotales = '
	        <tr>
	          <td colspan="3" class="text-right" style="font-weight: bold; font-size: 16px;">TOTAL Q.</td> 
	          <td class="text-right" style="font-weight: bold; font-size: 16px;">'.$total.'</td>   
	        </tr>
	        ';

	        $arrayData['detalle'] = $detalleTabla;
	        $arrayData['totales'] = $detalleTotales;
	        echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);

        } else {
			redirect("/Inicio");
		}
	}

	function ingresoceladores(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		if ($this->session->ROL == 'Director') {

			$año = date("Y");
  			$inicio = $año.'-01-05 00:00:00';
  			$fin = $año.'-12-30 23:59:59';

	        $arr = $this->Listado_model->traerOfrendasCeladores($inicio, $fin);
	        $result = $arr;

	        $detalleTabla   = '';
	        $detalleTotales = '';
	        $tl_sniva     = 0;
	        $subtotal        = 0;
	        $arrayData    = array();

	        if ($result > 0) {
	          foreach ($arr as $a) {
	        
	        $tl_sniva = round(($a['valor'] * $a['cantidad']), 2);
	        $subtotal = round($tl_sniva + $subtotal, 2);
	        $total 	  = number_format($subtotal,2);
	      
	          $detalleTabla .=  "<tr>
	              <td>".$a['descripcion']."</td>
	              <td class='text-center'>Q. ".$a['valor']."</td>
	              <td class='text-center'>".$a['cantidad']."</td>
	              <td class='text-right' >Q. ".$a['ofrenda']."</td>
	          </tr>";
	          }
	        }
	       
	        $detalleTotales = '
	        <tr>
	          <td colspan="3" class="text-right" style="font-weight: bold; font-size: 16px;">TOTAL Q.</td> 
	          <td class="text-right" style="font-weight: bold; font-size: 16px;">'.$total.'</td>   
	        </tr>
	        ';

	        $arrayData['detalle'] = $detalleTabla;
	        $arrayData['totales'] = $detalleTotales;
	        echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);

        } else {
			redirect("/Inicio");
		}
	}

	function ingresocoordinadores(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		if ($this->session->ROL == 'Director') {

			$año = date("Y");
  			$inicio = $año.'-01-05 00:00:00';
  			$fin = $año.'-12-30 23:59:59';

	        $arr = $this->Listado_model->traerOfrendasCoordinadores($inicio, $fin);
	        $result = $arr;

	        $detalleTabla   = '';
	        $detalleTotales = '';
	        $tl_sniva     = 0;
	        $subtotal        = 0;
	        $arrayData    = array();

	        if ($result > 0) {
	          foreach ($arr as $a) {
	        
	        $tl_sniva = round(($a['valor'] * $a['cantidad']), 2);
	        $subtotal = round($tl_sniva + $subtotal, 2);
	        $total 	  = number_format($subtotal,2);
	      
	          $detalleTabla .=  "<tr>
	              <td>".$a['descripcion']."</td>
	              <td class='text-center'>Q. ".$a['valor']."</td>
	              <td class='text-center'>".$a['cantidad']."</td>
	              <td class='text-right' >Q. ".$a['ofrenda']."</td>
	          </tr>";
	          }
	        }
	       
	        $detalleTotales = '
	        <tr>
	          <td colspan="3" class="text-right" style="font-weight: bold; font-size: 16px;">TOTAL Q.</td> 
	          <td class="text-right" style="font-weight: bold; font-size: 16px;">'.$total.'</td>   
	        </tr>
	        ';

	        $arrayData['detalle'] = $detalleTabla;
	        $arrayData['totales'] = $detalleTotales;
	        echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);

        } else {
			redirect("/Inicio");
		}
	}

	function ingresoofrendass(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		if ($this->session->ROL == 'Director') {

			$año = date("Y");
  			$inicio = $año.'-01-05 00:00:00';
  			$fin = $año.'-12-30 23:59:59';

  			$arr1 = $this->Listado_model->traerOfrendasCargadores1($inicio, $fin);
  			$arr2 = $this->Listado_model->traerOfrendasColaboradores1($inicio, $fin);
  			$arr3 = $this->Listado_model->traerOfrendasCeladores1($inicio, $fin);
	        $arr4 = $this->Listado_model->traerOfrendasCoordinadores1($inicio, $fin);
	        $result = $arr1;
	        
	        $detalleTotales = '';
	        $totalPersonas = 0;
	        $totalG = 0;
	        //cantidad ofrenda por cargador
	        if ($result > 0) {
	          	foreach ($arr1 as $a) {
		        $ofren1 = $a['ofren'];
		        $canti1 = $a['cantidad'];
	          }
	        }

	        //cantidad ofrenda por colaborador
	        if ($result > 0) {
	          	foreach ($arr2 as $b) {
		        $ofren2 = $b['ofren'];
		        $canti2 = $b['cantidad'];
	          }
	        }

	        //cantidad ofrenda por celador
	        if ($result > 0) {
	          	foreach ($arr3 as $c) {
		        $ofren3 = $c['ofren'];
		        $canti3 = $c['cantidad'];
	          }
	        }

	        //cantidad ofrenda por coordinador
	        if ($result > 0) {
	          	foreach ($arr4 as $d) {
		        $ofren4 = $d['ofren'];
		        $canti4 = $d['cantidad'];
	          }
	        }

	        $totalPersonas = ($canti1 + $canti2 + $canti3 + $canti4);
	        $totalG =  ($ofren1 + $ofren2 + $ofren3 + $ofren4);

	        $detalleTotales = '
	        <tr>
	        	<td class="text-center" style="font-weight: bold; font-size: 18px;">Ofrenda Recaudada HSS '.date('Y').'</td>
	          	<td class="text-center" style="font-weight: bold; font-size: 18px;">'.$totalPersonas.'</td> 
	          	<td class="text-right" style="font-weight: bold; font-size: 18px;">'.number_format($totalG,2).'</td>   
	        </tr>';

	        $arrayData['totales'] = $detalleTotales;
	        echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
        } else {
			redirect("/Inicio");
		}
	}

	function generalgeneral(){
		$this->restringirAcceso();
		$data['base_url'] = $this->config->item('base_url');
		if ($this->session->ROL == 'Director') {

			$año = date("Y");
	  		$inicio = '2018-01-05 00:00:00';
	  		$fin = $año.'-12-30 23:59:59';

			$data['arr'] = $this->Listado_model->inscripcionCargadoresTurno($inicio, $fin);
			$this->load->view('general', $data);
		} else {
			redirect("/inicio");
		}
	}


}
