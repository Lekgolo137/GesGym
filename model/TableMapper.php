<?php
require_once(__DIR__."/../core/PDOConnection.php");

class TableMapper {

	/**
	* Reference to the PDO connection
	* @var PDO
	*/
	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	//Saves a Table into the database
	public function save($table) {
		$stmt = $this->db->prepare("INSERT INTO tables (nombre, tipo, descripcion) VALUES (?,?,?)");
		$stmt->execute(array($table->getTableNombre(), $table->getTableTipo(), $table->getTableDescripcion()));
	}


	//Checks if a given tableid is already in the database
	public function tableIdExists($tableId) {
		$stmt = $this->db->prepare("SELECT count(id) FROM tables WHERE id=?");
		$stmt->execute(array($tableId));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}


	//Retrieves all Tables
	public function findAll() {
		$stmt = $this->db->query("SELECT * FROM tables");
		$tables_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$tables = array();

		foreach ($tables_db as $table) {
			array_push($tables, new Table($table["id"],$table["nombre"],$table["tipo"], $table["descripcion"]));
		}

		return $tables;
	}

	//Retrieves all Public Tables
	public function findAllPublic() {
		$stmt = $this->db->query("SELECT * FROM tables WHERE tipo='estandar'");
		$tables_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$tables = array();

		foreach ($tables_db as $table) {
			array_push($tables, new Table($table["id"],$table["nombre"],$table["tipo"], $table["descripcion"]));
		}

		return $tables;
	}

	//Retrieves all tables link to user
	public function findProp($user) {
		$stmt = $this->db->prepare("SELECT * FROM tables INNER JOIN tables_user ON tables.id=tables_user.tabla AND tables_user.usuario = ?");
		$stmt->execute(array($user->getId()));
		$tables_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$tables = array();

		foreach ($tables_db as $table) {
			array_push($tables, new Table($table["id"],$table["nombre"],$table["tipo"], $table["descripcion"]));
		}

		return $tables;
	}


	//Retrieves a Table from the database given its id
	public function findById($tableId){
		$stmt = $this->db->prepare("SELECT * FROM tables WHERE id=?");
		$stmt->execute(array($tableId));
		$table = $stmt->fetch(PDO::FETCH_ASSOC);

		if($table != null) {
			return new Table(
				$table["id"],
				$table["nombre"],
				$table["tipo"],
				$table["descripcion"]);
			} else {
				return NULL;
			}
		}

		//Updates a Table in the database
		public function update(Table $table, $tableId) {
			$stmt = $this->db->prepare("UPDATE tables SET nombre=?, tipo=?, descripcion=? WHERE id=?");
			$stmt->execute(array($table->getTableNombre(), $table->getTableTipo(), $table->getTableDescripcion(), $tableId));
		}


		//Deletes a Table into the database
		public function delete(Table $table) {
			$stmt = $this->db->prepare("DELETE FROM tables WHERE id=?");
			$stmt->execute(array($table->getTableId()));
		}

		//Link a table to user
		public function linkTableUser($user, $table) {
			$stmt = $this->db->prepare("INSERT INTO tables_user (usuario, tabla) VALUES (?,?)");
			$stmt->execute(array($user->getId(), $table->getTableId()));
		}

	}
