<?php
// file: model/User.php

require_once(__DIR__."/../core/ValidationException.php");

class User {

	// String
	private $username;

	// String
	private $passwd;
	
	// Integer
	private $tlf;

	// String
	private $tipo;

	// String
	private $calle;

	// String
	private $ciudad;
	
	// String
	private $codPostal;

	// Constructor
	public function __construct($username=NULL, $passwd=NULL, $tlf=NULL, $tipo=NULL, $calle=NULL, $ciudad=NULL, $codPostal=NULL) {
		$this->username = $username;
		$this->passwd = $passwd;
		$this->tlf = $tlf;
		$this->tipo = $tipo;
		$this->calle = $calle;
		$this->ciudad = $ciudad;
		$this->codPostal = $codPostal;
	}

	// GETTERS
	
	public function getUsername() {
		return $this->username;
	}
	
	public function getPasswd() {
		return $this->passwd;
	}
	
	public function getTlf() {
		return $this->tlf;
	}
	
	public function getTipo() {
		return $this->tipo;
	}
	
	public function getCalle() {
		return $this->calle;
	}
	
	public function getCiudad() {
		return $this->ciudad;
	}
	
	public function getCodPostal() {
		return $this->codPostal;
	}
	// SETTERS

	public function setUsername($username) {
		$this->username = $username;
	}

	public function setPassword($passwd) {
		$this->passwd = $passwd;
	}

	public function setTlf($tlf) {
		$this->tlf = $tlf;
	}

	public function setTipo($tipo) {
		$this->tipo = $tipo;
	}

	public function setCalle($calle) {
		$this->calle = $calle;
	}

	public function setCiudad($ciudad) {
		$this->ciudad = $ciudad;
	}

	public function setCodPostal($codPostal) {
		$this->codPostal = $codPostal;
	}

	// Función para comprobar si el usuario es válido para ser creado
	public function checkIsValidForRegister() {
		$errors = array();
		if (strlen($this->username) < 5) {
			$errors["username"] = i18n("Username must be at least 5 characters in length");
		}
		if (strlen($this->passwd) < 5) {
			$errors["passwd"] = i18n("Password must be at least 5 characters in length");
		}
		if (sizeof($errors)>0){
			throw new ValidationException($errors, i18n("user is not valid"));
		}
	}
}
