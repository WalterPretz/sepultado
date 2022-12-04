<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Celador_model extends CI_Model{

	//Constructor
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function nueroCelador(){
		$sql = "SELECT 	MAX(id_colaborador) as cui
		FROM 	colaborador ";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows[0]['cui'];
	}

	function seleccionarDepartamento() {
		$sql = "SELECT id_departamento, nombre_depto
				FROM 	departamento
				order by id_departamento ASC
				LIMIT 	500";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}

	function seleccionarMunicipio($id) {
		if (isset($id)) {
			$sql = "SELECT id_municipio, nombre_mun
					FROM 	municipio
					where depto_id_depto = ?
					order by id_municipio DESC
					LIMIT 	500";

			$dbres = $this->db->query($sql, $id);
		}else {
			$sql = "SELECT id_municipio, nombre_mun
					FROM 	municipio
					where id_municipio = 2
					LIMIT 	500";

			$dbres = $this->db->query($sql);
		}

		$rows = $dbres->result_array();
		return $rows;
	}

	function crearCelador($cui, $muni_id_muni, $tipo, $anios, $ofrenda, $descripcion, $cargar, $comision, $descripcion2){
		$sql = "INSERT INTO colaborador(cui, muni_id_municipio, tipo, estado, anios, ofrenda, descripcion, cargar, comision, descripcion2)
				VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$estado = "A";
		$valores = array($cui, $muni_id_muni, $tipo, $estado, $anios, $ofrenda, $descripcion, $cargar, $comision, $descripcion2);
		$dbres = $this->db->query($sql, $valores);
				
		$sql = "SELECT 	MAX(id_colaborador) as celador
		FROM 	colaborador ";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows[0]['celador'];
	}

	function crearCeladorPersona($nombre, $apellido, $direccion, $col_id_colaborador){
		$sql = "INSERT INTO persona(nombre, apellido, direccion, us_id_usuario, col_id_colaborador, car_id_cargador)
				VALUES (?, ?, ?, ?, ?, ?)";

		$us_id_usuario = 1;
		$car_id_cargador = 1;
		$valores = array($nombre, $apellido, $direccion, $us_id_usuario, $col_id_colaborador, $car_id_cargador);
		$dbres = $this->db->query($sql, $valores);		
		return $dbres;
	}

	function crearCeladorNacimiento($fecha, $edad, $col_id_colaborador){
		$sql = "INSERT INTO nacimiento(fecha, edad, col_id_colaborador, car_id_cargador)
				VALUES (?, ?, ?, ?)";

		$car_id_cargador = 1;
		$valores = array($fecha, $edad, $col_id_colaborador, $car_id_cargador);
		$dbres = $this->db->query($sql, $valores);		
		return $dbres;
	}

	function crearCeladorGenero($genero, $col_id_colaborador){
		$sql = "INSERT INTO genero(genero, col_id_colaborador, car_id_cargador)
				VALUES (?, ?, ?)";

		$car_id_cargador = 1;
		$valores = array($genero, $col_id_colaborador, $car_id_cargador);
		$dbres = $this->db->query($sql, $valores);		
		return $dbres;
	}

	function crearCeladorTelefono($numero1, $numero2, $col_id_colaborador){
		$sql = "INSERT INTO telefono(numero1, numero2, us_id_usuario, col_id_colaborador, car_id_cargador)
				VALUES (?, ?, ?, ?, ?)";

		$us_id_usuario = 1;
		$car_id_cargador = 1;
		$valores = array($numero1, $numero2, $us_id_usuario, $col_id_colaborador, $car_id_cargador);
		$dbres = $this->db->query($sql, $valores);		
		return $dbres;
	}

	function crearCeladorNuevoIncripcion($anios, $vestimenta, $ofrenda, $descripcion, $fecha_registro, $us_id_usuario, $car_id_cargador, $col_id_colaborador, $estado, $tipo){
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

	//listado de celadores
	function listadoCelador(){
		$sql = "SELECT a.id_colaborador, b.nombre, b.apellido, b.direccion, c.numero1 as telefono, e.nombre_mun as municipio, d.nombre_depto as departamento
				FROM 	colaborador a
				JOIN    persona b on a.id_colaborador = b.col_id_colaborador
				JOIN    telefono c on c.col_id_colaborador = a.id_colaborador
				JOIN    municipio e on e.id_municipio = a.muni_id_municipio
				JOIN    departamento d on d.id_departamento = e.depto_id_depto
				WHERE 	a.estado = 'A' and a.tipo = 'Celador'
				ORDER BY a.id_colaborador DESC
				LIMIT 	500";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}
//ve a detalle de la persona
	function listadoCeladorPersona($id){
		$sql = "SELECT a.id_colaborador, CONCAT(b.nombre,' ', b.apellido) as nombre, b.nombre as nombre1, b.apellido, a.cui, b.direccion, c.numero1, c.numero2, e.nombre_mun as municipio, d.nombre_depto as departamento, f.genero, a.tipo, DATE_FORMAT(g.fecha, '%d/%m/%Y') as fecha, g.fecha as fecha1, g.edad, a.ofrenda as cantidad, a.descripcion, h.id_inscripcion as recibo

				FROM 	colaborador a
				JOIN    persona b on a.id_colaborador = b.col_id_colaborador
				JOIN    telefono c on c.col_id_colaborador = a.id_colaborador
				JOIN    municipio e on e.id_municipio = a.muni_id_municipio
				JOIN    departamento d on d.id_departamento = e.depto_id_depto
				JOIN    genero f on f.col_id_colaborador = a.id_colaborador
				JOIN    nacimiento g on g.col_id_colaborador = a.id_colaborador
				JOIN    inscripcion h on h.col_id_colaborador = a.id_colaborador
				WHERE 	h.col_id_colaborador = $id
				LIMIT 	1";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}

	function buscarPersonaEliminar($id_colaborador){
		$sql = "SELECT a.id_colaborador as persona, CONCAT(b.nombre,' ', b.apellido) as nombre
				FROM 	colaborador a
				JOIN    persona b on a.id_colaborador = b.col_id_colaborador
				WHERE 	a.id_colaborador = $id_colaborador and a.estado = 'A'
				LIMIT 	1";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}
	
	function personaEliminar($id_colaborador){
		is_numeric($id_colaborador) or exit("Número Esperado!");

		$sql = "UPDATE 	colaborador
				SET 	estado = ?
				WHERE 	id_colaborador = ?
				LIMIT 	1;";

		$valores = array('B', $id_colaborador);
		$dbres = $this->db->query($sql, $valores);
		return $dbres;
	}

	function listadoColaborador(){
		$sql = "SELECT a.id_colaborador, b.nombre, b.apellido, b.direccion, c.numero1 as telefono, e.nombre_mun as municipio, d.nombre_depto as departamento
				FROM 	colaborador a
				JOIN    persona b on a.id_colaborador = b.col_id_colaborador
				JOIN    telefono c on c.col_id_colaborador = a.id_colaborador
				JOIN    municipio e on e.id_municipio = a.muni_id_municipio
				JOIN    departamento d on d.id_departamento = e.depto_id_depto
				WHERE 	a.estado = 'A' and a.tipo = 'Colaborador'
				ORDER BY a.id_colaborador DESC
				LIMIT 	500";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}

	function listadoCoordinador(){
		$sql = "SELECT a.id_colaborador, b.nombre, b.apellido, b.direccion, c.numero1 as telefono, e.nombre_mun as municipio, d.nombre_depto as departamento
				FROM 	colaborador a
				JOIN    persona b on a.id_colaborador = b.col_id_colaborador
				JOIN    telefono c on c.col_id_colaborador = a.id_colaborador
				JOIN    municipio e on e.id_municipio = a.muni_id_municipio
				JOIN    departamento d on d.id_departamento = e.depto_id_depto
				WHERE 	a.estado = 'A' and a.tipo = 'Coordinador'
				ORDER BY a.id_colaborador DESC
				LIMIT 	500";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}

	function actualizarControl($id_producto, $fecha_modifica, $id_usuario_modifica){
		$sql = "UPDATE control
				SET fecha_modifica = '$fecha_modifica', id_usuario_modifica = '$id_usuario_modifica'
				WHERE id_productoControl = '$id_producto'";
		$dbres = $this->db->query($sql);
		return $dbres;
	}

	//para actualizar datos de colaboradores celadores
	function updateCelador($id_colaborador, $cui, $muni_id_muni, $tipo){
		$sql = "UPDATE colaborador
				SET cui = '$cui', muni_id_municipio = '$muni_id_muni', tipo = '$tipo'
				WHERE id_colaborador = '$id_colaborador'";
	
		$dbres = $this->db->query($sql);
		return $dbres;
	}

	function updateCeladorPersona($nombre, $apellido, $direccion, $col_id_colaborador){
		$sql = "UPDATE persona
				SET nombre = '$nombre', apellido = '$apellido', direccion = '$direccion'
				WHERE col_id_colaborador = '$col_id_colaborador'";
		$dbres = $this->db->query($sql);
		return $dbres;
	}

	function updateCeladorNacimiento($fecha, $edad, $col_id_colaborador){
		$sql = "UPDATE nacimiento
				SET fecha = '$fecha', edad = '$edad'
				WHERE col_id_colaborador = '$col_id_colaborador'";

		$dbres = $this->db->query($sql);
		return $dbres;
	}

	function updateCeladorGenero($genero, $col_id_colaborador){
		$sql = "UPDATE genero
		SET genero= '$genero'
		WHERE col_id_colaborador = '$col_id_colaborador'";				

		$dbres = $this->db->query($sql);
		return $dbres;
	}

	function updateCeladorTelefono($numero1, $numero2, $col_id_colaborador){
		$sql = "UPDATE telefono
				SET numero1 = '$numero1', numero2 = '$numero2'
				WHERE col_id_colaborador = '$col_id_colaborador'";				

		$dbres = $this->db->query($sql);
		return $dbres;
	}

	function listadoCeladorHonor(){
		$sql = "SELECT a.id_colaborador, b.nombre, b.apellido, b.direccion, c.numero1 as telefono, e.nombre_mun as municipio, d.nombre_depto as departamento
				FROM 	colaborador a
				JOIN    persona b on a.id_colaborador = b.col_id_colaborador
				JOIN    telefono c on c.col_id_colaborador = a.id_colaborador
				JOIN    municipio e on e.id_municipio = a.muni_id_municipio
				JOIN    departamento d on d.id_departamento = e.depto_id_depto
				WHERE 	a.estado = 'A' and a.tipo != 'Sistema' and a.cargar = 'Honor Salida'
				ORDER BY a.id_colaborador DESC
				LIMIT 	500";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}

	function listadoCeladorHonor1(){
		$sql = "SELECT a.id_colaborador, b.nombre, b.apellido, b.direccion, c.numero1 as telefono, e.nombre_mun as municipio, d.nombre_depto as departamento
				FROM 	colaborador a
				JOIN    persona b on a.id_colaborador = b.col_id_colaborador
				JOIN    telefono c on c.col_id_colaborador = a.id_colaborador
				JOIN    municipio e on e.id_municipio = a.muni_id_municipio
				JOIN    departamento d on d.id_departamento = e.depto_id_depto
				WHERE 	a.estado = 'A' and a.tipo != 'Sistema' and a.cargar = 'Honor Entrada'
				ORDER BY a.id_colaborador DESC
				LIMIT 	500";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}

}
