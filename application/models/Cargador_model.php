<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cargador_model extends CI_Model{

	//Constructor
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function nueroCargador(){
		$sql = "SELECT 	MAX(id_cargador) as cui
		FROM 	cargador ";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows[0]['cui'];
	}

	function crearCargador($cui, $altura, $muni_id_muni, $usuario_id_usuario, $estado, $dosis){
		$sql = "INSERT INTO cargador(cui, altura, muni_id_muni, usuario_id_usuario, estado, dosis)
				VALUES (?, ?, ?, ?, ?, ?)";

		$valores = array($cui, $altura, $muni_id_muni, $usuario_id_usuario, $estado, $dosis);
		$dbres = $this->db->query($sql, $valores);
				
		$sql = "SELECT 	MAX(id_cargador) as cargador
		FROM 	cargador ";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows[0]['cargador'];
	}

	function crearCargadorInscripcion($anios, $vestimenta, $ofrenda, $descripcion, $fecha_registro, $us_id_usuario, $car_id_cargador, $col_id_colaborador, $estado, $tipo){
		$sql = "INSERT INTO inscripcion(anios, vestimenta, ofrenda, descripcion, fecha_registro,  us_id_usuario, car_id_cargador, col_id_colaborador, estado, tipo)
				VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$valores = array($anios, $vestimenta, $ofrenda, $descripcion, $fecha_registro,  $us_id_usuario, $car_id_cargador, $col_id_colaborador, $estado, $tipo);
		$dbres = $this->db->query($sql, $valores);

		$sql = "SELECT 	MAX(id_inscripcion) as inscripcion
		FROM 	inscripcion ";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows[0]['inscripcion'];		
	}

	function crearCargadorPersona($nombre, $apellido, $direccion, $car_id_cargador){
		$sql = "INSERT INTO persona(nombre, apellido, direccion, us_id_usuario, col_id_colaborador, car_id_cargador)
				VALUES (?, ?, ?, ?, ?, ?)";

		$us_id_usuario = 1;
		$col_id_colaborador = 1;
		$valores = array($nombre, $apellido, $direccion, $us_id_usuario, $col_id_colaborador, $car_id_cargador);
		$dbres = $this->db->query($sql, $valores);		
		return $dbres;
	}

	function crearCargadorNacimiento($fecha, $edad, $car_id_cargador){
		$sql = "INSERT INTO nacimiento(fecha, edad, col_id_colaborador, car_id_cargador)
				VALUES (?, ?, ?, ?)";

		$col_id_colaborador = 1;
		$valores = array($fecha, $edad, $col_id_colaborador, $car_id_cargador);
		$dbres = $this->db->query($sql, $valores);		
		return $dbres;
	}

	function crearCargadorGenero($genero, $car_id_cargador){
		$sql = "INSERT INTO genero(genero, col_id_colaborador, car_id_cargador)
				VALUES (?, ?, ?)";

		$col_id_colaborador = 1;
		$valores = array($genero, $col_id_colaborador, $car_id_cargador);
		$dbres = $this->db->query($sql, $valores);		
		return $dbres;
	}

	function crearCargadorTelefono($numero1, $numero2, $car_id_cargador){
		$sql = "INSERT INTO telefono(numero1, numero2, us_id_usuario, col_id_colaborador, car_id_cargador)
				VALUES (?, ?, ?, ?, ?)";

		$us_id_usuario = 1;
		$col_id_colaborador = 1;
		$valores = array($numero1, $numero2, $us_id_usuario, $col_id_colaborador, $car_id_cargador);
		$dbres = $this->db->query($sql, $valores);		
		return $dbres;
	}

	//listar datos de Cargadores
	function listarCargadores(){
		$sql = "SELECT a.id_cargador, b.nombre, b.apellido, b.direccion, c.numero1 as telefono, e.nombre_mun as municipio, d.nombre_depto as departamento, id_inscripcion as ins
				FROM 	cargador a
				JOIN    persona b on a.id_cargador = b.car_id_cargador
				JOIN    telefono c on a.id_cargador = c.car_id_cargador
				JOIN    municipio e on e.id_municipio = a.muni_id_muni
				JOIN    departamento d on d.id_departamento = e.depto_id_depto
				JOIN    inscripcion f on f.car_id_cargador = a.id_cargador
				WHERE 	a.estado = 'A' and b.car_id_cargador != '1'
				ORDER BY a.id_cargador DESC
				LIMIT 	500";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}

	function detalledelCargador($id){
		$sql = "SELECT a.id_cargador, CONCAT(b.nombre,' ',b.apellido) as nombre, a.cui, b.direccion, c.numero1, c.numero2, e.nombre_mun as municipio, d.nombre_depto as departamento, f.genero, 
		CONCAT('----') as tipo, DATE_FORMAT(g.fecha, '%d/%m/%Y') as fecha, g.fecha as fecha1, g.edad
				FROM 	cargador a
				JOIN    persona b on a.id_cargador = b.car_id_cargador
				JOIN    telefono c on c.car_id_cargador = a.id_cargador
				JOIN    municipio e on e.id_municipio = a.muni_id_muni
				JOIN    departamento d on d.id_departamento = e.depto_id_depto
				JOIN    genero f on f.car_id_cargador = a.id_cargador
				JOIN    nacimiento g on g.car_id_cargador = a.id_cargador
				WHERE 	a.id_cargador = $id
				LIMIT 	1";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}

	function detalledelCargadorEditar($id){
		$sql = "SELECT a.id_cargador, b.nombre, b.apellido, a.cui, b.direccion, c.numero1, c.numero2, e.nombre_mun as municipio, d.nombre_depto as departamento, f.genero, g.fecha, g.edad
				FROM 	cargador a
				JOIN    persona b on a.id_cargador = b.car_id_cargador
				JOIN    telefono c on c.car_id_cargador = a.id_cargador
				JOIN    municipio e on e.id_municipio = a.muni_id_muni
				JOIN    departamento d on d.id_departamento = e.depto_id_depto
				JOIN    genero f on f.car_id_cargador = a.id_cargador
				JOIN    nacimiento g on g.car_id_cargador = a.id_cargador
				WHERE 	a.id_cargador = $id
				LIMIT 	1";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}

	//para traer dato detallados del Cargador
	function reciboCargador($id){
		$sql = "SELECT a.id_inscripcion, a.vestimenta, CONCAT(b.nombre,' ',b.apellido) as nombre, a.vestimenta, a.tipo, f.altura, a.ofrenda as cantidad, b.id_persona as persona, b.direccion, c.numero1 as telefono, e.nombre_mun as municipio, d.nombre_depto as departamento, a.descripcion
				FROM 	inscripcion a
				JOIN    cargador f on a.car_id_cargador = f.id_cargador
				JOIN    persona b on f.id_cargador = b.car_id_cargador
				JOIN    telefono c on c.car_id_cargador = f.id_cargador
				JOIN    municipio e on e.id_municipio = f.muni_id_muni
				JOIN    departamento d on d.id_departamento = e.depto_id_depto
				WHERE 	a.id_inscripcion = $id
				LIMIT 	1";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}

	//cantidad de la ofrenda y descripocion
	function ofrenda(){
		$sql = "SELECT  cantidad, descripcion
				FROM 	ofrenda
				LIMIT 	1";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}

//cantidad de personas por turno
	function buscargrupoNumero(){
		$sql = "SELECT  id_grupo as correlacion, cantidad
				FROM 	grupo
				LIMIT 	10";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}

	function editarOfrenda($id_ofrenda, $cantidad, $descripcion){
		$sql = "UPDATE ofrenda
				SET cantidad = '$cantidad', descripcion = '$descripcion'
				WHERE id_ofrenda = '$id_ofrenda'";
		$dbres = $this->db->query($sql);
		return $dbres;
	}
	//editar datos para cargadores
	function updateCargadorDate($cui, $car_id_cargador){
		$sql = "UPDATE cargador
				SET cui = '$cui'
				WHERE id_cargador = '$car_id_cargador'";
		$dbres = $this->db->query($sql);
		return $dbres;
	}

	function updateCargadorPers($nombre, $apellido, $direccion, $car_id_cargador){
		$sql = "UPDATE persona
				SET nombre = '$nombre', apellido = '$apellido', direccion = '$direccion'
				WHERE car_id_cargador = '$car_id_cargador'";
		$dbres = $this->db->query($sql);
		return $dbres;
	}

	function updateCargadorNaci($fecha, $edad, $car_id_cargador){
		$sql = "UPDATE nacimiento
				SET fecha = '$fecha', edad = '$edad'
				WHERE car_id_cargador = '$car_id_cargador'";
		$dbres = $this->db->query($sql);
		return $dbres;
	}

	function updateCargadorGene($genero, $car_id_cargador){
		$sql = "UPDATE genero
				SET genero = '$genero'
				WHERE car_id_cargador = '$car_id_cargador'";
		$dbres = $this->db->query($sql);
		return $dbres;
	}

	function updateCargadorTele($numero1, $numero2, $car_id_cargador){
		$sql = "UPDATE telefono
				SET numero1 = '$numero1', numero2 = '$numero2'
				WHERE car_id_cargador = '$car_id_cargador'";
		$dbres = $this->db->query($sql);
		return $dbres;
	}
	//traer datos de cargadores para la inscripcion
	function inscripcionCargadoresTurno(){
		$sql = "SELECT CONCAT(b.nombre,' ', b.apellido) as nombre, a.altura as vestimenta
				FROM 	cargador a
				JOIN    persona b on a.id_cargador = b.car_id_cargador
				JOIN    inscripcion f on f.car_id_cargador = a.id_cargador
				WHERE 	a.estado = 'A' and b.car_id_cargador != '1'
				ORDER BY a.altura DESC, a.id_cargador ASC
				LIMIT 	1500";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}

	//contar cuantos registro hay de inscripciones
	function contarcantidadinscripcion(){
		$sql = "SELECT COUNT(*) as total_registro
				FROM 	inscripcion
				WHERE 	estado = 'A'  ";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows[0]['total_registro'];
	}

	function numeroCargadoresTurno(){
		$sql = "SELECT turno as numero
				FROM ofrenda 
				LIMIT 	1";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows[0]['numero'];
	}

	function numeroCargadoresTurnoData(){
		$sql = "SELECT turno as numero
				FROM ofrenda 
				LIMIT 	1";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}

	function updateNumeroCargadoresTurno($turno, $id){
		$sql = "UPDATE ofrenda
				SET turno = '$turno'
				WHERE id_ofrenda = '$id'";
		$dbres = $this->db->query($sql);
		return $dbres;
	}
//listado de comisiones
	function listadocomisiones(){
		$sql = "SELECT a.id_colaborador, CONCAT(b.nombre, ' ', b.apellido) as nombre, a.comision, a.descripcion2
				FROM 	colaborador a
				JOIN    persona b on a.id_colaborador = b.col_id_colaborador
				WHERE 	a.estado = 'A' and a.comision != 'Ninguno'
				ORDER BY a.id_colaborador ASC
				LIMIT 	500";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}
}