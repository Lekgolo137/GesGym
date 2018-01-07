<?php
// file: model/exercise.php

require_once(__DIR__."/../core/ValidationException.php");

class Exercise {

	// String
	private $exerId;

	// String
	private $exerName;

	// String
	private $exerTipo;

	// String
	private $descripcion;

	// String
	private $url;

	// Constructor
	public function __construct($exerId=NULL, $exerName=NULL, $exerTipo=NULL, $descripcion=NULL, $url=NULL) {
		$this->exerId = $exerId;
	    $this->exerName = $exerName;
		$this->exerTipo = $exerTipo;
		$this->descripcion = $descripcion;
		$this->url = $url;
	}

	// GETTERS
	public function getExerciseId() {
		return $this->exerId;
	}

	public function getExerName() {
		return $this->exerName;
	}

	public function getExerTipo() {
		return $this->exerTipo;
	}
	public function getDescripcion() {
		return $this->descripcion;
	}

	public function getUrl() {
		return $this->url;
	}
	
	// SETTERS
	public function setExerName($exerName) {
		$this->exerName = $exerName;
	}

	public function setExerTipo($exerTipo) {
		$this->exerTipo = $exerTipo;
	}
	
	public function setDescripcion($descripcion) {
		$this->descripcion = $descripcion;
	}
	public function setUrl($url) {
		$this->url = $url;
	}

	/*
	// Función para comprobar si el ejercicio es válido para ser creado
	public function checkIsValidForRegister() {
		$errors = array();
		if (strlen($this->exerciseId) < 5) {
			$errors["exerciseId"] = i18n("ID must be at least 5 characters in length");
		}
		if (sizeof($errors)>0){
			throw new ValidationException($errors, i18n("exercise is not valid"));
		}
	}*/
}
