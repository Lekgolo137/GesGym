<?php
// file: model/Resource.php

require_once(__DIR__."/../core/ValidationException.php");

class Resource {

	// Integer
	private $id;

	// String
	private $nombre;
	
	// Integer
	private $aforo;

	// String
	private $descripcion;

	// Constructor
	public function __construct($id=NULL, $nombre=NULL, $aforo=NULL, $descripcion=NULL) {
		$this->id = $id;
		$this->nombre = $nombre;
		$this->aforo = $aforo;
		$this->descripcion = $descripcion;
	}

	// GETTERS
	
	public function getId() {
		return $this->id;
	}
	
	public function getNombre() {
		return $this->nombre;
	}
	
	public function getAforo() {
		return $this->aforo;
	}
	
	public function getDescripcion() {
		return $this->descripcion;
	}
	
	// SETTERS

	public function setId($id) {
		$this->id = $id;
	}

	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}

	public function setAforo($aforo) {
		$this->aforo = $aforo;
	}

	public function setDescripcion($descripcion) {
		$this->descripcion = $descripcion;
	}

}