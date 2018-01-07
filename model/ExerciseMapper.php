<?php
// file: model/exerciseMapper.php

require_once(__DIR__."/../core/PDOConnection.php");

/**
* Class ExerciseMapper
*
* Database interface for Exercise entities
*/
class ExerciseMapper {

	/**
	* Reference to the PDO connection
	* @var PDO
	*/
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	/**
	* Saves a Exercise into the database
	*
	* @param Exercise $exercise The exercise to be saved
	* @throws PDOException if a database error occurs
	* @return void
	*/
	public function save($exercise) {
		$stmt = $this->db->prepare("INSERT INTO exercises (nombre, tipo, descripcion, url) values (?,?,?,?)");
		$stmt->execute(array($exercise->getExerName(), $exercise->getExerTipo(), $exercise->getDescripcion(), $exercise->getUrl()));
	}

	// Actualiza un ejercicio
	public function update($exercise){
		$stmt = $this->db->prepare("UPDATE exercises set nombre=?, tipo=?, descripcion=?, url=? where id=?");
		$stmt->execute(array($exercise->getExerName(), $exercise->getExerTipo(), $exercise->getDescripcion(), $exercise->getUrl(), $exercise->getExerciseId()));
	}

	// Devuelve el tipo de un ejercicio a partir de su identificador
	public function findType($exerciseId) {
		$stmt = $this->db->prepare("SELECT * FROM exercises where id=?");
		$stmt->execute(array($exerciseId));
		$exer = $stmt->fetch(PDO::FETCH_ASSOC);

		return $exer["tipo"];
	}

	// Comprueba si un id de ejercicio ya existe
	public function exerciseIdExists($exerciseId) {
		$stmt = $this->db->prepare("SELECT count(id) FROM exercises where id=?");
		$stmt->execute(array($exerciseId));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}
	// Devuelve un ejercicio a partir de un identificador
	public function findByExerId($exerciseId){
		$stmt = $this->db->prepare("SELECT * FROM exercises WHERE Id=?");
		$stmt->execute(array($exerciseId));
		$exer = $stmt->fetch(PDO::FETCH_ASSOC);

		if($exer != null) {
			return new Exercise($exer["id"], $exer["nombre"], $exer["tipo"], $exer["descripcion"], $exer["url"]);
		} else {
			return NULL;
		}
	}

	/**
	* Retrieves all exercises
	*/
	public function findAll() {
		$stmt = $this->db->query("SELECT * FROM exercises");
		$exers_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$exers = array();

		foreach ($exers_db as $exer) {
			array_push($exers, new Exercise($exer["id"], $exer["nombre"], $exer["tipo"], $exer["descripcion"], $exer["url"]));
		}

		return $exers;
	}
	// Elimina un ejercicio
	public function delete(Exercise $exer) {
		$stmt = $this->db->prepare("DELETE from exercises WHERE Id=?");
		$stmt->execute(array($exer->getExerciseId()));
	}
}
