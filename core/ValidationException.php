<?php
//file: core/ValidationException.php

// Excepción para los errores en la validación de formularios.
class ValidationException extends Exception {

	// Array de errores.
	private $errors = array();

	public function __construct(array $errors, $msg=NULL){
		parent::__construct($msg);
		$this->errors = $errors;
	}

	// Devuelve los errores de validación.
	public function getErrors() {
		return $this->errors;
	}
}