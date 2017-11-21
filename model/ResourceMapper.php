<?php
// file: model/ResourceMapper.php

require_once(__DIR__."/../core/PDOConnection.php");

class ResourceMapper {

	// Referencia a la conexión PDO
	private $db;

	// Constructor
	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	// Comprueba si un ID ya existe.
	public function idExists($id) {
		$stmt = $this->db->prepare("SELECT count(id) FROM resources where id=?");
		$stmt->execute(array($id));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}
	
	// Guarda un recurso.
	public function save($resource) {
		$stmt = $this->db->prepare("INSERT INTO resources values (?,?,?,?)");
		$stmt->execute(array($resource->getId(), $resource->getTipo(), $resource->getLocation(), $resource->getCanafo()));
	}
	
	// Devuelve todos los recursos.
	public function findAll() {
		$stmt = $this->db->query("SELECT * FROM resources");
		$resources_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$resources = array();

		foreach ($resources_db as $resource) {
			array_push($resources, new Resource($resource["id"],
										$resource["tipo"],
										$resource["location"],
										$resource["canafo"]));
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
							$resource["tipo"],
							$resource["location"],
							$resource["canafo"]);
		} else {
			return NULL;
		}
	}
	
	// Elimina un recurso
	public function delete($resource) {
		$stmt = $this->db->prepare("DELETE from resources WHERE id=?");
		$stmt->execute(array($resource->getId()));
	}
	
	// Actualiza un recurso.
	public function update($resource){
		$stmt = $this->db->prepare("UPDATE resources set tipo=?, location=?, canafo=? where id=?");
		$stmt->execute(array($resource->getTipo(), $resource->getLocation(), $resource->getCanafo(), $resource->getId()));
	}

}