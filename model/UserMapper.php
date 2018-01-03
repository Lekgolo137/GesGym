<?php
// file: model/UserMapper.php

require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/Session.php");
require_once(__DIR__."/../model/Table.php");
require_once(__DIR__."/../model/Activity.php");

class UserMapper {

	// Referencia a la conexión PDO
	private $db;

	// Constructor
	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	// Guarda un usuario.
	public function add($user) {
		$stmt = $this->db->prepare("INSERT INTO users (username, password, tipo, subtipo, entrenador) VALUES (?,?,?,?,?)");
		$stmt->execute(array($user->getUsername(), $user->getPassword(), $user->getTipo(), $user->getSubtipo(), $user->getEntrenador()));
	}
	
	// Actualiza un usuario.
	public function update($user){
		$stmt = $this->db->prepare("UPDATE users SET username=?, password=?, tipo=?, subtipo=?, entrenador=? WHERE id=?");
		$stmt->execute(array($user->getUsername(), $user->getPassword(), $user->getTipo(), $user->getSubtipo(), $user->getEntrenador(), $user->getId()));
	}

	// Comprueba si un nombre de usuario ya existe.
	public function exists($username) {
		$stmt = $this->db->prepare("SELECT count(username) FROM users WHERE username=?");
		$stmt->execute(array($username));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}

	// Comprueba que un login sea válido.
	public function isValid($username, $password) {
		$stmt = $this->db->prepare("SELECT count(username) FROM users WHERE username=? and password=?");
		$stmt->execute(array($username, $password));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}
	
	// Devuelve el tipo de un usuario a partir de su nombre.
	public function findType($username) {
		$stmt = $this->db->prepare("SELECT * FROM users WHERE username=?");
		$stmt->execute(array($username));
		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		return $user["tipo"];
	}
	
	// Devuelve el id de un usuario a partir de su nombre.
	public function findId($username) {
		$stmt = $this->db->prepare("SELECT * FROM users WHERE username=?");
		$stmt->execute(array($username));
		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		return $user["id"];
	}
	
	// Devuelve un usuario a partir de su nombre.
	public function findByUsername($username){
		$stmt = $this->db->prepare("SELECT * FROM users WHERE username=?");
		$stmt->execute(array($username));
		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		if($user != null) {
			return new User($user["id"],
							$user["username"],
							$user["password"],
							$user["tipo"],
							$user["subtipo"],
							$user["entrenador"]);
		} else {
			return NULL;
		}
	}
	
	// Devuelve un usuario a partir de su ID.
	public function findById($id){
		$stmt = $this->db->prepare("SELECT * FROM users WHERE id=?");
		$stmt->execute(array($id));
		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		if($user != null) {
			return new User($user["id"],
							$user["username"],
							$user["password"],
							$user["tipo"],
							$user["subtipo"],
							$user["entrenador"]);
		} else {
			return NULL;
		}
	}
	
	// Devuelve todos los usuarios.
	public function findAll() {
		$stmt = $this->db->query("SELECT * FROM users");
		$users_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$users = array();

		foreach ($users_db as $user) {
			array_push($users, new User($user["id"],
										$user["username"],
										$user["password"],
										$user["tipo"],
										$user["subtipo"],
										$user["entrenador"]));
		}

		return $users;
	}
	
	// Devuelve todos los entrenadores.
	public function findAllTrainers() {
		$stmt = $this->db->query("SELECT * FROM users WHERE tipo='entrenador'");
		$users_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$users = array();

		foreach ($users_db as $user) {
			array_push($users, new User($user["id"],
										$user["username"],
										$user["password"],
										$user["tipo"],
										$user["subtipo"],
										$user["entrenador"]));
		}

		return $users;
	}
	
	// Devuelve todos las tablas.
	public function findAllTables() {
		$stmt = $this->db->query("SELECT * FROM tables");
		$tables_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$tables = array();

		foreach ($tables_db as $table) {
			array_push($tables, new Table($table["id"],
										  $table["nombre"],
										  $table["tipo"],
										  $table["descripcion"]));
		}

		return $tables;
	}
	
	// Devuelve todas las sesiones de un deportista.
	public function findSessions($id){
		$stmt = $this->db->prepare("SELECT * FROM sessions WHERE usuario=?");
		$stmt->execute(array($id));
		$sessions_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$sessions = array();
		
		foreach ($sessions_db as $session) {
			array_push($sessions, new Session($session["id"],
											  $session["comentarios"],
											  $session["fecha_inicio"],
											  $session["fecha_fin"],
											  $session["usuario"],
											  $session["tabla"]));
		}
		
		return $sessions;
	}

