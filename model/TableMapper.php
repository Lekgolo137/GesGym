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
	public function save($table, $exers) {
		$stmt = $this->db->prepare("INSERT INTO tables (nombre, tipo, descripcion) VALUES (?,?,?)");
		$stmt->execute(array($table->getTableNombre(), $table->getTableTipo(), $table->getTableDescripcion()));

		$stmt2 = $this->db->query("SELECT * FROM tables ORDER BY id DESC LIMIT 1");
		$tables_db = $stmt2->fetchAll(PDO::FETCH_ASSOC);

		$tables = array();

		foreach ($tables_db as $table) {
			array_push($tables, new Table($table["id"],$table["nombre"],$table["tipo"], $table["descripcion"]));
		}

		if(!empty($exers)){
			$N = count($exers);
			for($i=0; $i < $N; $i++)
			{
				$stmt3 = $this->db->prepare("INSERT INTO exercises_table (tabla, ejercicio) VALUES (?,?)");
				$stmt3->execute(array($tables[0]->getTableId(), $exers[$i]));
			}
		}
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
		public function update(Table $table, $tableId, $exers) {
			$stmt = $this->db->prepare("UPDATE tables SET nombre=?, tipo=?, descripcion=? WHERE id=?");
			$stmt->execute(array($table->getTableNombre(), $table->getTableTipo(), $table->getTableDescripcion(), $tableId));

			if(!empty($exers)){
				$stmt = $this->db->prepare("DELETE FROM exercises_table WHERE tabla=?");
				$stmt->execute(array($tableId));
				$N = count($exers);
				for($i=0; $i < $N; $i++)
				{
					$stmt3 = $this->db->prepare("INSERT INTO exercises_table (tabla, ejercicio) VALUES (?,?)");
					$stmt3->execute(array($tableId, $exers[$i]));
				}
			}

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

		//UnLink a table to user
		public function unlinkTableUser($user, $table) {
			$stmt = $this->db->prepare("DELETE FROM tables_user WHERE usuario=? AND tabla=?");
			$stmt->execute(array($user->getId(), $table->getTableId()));
		}

	}
