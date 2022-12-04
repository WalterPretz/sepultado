<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_model extends CI_Model{

	//Constructor
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function buscarNumero(){
		$sql = "SELECT MAX(id_usuario)+1 as cod
				FROM 	usuario
				";
		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}

	function nueroUusario(){
		$sql = "SELECT 	MAX(id_usuario) as cui
		FROM 	usuario ";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows[0]['cui'];
	}

	function crearUsuario($cui, $cargo, $usuario, $clave, $rol, $email) {
		$sql = "INSERT INTO usuario(cui, cargo, usuario, hash_clave, salt, estado, rol, email)
				VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

		$salt = rand(0,999999); //calcular un número aleatorio
		$hash_clave = hash('sha256', $clave.$salt); //calcular el hash de clave + salt
		$estado = "A";

		$valores = array($cui, $cargo, $usuario, $hash_clave, $salt, $estado, $rol, $email);
		$dbres = $this->db->query($sql, $valores);

		$sql = "SELECT 	MAX(id_usuario) as cod
		FROM 	usuario ";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows[0]['cod'];
	}

	function crearUsuarioPersona($nombre, $apellido, $direccion, $us_id_usuario){
		$sql = "INSERT INTO persona(nombre, apellido, direccion, us_id_usuario, col_id_colaborador, car_id_cargador)
				VALUES (?, ?, ?, ?, ?, ?)";

		$col_id_colaborador = 1;
		$car_id_cargador = 1;
		$valores = array($nombre, $apellido, $direccion, $us_id_usuario, $col_id_colaborador, $car_id_cargador);
		$dbres = $this->db->query($sql, $valores);

		return $dbres;
	}

	function crearUsuarioTelefono($numero1, $numero2, $us_id_usuario){
		$sql = "INSERT INTO telefono(numero1, numero2, us_id_usuario, col_id_colaborador, car_id_cargador)
				VALUES (?, ?, ?, ?, ?)";

		$col_id_colaborador = 1;
		$car_id_cargador = 1;
		$valores = array($numero1, $numero2, $us_id_usuario, $col_id_colaborador, $car_id_cargador);
		$dbres = $this->db->query($sql, $valores);

		return $dbres;
	}

	function traer_dpi($cui){
		$sql = "SELECT cui
				FROM 	usuario
				WHERE 	cui = ?
				LIMIT 	1";

			$dbres = $this->db->query($sql, array($cui));
			$rows = $dbres->result_array();
			return $rows[0]['cui'];
	}

	function selecNombreUser($id_usuario){
		$sql = "SELECT 	a.id_usuario, CONCAT(b.nombre,' ',b.apellido) as nombre
				FROM 	usuario a
				JOIN    persona b on a.id_usuario = b.us_id_usuario
				WHERE 	a.id_usuario = ?
				LIMIT 	1";

			$dbres = $this->db->query($sql, array($id_usuario));
			$rows = $dbres->result_array();
			return $rows;
	}

	function mostrar_insercion_usuario($cui){
		$sql = "SELECT u.id_usuario as id_usuario, u.cui as cui, u.cargo as cargo, u.usuario as usuario, u.rol as rol,  CONCAT(p.nombre,' ',p.apellido) as nombre, p.nombre as nombre1, p.apellido, p.direccion as direccion, t.numero1 as numero1, t.numero2 as numero2, u.email as email
						FROM usuario u
						JOIN persona p on u.id_usuario = p.us_id_usuario
						JOIN telefono t on t.us_id_usuario = u.id_usuario
						WHERE cui = ?
						LIMIT 	1";

		$dbres = $this->db->query($sql, array($cui));
		$rows = $dbres->result_array();
		return $rows;
	}

	function seleccionarUsuariosRegistrados(){
		$sql = "SELECT 	a.id_usuario, b.nombre, b.apellido, a.cui, b.direccion, c.numero1, c.numero2, a.usuario, a.rol, a.email
				FROM 	usuario a
				JOIN    persona b on a.id_usuario = b.us_id_usuario
				JOIN    telefono c on c.us_id_usuario = a.id_usuario
				WHERE 	a.estado = 'A'
				ORDER BY a.id_usuario ASC
				LIMIT 	100";

		$dbres = $this->db->query($sql);
		$rows = $dbres->result_array();
		return $rows;
	}
	//SECCION DE AUTENTICACION DE USUARIO REGISTRADO EN EL SISTEMA
	function autenticarUsuarioSistema($txtUsuario, $txtClave) {
		$sql = "SELECT 	id_usuario, usuario, hash_clave, salt, rol
				FROM 	usuario
				WHERE 	usuario = ? AND estado = 'A'
				LIMIT 	1;";

		$dbres = $this->db->query($sql, array($txtUsuario));
		$rows = $dbres->result_array();

		if (count($rows) < 1) // El usuario no existe o no está activo
			return 0;

		$id = $rows[0]['id_usuario'];
		$salt = $rows[0]['salt'];
		$hashClave = hash('sha256', $txtClave.$salt); // Calcular sha512 de clave + salt

		$sql = "SELECT 	a.id_usuario, b.nombre, b.apellido, a.usuario, a.rol
		FROM 	usuario a
		JOIN    persona b on a.id_usuario = b.us_id_usuario
		WHERE 	a.id_usuario = ? AND a.hash_clave = ?
		LIMIT 	1;";

		$dbres = $this->db->query($sql, array($id, $hashClave));
		$rows = $dbres->result_array();

		if (count($rows) > 0) {
			return $rows; // El usuario existe y cumple con la clave
		}
		return 0; // El usuario existe pero no cumple la clave
	}

	function updatePass($clave, $id){
		$salt = rand(0,999999); //calcular un número aleatorio
		$hash_clave = hash('sha256', $clave.$salt); //calcular el hash de clave + salt
		
		$sql = "UPDATE usuario
			SET hash_clave = '$hash_clave', salt = '$salt'
			WHERE id_usuario = '$id' ";

		$dbres = $this->db->query($sql);
		return $dbres;
	}

	function updateState($id_usuario){
		is_numeric($id_usuario) or exit("Number expected!");

		$sql = "UPDATE 	usuario
				SET 	estado = ?
				WHERE 	id_usuario = ?
				LIMIT 	1;";

		$valores = array('B', $id_usuario);
		$dbres = $this->db->query($sql, $valores);
		return $dbres;
	}

	//actualizar datos del usuario
	function updateUsuario($id_usuario, $cui, $cargo, $usuario, $rol, $email) {
		$sql = "UPDATE usuario
		SET cui = '$cui', cargo = '$cargo', usuario = '$usuario', rol = '$rol', email = '$email'
		WHERE id_usuario = '$id_usuario'";				

		$dbres = $this->db->query($sql);
		return $dbres;
	}

	function updateUsuarioPersona($nombre, $apellido, $direccion, $us_id_usuario){
		$sql = "UPDATE persona
		SET nombre = '$nombre', apellido = '$apellido', direccion = '$direccion'
		WHERE us_id_usuario = '$us_id_usuario'";				

		$dbres = $this->db->query($sql);
		return $dbres;
	}

	function updateUsuarioTelefono($numero1, $numero2, $us_id_usuario){
		$sql = "UPDATE telefono
		SET numero1 = '$numero1', numero2 = '$numero2'
		WHERE us_id_usuario = '$us_id_usuario'";				

		$dbres = $this->db->query($sql);
		return $dbres;
	}

}
