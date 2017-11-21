<?php
// file: model/Resource.php

require_once(__DIR__."/../core/ValidationException.php");

class Resource {

	// String
	private $id;

	// ENUM String (instalación, material)
	private $tipo;
	
	// String
	private $location;

	// Integer (Cantidad, si es un material, o Aforo, si es una instalación)
	private $canafo;

	// Constructor
	public function __construct($id=NULL, $tipo=NULL, $location=NULL, $canafo=NULL) {
		$this->id = $id;
		$this->tipo = $tipo;
		$this->location = $location;
		$this->canafo = $canafo;
	}

	// GETTERS
	
	public function getId() {
		return $this->id;
	}
	
	public function getTipo() {
		return $this->tipo;
	}
	
	public function getLocation() {
		return $this->location;
	}
	
	public function getCanafo() {
		return $this->canafo;
	}
	
	// SETTERS

	public function setId($id) {
		$this->id = $id;
	}

	public function setTipo($tipo) {
		$this->tipo = $tipo;
	}

	public function setLocation($location) {
		$this->location = $location;
	}

	public function setCanafo($canafo) {
		$this->canafo = $canafo;
	}

}