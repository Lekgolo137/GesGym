<?php
// file: model/ActivityMapper.php

require_once(__DIR__."/../core/PDOConnection.php");

/**
* Clase ActivityMapper
*
* @author SirGarner <borjaswimmer@gmail.com>
*/
class ActivityMapper {
	
	// Referencia la conexion PDO
	
	private $db;

	//Constructor
	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}
	
	// Guarda una actividad
	public function save($activity) {
		$stmt = $this->db->prepare(" INSERT INTO activities values (?,?)");
		$stmt->execute(array($activity->getActivityID(), $activity->getPlazas()));
	}
	
	// Comprueba si un nombre
	public function actividadIDExists($activityid){
		$stmt = $this->db->prepare("SELECT count(activityid) FROM activities WHERE activityid=?");
		$stmt->execute(array($activityid));
		
		if($stmt->fetchColumn() > 0) {
			return true;
		}
	}
	
	// Devuelve el numero de plazas de una actividad
	public function findNumPlazas($activityid) {
		$stmt = $this->db->prepare("SELECT * FROM activities where activityid=?");
		$stmt->execute(array($activityid));
		$activity = $stmt->fetch(PDO::FETCH_ASSOC);
		
		return $activity["plazas"];
	}
	
	// Devuelve un array con todas las actividades
	public function findAll() {
		$stmt = $this->db->query("SELECT * FROM activities");
		$activities_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$activities = array();
		
		foreach ($activities_db as $activity) {
			array_push($activities, new Activity($activity["activityid"], $activity["plazas"]));
		}
		
		return $activities;
	}
	
	
	// Devuelve una actividad
	public function findById($id) {
		$stmt = $this->db->prepare("SELECT * FROM activities WHERE id=?");
		$stmt->execute(array($id));
		$activity = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($activity != null) {	
			return new Activity($activity["id"],
								$activity["nombre"],
								$activity["descripcion"],
								$activity["dia"],
								$activity["hora_inicio"],
								$activity["hora_fin"],
								$activity["plazas"],
								$activity["entrenador"]);
		} else {
			return NULL;
		}
	}
	
	// Actualiza una actividad
	public function update($activity) {
		$stmt = $this->db->prepare("UPDATE activities set plazas=? where activityid=?");
		$stmt->execute(array($activity->getPlazas(), $activity->getActivityID()));
	}
	
	// Elimina una actividad
	public function delete($activity) {
		$stmt = $this->db->prepare("DELETE from activities WHERE activityid=?");
		$stmt->execute(array($activity->getActivityID()));
	}
	
	// Devuelve los usuarios de la actividad
	public function findUsers($id) {
		$stmt = $this->db->prepare("SELECT usuario FROM activities_user WHERE actividad=?");
		$stmt->execute(array($id));
		$user_ids = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$users = array();
		
		foreach($user_ids as $user_id){
			$stmt = $this->db->prepare("SELECT * FROM users WHERE id=?");
			$stmt->execute(array($user_id["usuario"]));
			$user_db = $stmt->fetch(PDO::FETCH_ASSOC);
			
			array_push($users, new User($user_db["id"],
										$user_db["username"],
										$user_db["password"],
										$user_db["tipo"],
										$user_db["subtipo"],
										$user_db["entrenador"]));
		}
		
		return $users;
	}
	
	// Comprueba que un usuario no esta previamente registrado en una actividad
	public function userExistAct($activityid, $username){
		$stmt = $this->db->prepare("SELECT count(username) FROM use_participates_act WHERE (username=? AND activityid=?)");
		$stmt->execute(array($username, $activityid));
		
		if($stmt->fetchColumn() > 0) {
			return true;
		}
	}
	
	// Comprueba si un usuario existe.
	public function userExists($username) {
		$stmt = $this->db->prepare("SELECT count(username) FROM users where username=?");
		$stmt->execute(array($username));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}

	
	// Añade un usuario a la tabla "relacion" entre usuarios y la actividad en cuestion
	public function addUser($username, $activityid, $fecha) {
		$stmt = $this->db->prepare("INSERT INTO use_participates_act values (?,?,?)");
		$stmt->execute(array($username, $activityid, $fecha));
	}
	
	// Borra un usuario de la tabla "relacion" entre usuarios y la actividad en cuestion
	public function deleteUser($activityid, $username) {
		$stmt = $this->db->prepare("DELETE FROM use_participates_act WHERE activityid=?, username=?");
		$stmt->execute(array($activityid, $username));
	}
	
}