	// Devuelve todas las tablas de un deportista.
	public function findTables($id){
		$stmt = $this->db->prepare("SELECT tabla FROM tables_user WHERE usuario=?");
		$stmt->execute(array($id));
		$table_ids = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$tables = array();
		
		foreach ($table_ids as $table_id) {
			$stmt = $this->db->prepare("SELECT * FROM tables WHERE id=?");
			$stmt->execute(array($table_id["tabla"]));
			$table = $stmt->fetch(PDO::FETCH_ASSOC);
			
			array_push($tables, new Table($table["id"],
										  $table["nombre"],
										  $table["tipo"],
										  $table["descripcion"]));
		}
		
		return $tables;
	}
	
	// Devuelve todas las actividades de un deportista.
	public function findActivities($id){
		$stmt = $this->db->prepare("SELECT actividad FROM activities_user WHERE usuario=?");
		$stmt->execute(array($id));
		$activity_ids = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$activities = array();
		
		foreach ($activity_ids as $activity_id) {
			$stmt = $this->db->prepare("SELECT * FROM activities WHERE id=?");
			$stmt->execute(array($activity_id["actividad"]));
			$activity = $stmt->fetch(PDO::FETCH_ASSOC);
			array_push($activities, new Activity($activity["id"],
											     $activity["nombre"],
											     $activity["descripcion"],
											     $activity["dia"],
											     $activity["hora_inicio"],
											     $activity["hora_fin"],
											     $activity["plazas"],
											     $activity["entrenador"]));
		}
		
		return $activities;
	}
	
	// Devuelve todos los deportistas de un entrenador.
	public function findSportsmans($id){
		$stmt = $this->db->prepare("SELECT * FROM users WHERE entrenador=?");
		$stmt->execute(array($id));
		$sportsmans_bd = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$sportsmans = array();

		foreach($sportsmans_bd as $sportsman){
			array_push($sportsmans, new User($sportsman["id"],
											 $sportsman["username"],
											 $sportsman["password"],
										  	 $sportsman["tipo"],
											 $sportsman["subtipo"],
											 $sportsman["entrenador"]));
		}
		
		return $sportsmans;
	}
	
	// Devuelve todas las actividades de un entrenador.
	public function findTrainerActivities($id){
		$stmt = $this->db->prepare("SELECT * FROM activities WHERE entrenador=?");
		$stmt->execute(array($id));
		$activities_bd = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$activities = array();
		
		foreach ($activities_bd as $activity) {
			array_push($activities, new Activity($activity["id"],
											     $activity["nombre"],
											     $activity["descripcion"],
											     $activity["dia"],
											     $activity["hora_inicio"],
											     $activity["hora_fin"],
											     $activity["plazas"],
											     $activity["entrenador"]));
		}
		
		return $activities;
	}
	
	// Elimina un usuario
	public function delete($user) {
		// Primero eliminamos las relaciones del usuario con otras entidades.
		$stmt = $this->db->prepare("DELETE FROM activities_user WHERE usuario=?");
		$stmt->execute(array($user->getId()));
		$stmt = $this->db->prepare("DELETE FROM tables_user WHERE usuario=?");
		$stmt->execute(array($user->getId()));
		$stmt = $this->db->prepare("DELETE FROM sessions WHERE usuario=?");
		$stmt->execute(array($user->getId()));
		$stmt = $this->db->prepare("UPDATE activities SET entrenador=null WHERE entrenador=?");
		$stmt->execute(array($user->getId()));
		$stmt = $this->db->prepare("UPDATE users SET entrenador=null WHERE entrenador=?");
		$stmt->execute(array($user->getId()));
		// Luego eliminamos al usuario en si.
		$stmt = $this->db->prepare("DELETE FROM users WHERE id=?");
		$stmt->execute(array($user->getId()));
	}
	
	// Elimina todas las relaciones de tablas de un usuario.
	public function deleteTables($id) {
		$stmt = $this->db->prepare("DELETE FROM tables_user WHERE usuario=?");
		$stmt->execute(array($id));
	}
	
	// Añade una relación de tabla con un usuario.
	public function addTable($user_id, $table_id) {
		$stmt = $this->db->prepare("INSERT INTO tables_user VALUES (?, ?)");
		$stmt->execute(array($user_id, $table_id));
	}

}