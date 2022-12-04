<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Listado_model extends CI_Model{

	//Constructor
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function traerOfrendasCargadores($inicio, $fin){
		$sql = "SELECT f.descripcion, f.ofrenda as valor, count(f.id_inscripcion) as cantidad, FORMAT(sum(f.ofrenda),2) as ofrenda, sum(f.ofrenda) as ofren
				FROM 	cargador a
				JOIN    persona b on a.id_cargador = b.car_id_cargador
				JOIN    inscripcion f on f.car_id_cargador = a.id_cargador
				WHERE 	a.estado = 'A' AND b.car_id_cargador != '1' AND f.fecha_registro BETWEEN '$inicio' AND '$fin'
				GROUP BY valor
				";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}

	function traerOfrendasColaboradores($inicio, $fin){
		$sql = "SELECT a.descripcion, a.ofrenda as valor, count(a.id_colaborador) as cantidad, FORMAT(sum(a.ofrenda),2) as ofrenda, sum(a.ofrenda) as ofren
				FROM 	colaborador a
				JOIN    persona b on a.id_colaborador = b.col_id_colaborador
				WHERE 	a.estado = 'A' AND b.col_id_colaborador != '1' AND a.tipo = 'Colaborador' AND a.fecha_registro BETWEEN '$inicio' AND '$fin'
				GROUP BY valor
				";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}

	function traerOfrendasCeladores($inicio, $fin){
		$sql = "SELECT a.descripcion, a.ofrenda as valor, count(a.id_colaborador) as cantidad, FORMAT(sum(a.ofrenda),2) as ofrenda, sum(a.ofrenda) as ofren
				FROM 	colaborador a
				JOIN    persona b on a.id_colaborador = b.col_id_colaborador
				WHERE 	a.estado = 'A' AND b.col_id_colaborador != '1' AND a.tipo = 'Celador' AND a.fecha_registro BETWEEN '$inicio' AND '$fin'
				GROUP BY valor
				";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}

	function traerOfrendasCoordinadores($inicio, $fin){
		$sql = "SELECT a.descripcion, a.ofrenda as valor, count(a.id_colaborador) as cantidad, FORMAT(sum(a.ofrenda),2) as ofrenda, sum(a.ofrenda) as ofren
				FROM 	colaborador a
				JOIN    persona b on a.id_colaborador = b.col_id_colaborador
				WHERE 	a.estado = 'A' AND b.col_id_colaborador != '1' AND a.tipo = 'Coordinador' AND a.fecha_registro BETWEEN '$inicio' AND '$fin'
				GROUP BY valor
				";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}

	//para realizar las finanzas
	function traerOfrendasCargadores1($inicio, $fin){
		$sql = "SELECT  count(f.id_inscripcion) as cantidad, sum(f.ofrenda) as ofren
				FROM 	cargador a
				JOIN    persona b on a.id_cargador = b.car_id_cargador
				JOIN    inscripcion f on f.car_id_cargador = a.id_cargador
				WHERE 	a.estado = 'A' AND b.car_id_cargador != '1' AND f.fecha_registro BETWEEN '$inicio' AND '$fin'
				";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}

	function traerOfrendasColaboradores1($inicio, $fin){
		$sql = "SELECT  count(a.id_colaborador) as cantidad, sum(a.ofrenda) as ofren
				FROM 	colaborador a
				JOIN    persona b on a.id_colaborador = b.col_id_colaborador
				WHERE 	a.estado = 'A' AND b.col_id_colaborador != '1' AND a.tipo = 'Colaborador' AND a.fecha_registro BETWEEN '$inicio' AND '$fin'
				";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}

	function traerOfrendasCeladores1($inicio, $fin){
		$sql = "SELECT  count(a.id_colaborador) as cantidad, sum(a.ofrenda) as ofren
				FROM 	colaborador a
				JOIN    persona b on a.id_colaborador = b.col_id_colaborador
				WHERE 	a.estado = 'A' AND b.col_id_colaborador != '1' AND a.tipo = 'Celador' AND a.fecha_registro BETWEEN '$inicio' AND '$fin'
				";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}

	function traerOfrendasCoordinadores1($inicio, $fin){
		$sql = "SELECT  count(a.id_colaborador) as cantidad, sum(a.ofrenda) as ofren
				FROM 	colaborador a
				JOIN    persona b on a.id_colaborador = b.col_id_colaborador
				WHERE 	a.estado = 'A' AND b.col_id_colaborador != '1' AND a.tipo = 'Coordinador' AND a.fecha_registro BETWEEN '$inicio' AND '$fin'
				";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}

	//traer datos de cargadores para la inscripcion
	function inscripcionCargadoresTurno($inicio, $fin){
		$sql = 	"
			SELECT  CONCAT(b.apellido,' ',b.nombre) as nombre, a.cui, n.fecha, n.edad, a.altura, b.direccion, t.numero1, t.numero2, m.nombre_mun as muni, r.nombre_depto as depto, f.anios as años, a.dosis
			FROM 	cargador a
			JOIN    persona b on a.id_cargador = b.car_id_cargador
			JOIN    inscripcion f on f.car_id_cargador = a.id_cargador
			JOIN    telefono t on t.car_id_cargador = a.id_cargador
			JOIN    nacimiento n on n.car_id_cargador = a.id_cargador
			JOIN    municipio m on m.id_municipio = a.muni_id_muni
			JOIN    departamento r on m.depto_id_depto = r.id_departamento
			WHERE 	a.estado = 'A' and b.car_id_cargador != '1' AND f.fecha_registro BETWEEN '$inicio' AND '$fin'
			ORDER BY nombre ASC
			LIMIT 	2500";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}

}
