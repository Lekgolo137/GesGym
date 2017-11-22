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
		$stmt = $this->db->prepare("INSERT INTO tables values (?,?)");
		$stmt->execute(array($table->getTableid(), $table->getTabletipo()));
	}


	//Checks if a given tableid is already in the database
	public function tableidExists($tableid) {
		$stmt = $this->db->prepare("SELECT count(tableid) FROM tables where tableid=?");
		$stmt->execute(array($tableid));

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
			array_push($tables, new Table($table["tableid"], $table["tabletipo"]));
		}

		return $tables;
	}

	//Retrieves a Table from the database given its id
	public function findById($tableid){
		$stmt = $this->db->prepare("SELECT * FROM tables WHERE tableid=?");
		$stmt->execute(array($tableid));
		$table = $stmt->fetch(PDO::FETCH_ASSOC);

		if($table != null) {
			return new Table(
				$table["tableid"],
				$table["tabletipo"]);
			} else {
				return NULL;
			}
		}

		//Updates a Table in the database
		public function update(Table $table, $tablesid) {
			$stmt = $this->db->prepare("UPDATE tables set tableid=?, tabletipo=? where tableid=?");
			$stmt->execute(array($table->getTableid(), $table->getTabletipo(), $tablesid));
		}


		//Deletes a Table into the database
		public function delete(Table $table) {
			$stmt = $this->db->prepare("DELETE from tables WHERE tableid=?");
			$stmt->execute(array($table->getTableid()));
		}

	}
