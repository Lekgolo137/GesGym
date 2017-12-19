<?php
// file: model/User.php

require_once(__DIR__."/../core/ValidationException.php");

class User {
	
	// Integer
	private $id;

	// String
	private $username;

	// String
	private $password;

	// ENUM String (deportista, entrenador, administrador)
	private $tipo;

	// ENUM String (tdu, pef) [null para entrenadores y administradores]
	private $subtipo;
	
	//Integer (ID)
	private $entrenador;

	// Constructor
	public function __construct($id=NULL, $username=NULL, $password=NULL, $tipo=NULL, $subtipo=NULL, $entrenador=NULL) {
		$this->id = $id;
		$this->username = $username;
		$this->password = $password;
		$this->tipo = $tipo;
		$this->subtipo = $subtipo;
		$this->entrenador = $entrenador;
	}

	// GETTERS
	
	public function getId() {
		return $this->id;
	}
	
	public function getUsername() {
		return $this->username;
	}
	
	public function getPassword() {
		return $this->password;
	}
	
	public function getTipo() {
		return $this->tipo;
	}
	
	public function getSubtipo() {
		return $this->subtipo;
	}
	
	public function getEntrenador() {
		return $this->entrenador;
	}
	

	// SETTERS
	
	public function setId($id) {
		$this->id = $id;
	}

	public function setUsername($username) {
		$this->username = $username;
	}

	public function setPassword($password) {
		$this->password = $password;
	}

	public function setTipo($tipo) {
		$this->tipo = $tipo;
	}

	public function setSubtipo($subtipo) {
		$this->subtipo = $subtipo;
	}
	
	public function setEntrenador($entrenador) {
		$this->entrenador = $entrenador;
	}
	
	// Comprueba si el nombre de usuario y contraseña tienen por lo menos 5 caracteres.
	public function isValid() {
		$errors = array();
		if (strlen($this->username) < 5) {
			$errors["username"] = i18n("Username must be at least 5 characters in length");
		}
		if (strlen($this->password) < 5) {
			$errors["password"] = i18n("Password must be at least 5 characters in length");
		}
		if (sizeof($errors)>0){
			throw new ValidationException($errors, i18n("User is not valid"));
		}
	}
}