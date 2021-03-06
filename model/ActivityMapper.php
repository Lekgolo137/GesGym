<?php
// file: model/ActivityMapper.php

require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/Resource.php");
require_once(__DIR__."/../model/ActivityWUser.php");
require_once(__DIR__."/../model/User.php");

class ActivityMapper {

	// Referencia la conexion PDO
	private $db;

	//Constructor
	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	// Guarda una actividad V
	public function save($activity) {
		$stmt = $this->db->prepare("INSERT INTO activities (nombre, descripcion, dia, hora_inicio, hora_fin, plazas, entrenador) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$stmt->execute(array($activity->getNombre(), $activity->getDescripcion(), $activity->getDia(), $activity->getHoraInicio(), $activity->getHoraFin(), $activity->getPlazas(), $activity->getEntrenador()));
		$stmt = $this->db->query("SELECT MAX(id) FROM activities");
		$id = $stmt->fetch();
		return $id;
	}

	// Devuelve un array de $entrenadores
	public function findTrainers(){
		$stmt = $this->db->query("SELECT id, username FROM users WHERE tipo='entrenador'");
		$trainers = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$entrenadores = array();

		foreach($trainers as $trainer){
			array_push($entrenadores, new User($trainer["id"], $trainer["username"]));
		}

		return $entrenadores;
	}

	// Devuelve todos los recursos
	public function recurs(){
		$stmt = $this->db->query("SELECT * FROM resources");
		$recursos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$recursos = array();

		foreach($recursos_db as $recurso_db){
			array_push($recursos, new Resource($recurso_db["id"], $recurso_db["nombre"]));
		}

		return $recursos;
	}
 	
	// Separa los recursos ya asignados a la actividad
	public function recurActi($id){
		$stmt = $this->db->prepare("SELECT recurso FROM resources_activity WHERE actividad=?");
		$stmt->execute(array($id));
		$recursos_acti = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$recur_NoActi = array();
		$arrayAux = array();
		if(!empty($recursos_acti)){
			foreach($recursos_acti as $rec){
				$stmt = $this->db->prepare("SELECT * FROM resources WHERE id=?");
				$stmt->execute(array($rec["recurso"]));
				$recs = $stmt->fetchAll(PDO::FETCH_ASSOC);

				foreach($recs as $r){
					array_push($arrayAux, new Resource($r["id"], $r["nombre"], $r["aforo"]));
				}
			}


		foreach($recursos_acti as $recurso_acti){
			if(empty($recurso_acti))
				$stmt = $this->db->prepare("SELECT * FROM resources");
			else {
				$stmt = $this->db->prepare("SELECT * FROM resources WHERE id!=?");
				$stmt->execute(array($recurso_acti["recurso"]));
			}
			$recurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

			foreach($recurs as $recur){
				if(!in_array( new Resource($recur["id"], $recur["nombre"], $recur["aforo"]), $recur_NoActi))
					if(!in_array(	new Resource($recur["id"], $recur["nombre"], $recur["aforo"]), $arrayAux))
						array_push($recur_NoActi, new Resource($recur["id"], $recur["nombre"], $recur["aforo"]));
			}
		}
	}else{

		$stmt = $this->db->query("SELECT * FROM resources");
		$recs = $stmt->fetchAll(PDO::FETCH_ASSOC);

		foreach ($recs as $rec) {
			array_push($recur_NoActi, new Resource($rec["id"], $rec["nombre"], $rec["aforo"]));
		}
	}
		return $recur_NoActi;
	}

 	// Guarda una actividad con su recurso en la tabla relacion
	public function addRecActi($recur, $id) {
		$stmt = $this->db->prepare("INSERT INTO resources_activity VALUES (?,?)");
		$stmt->execute(array($id, $recur));
	}

	// Devuelve un array con los recursos de esa actividad
	public function actiRecursos($id) {
		$stmt = $this->db->prepare("SELECT recurso FROM resources_activity WHERE actividad=?");
		$stmt->execute(array($id));
		$recursos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$recursos = array();

		foreach($recursos_db as $recurso_db){
			$stmt = $this->db->prepare("SELECT nombre FROM resources WHERE id=?");
			$stmt->execute(array($recurso_db["recurso"]));
			$atri_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

			foreach($atri_db as $atri){
				array_push($recursos, new Resource($recurso_db["recurso"],
												   $atri["nombre"]));
			}
		}
		return $recursos;
	}
	
	// Elimina todos los recursos de una actividad.
	public function deleteResources($id) {
		$stmt = $this->db->prepare("DELETE FROM resources_activity WHERE actividad=?");
		$stmt->execute(array($id));
	}
	
	// Elimina todos los deportistas de una actividad.
	public function deleteSportsmans($id) {
		$stmt = $this->db->prepare("DELETE FROM activities_user WHERE actividad=?");
		$stmt->execute(array($id));
	}

	// Borra recursos de la actividades
	public function actiRecurDel($id,$recur) {
		$stmt = $this->db->prepare("DELETE FROM resources_activity WHERE actividad=? AND recurso=?");
		$stmt->execute(array($id,$recur));
	}

	// Comprueba si un nombre V
	public function actividadIDExists($activityid){
		$stmt = $this->db->prepare("SELECT count(id) FROM activities WHERE id=?");
		$stmt->execute(array($activityid));

		if($stmt->fetchColumn() > 0) {
			return true;
		}
	}

	// Devuelve el numero de plazas de una actividad V
	public function findNumPlazas($activityid) {
		$stmt = $this->db->prepare("SELECT * FROM activities WHERE id=?");
		$stmt->execute(array($activityid));
		$activity = $stmt->fetch(PDO::FETCH_ASSOC);

		return $activity["plazas"];
	}

	// Devuelve un array con todas las actividades V
	public function findAll() {
		$stmt = $this->db->query("SELECT * FROM activities");
		$activities_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$activities = array();

		foreach ($activities_db as $activity) {
			array_push($activities, new Activity($activity["id"], $activity["nombre"], $activity["descripcion"], $activity["dia"], $activity["hora_inicio"], $activity["hora_fin"], $activity["plazas"], $activity["entrenador"]));
		}

		return $activities;
	}

	// Devuelve una actividad V
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

	// Actualiza una actividad V
	public function update($activity) {
		$stmt = $this->db->prepare("UPDATE activities SET nombre=?, descripcion=?, dia=?, hora_inicio=?, hora_fin=?, plazas=?, entrenador=? WHERE id=?");
		$stmt->execute(array($activity->getNombre(), $activity->getDescripcion(), $activity->getDia(), $activity->getHoraInicio(), $activity->getHoraFin(), $activity->getPlazas(), $activity->getEntrenador(), $activity->getId()));
	}

	// Elimina una actividad V
	public function delete($activity) {
		$stmt = $this->db->prepare("DELETE FROM activities WHERE id=?");
		$stmt->execute(array($activity->getId()));
	}

	// Devuelve los usuarios de la actividad V
	public function findUsers($id) {
		$stmt = $this->db->prepare("SELECT * FROM activities_user WHERE actividad=?");
		$stmt->execute(array($id));
		$user_ids = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$users = array();

		foreach($user_ids as $user_id){

				array_push($users, new ActivityWUser($user_id["usuario"],$user_id["actividad"],$user_id["conf"]));
		}

		return $users;
	}
	
	// Devuelve los deportistas de una actividad.
	public function findActiSportsmans($id) {
		$stmt = $this->db->prepare("SELECT usuario FROM activities_user WHERE actividad=?");
		$stmt->execute(array($id));
		$sportsmans_ids = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$sportsmans = array();

		foreach($sportsmans_ids as $sportsman_id){
			$stmt = $this->db->prepare("SELECT username FROM users WHERE id=?");
			$stmt->execute(array($sportsman_id["usuario"]));
			$sportsman_db = $stmt->fetch(PDO::FETCH_ASSOC);
			
			array_push($sportsmans, new User($sportsman_id["usuario"], $sportsman_db["username"]));
		}

		return $sportsmans;
	}
	
	// Devuelve los deportistas de una actividad.
	public function findSportsmans() {
		$stmt = $this->db->query("SELECT * FROM users WHERE tipo='deportista'");
		$sportsmans_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$sportsmans = array();

		foreach($sportsmans_db as $sportsman_db){
			array_push($sportsmans, new User($sportsman_db["id"], $sportsman_db["username"]));
		}

		return $sportsmans;
	}

	// Devuelve el nombre del entrenadores
	public function nameUser($id){
		$stmt = $this->db->prepare("SELECT * FROM users WHERE id=?");
		$stmt->execute(array($id));
		$names = $stmt->fetchALL(PDO::FETCH_ASSOC);

		$users = array();
		foreach($names as $name){
			array_push($users, new User($name["id"],$name["username"]));
		}
		return $users;
	}

	// Comprueba que un usuario no esta previamente registrado en una actividad V
	public function userExistAct($activityid, $username){
		$stmt = $this->db->prepare("SELECT count(usuario) FROM activities_user WHERE usuario=? AND actividad=?");
		$stmt->execute(array($username, $activityid));

		if($stmt->fetchColumn() > 0) {
			return true;
		}
	}

	// Comprueba si un usuario existe. V
	public function userExists($username) {
		$stmt = $this->db->prepare("SELECT count(id) FROM users WHERE id=?");
		$stmt->execute(array($username));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}

	// Comprueba si un entrenador existe V
	public function trainerExists($username) {
		$stmt = $this->db->prepare("SELECT count(id) FROM users WHERE id=? AND tipo=?");
		$stmt->execute(array($username,"entrenador"));

		if ($stmt->fetchColumn() > 0){
			return true;
		}
	}

	// Añade un usuario a la tabla "relacion" entre usuarios y la actividad en cuestion V
	public function addUser($userid, $activityid) {
		$stmt = $this->db->prepare("INSERT INTO activities_user VALUES (?,?,?)");
		$stmt->execute(array($userid, $activityid, false));
	}

	// Borra un usuario de la tabla "relacion" entre usuarios y la actividad en cuestion V
	public function deleteUser($activityid, $username) {
		$stmt = $this->db->prepare("DELETE FROM activities_user WHERE usuario=? AND actividad=?");
		$stmt->execute(array($username, $activityid));
	}

	// Confirma la inscripción de un deportista en una actividad.
	public function confUser($activity_id, $user_id) {
		$stmt = $this->db->prepare("UPDATE activities_user SET conf=1 WHERE usuario=? AND actividad=?");
		$stmt->execute(array($user_id, $activity_id));
	}

	// Comprueba que el usuario no esta confirmado en la actividades
	public function userIsConf($activity_id, $user_id) {
		$stmt = $this->db->prepare("SELECT count(usuario) FROM activities_user WHERE usuario=? AND actividad=? AND conf=1");
		$stmt->execute(array($user_id, $activity_id));

		if($stmt->fetchColumn() > 0){
			return true;
		}
	}

	// Devuelve un array con todas las relaciones usario-actividad de una actividad pasada.
	public function listActiUser($activity_id) {
		$stmt = $this->db->prepare("SELECT * FROM activities_user WHERE actividad=?");
		$stmt->execute(array($activity_id));
		$relations_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$relations = array();

		foreach ($relations_db as $relation) {
			array_push($relations, new ActivityWUser($relation["usuario"], $relation["actividad"], $relation["conf"]));
		}

		return $relations;
	}

	// Lista Las actividades de un entrenador V
	public function actiTrainer($user){
		$stmt = $this->db->prepare("SELECT * FROM activities WHERE entrenador=?");
		$stmt->execute(array($user));
		$activities_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$activities = array();

		foreach ($activities_db as $activity){

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

	// Lista las actividades de un deportistas
	public function actiDepor($user){
		$stmt = $this->db->prepare("SELECT actividad FROM activities_user WHERE usuario=? AND conf=1");
		$stmt->execute(array($user));
		$activities_conf = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$activities = array();

		foreach ($activities_conf as $activity_conf){
			$stmt = $this->db->prepare("SELECT * FROM activities WHERE id=?");
			$stmt->execute(array($activity_conf["actividad"]));
			$actis = $stmt->fetchAll(PDO::FETCH_ASSOC);

			foreach ($actis as $acti){

				array_push($activities, new Activity($acti["id"],
									$acti["nombre"],
									$acti["descripcion"],
									$acti["dia"],
									$acti["hora_inicio"],
									$acti["hora_fin"],
									$acti["plazas"],
									$acti["entrenador"]));
			}
		}
		return $activities;
	}

}