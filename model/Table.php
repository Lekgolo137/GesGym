<?php
require_once(__DIR__."/../core/ValidationException.php");

class Table {

	private $id;
	private $nombre;
	private $tipo;
	private $descripcion;

	// Constructor
	public function __construct($id=NULL, $nombre=NULL, $tipo=NULL, $descripcion=NULL) {
		$this->id = $id;
		$this->nombre = $nombre;
		$this->tipo = $tipo;
		$this->descripcion = $descripcion;
	}
	
	// GETTERS Y SETTERS TODAVIA NO CAMBIADOS

	// GETTERS
	public function getTableid() {
		return $this->tableid;
	}

	public function getTabletipo() {
		return $this->tabletipo;
	}

	// SETTERS
	public function setTableid($tableid) {
		$this->tableid = $tableid;
	}

	public function setTabletipo($tabletipo) {
		$this->tabletipo = $tabletipo;
	}

	// Check if a Table is valid for register
	public function checkIsValidForRegister() {
		$errors = array();
		if ($this->tabletipo != "person" && $this->tabletipo != "noPerson") {
			$errors["tabletipo"] = i18n("Tabletipo must be person or noPerson");
		}
		if (sizeof($errors)>0){
			throw new ValidationException($errors, i18n("Table is not valid"));
		}
	}
}
