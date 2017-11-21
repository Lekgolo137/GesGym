<?php
// file: model/exercise.php

require_once(__DIR__."/../core/ValidationException.php");

class Exercise {

	// String
	private $exerciseId;

	// String
	private $exerName;

	// String
	private $exerTipo;

	// Constructor
	public function __construct($exerciseId=NULL, $exerName=NULL, $exerTipo=NULL) {
		$this->exerciseId = $exerciseId;
		$this->exerName = $exerName;
		$this->exerTipo = $exerTipo;
	}

	// GETTERS
	
	public function getExerciseId() {
		return $this->exerciseId;
	}
	
	public function getExerName() {
		return $this->exerName;
	}

	public function getExerTipo() {
		return $this->exerTipo;
	}
	
	// SETTERS

	public function setExerciseId($exerciseId) {
		$this->exerciseId = $exerciseId;
	}

	public function setExerName($exerName) {
		$this->exerName = $exerName;
	}

	public function setExerTipo($exerTipo) {
		$this->exerTipo = $exerTipo;
	}

	// Función para comprobar si el ejercicio es válido para ser creado
	public function checkIsValidForRegister() {
		$errors = array();
		if (strlen($this->exerciseId) < 5) {
			$errors["exerciseId"] = i18n("ID must be at least 5 characters in length");
		}
		if (sizeof($errors)>0){
			throw new ValidationException($errors, i18n("exercise is not valid"));
		}
	}
}
 
