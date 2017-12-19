<?php
// file: model/ResourceMapper.php

require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/Activity.php");

class ResourceMapper {

	// Referencia a la conexión PDO
	private $db;

	// Constructor
	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}
	
	// Añade un nuevo recurso.
	public function add($resource) {
		$stmt = $this->db->prepare("INSERT INTO resources (nombre, aforo, descripcion) VALUES (?, ?, ?)");
		$stmt->execute(array($resource->getNombre(), $resource->getAforo(), $resource->getDescripcion()));
	}
	
	// Devuelve todos los recursos.
	public function findAll() {
		$stmt = $this->db->query("SELECT * FROM resources");
		$resources_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$resources = array();

		foreach ($resources_db as $resource) {
			array_push($resources, new Resource($resource["id"],
												$resource["nombre"],
												$resource["aforo"],
												$resource["descripcion"]));
		}

		return $resources;
	}
	
	// Devuelve un recurso a partir de su ID.
	public function findById($id){
		$stmt = $this->db->prepare("SELECT * FROM resources WHERE id=?");
		$stmt->execute(array($id));
		$resource = $stmt->fetch(PDO::FETCH_ASSOC);

		if($resource != null) {
			return new Resource($resource["id"],
								$resource["nombre"],
								$resource["aforo"],
								$resource["descripcion"]);
		} else {
			return NULL;
		}
	}
	
	// Elimina un recurso.
	public function delete($resource) {
		// Primero eliminamos cualquier relación que tenga el recurso con actividades.
		$stmt = $this->db->prepare("DELETE FROM resources_activity WHERE recurso=?");
		$stmt->execute(array($resource->getId()));
		// Luego eliminamos el recurso en si.
		$stmt = $this->db->prepare("DELETE FROM resources WHERE id=?");
		$stmt->execute(array($resource->getId()));
	}
	
	// Actualiza un recurso.
	public function update($resource){
		$stmt = $this->db->prepare("UPDATE resources SET nombre=?, aforo=?, descripcion=? WHERE id=?");
		$stmt->execute(array($resource->getNombre(), $resource->getAforo(), $resource->getDescripcion(), $resource->getId()));
	}
	
	// Devuelve las actividades que usan un recurso a partir de su ID.
	public function findActivities($id) {
		$stmt = $this->db->prepare("SELECT actividad FROM resources_activity WHERE recurso=?");
		$stmt->execute(array($id));
		$activity_ids = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$activities = array();
		
		foreach ($activity_ids as $activity_id) {
			$stmt = $this->db->prepare("SELECT nombre FROM activities WHERE id=?");
			$stmt->execute(array($activity_id["actividad"]));
			$activity_name = $stmt->fetch(PDO::FETCH_ASSOC);
			
			array_push($activities, new Activity($activity_id["actividad"],
												 $activity_name["nombre"]));
		}

		return $activities;
	}

}