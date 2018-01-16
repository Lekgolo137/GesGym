<?php
require_once(__DIR__."/../core/ValidationException.php");

class Table {

	// String
	private $tableId;

	// String
	private $tableNombre;

	// String
	private $tableTipo;

	// String
	private $tableDescripcion;

	// Constructor
	public function __construct($tableId=NULL, $tableNombre=NULL, $tableTipo=NULL, $tableDescripcion=NULL) {
		$this->tableId = $tableId;
		$this->tableNombre = $tableNombre;
		$this->tableTipo = $tableTipo;
		$this->tableDescripcion = $tableDescripcion;
	}

	// GETTERS
	public function getTableId() {
		return $this->tableId;
	}

	public function getTableNombre() {
		return $this->tableNombre;
	}

	public function getTableTipo() {
		return $this->tableTipo;
	}

	public function getTableDescripcion() {
		return $this->tableDescripcion;
	}

	// SETTERS
	public function setTableId($tableId) {
		$this->tableId = $tableId;
	}

	public function setTableNombre($tableNombre) {
		$this->tableNombre = $tableNombre;
	}

	public function setTableTipo($tableTipo) {
		$this->tableTipo = $tableTipo;
	}

	public function setTableDescripcion($tableDescripcion) {
		$this->tableDescripcion = $tableDescripcion;
	}

	// Check if a Table is valid for register
	public function checkIsValidForRegister() {
		$errors = array();
		if ($this->tableTipo != "estandar" && $this->tableTipo != "personalizada") {
			$errors["tableTipo"] = i18n("Table type must be standard or customize");
		}
		if (sizeof($errors)>0){
			throw new ValidationException($errors, i18n("Table is not valid"));
		}
	}
}
