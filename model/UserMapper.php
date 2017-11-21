<?php
// file: model/UserMapper.php

require_once(__DIR__."/../core/PDOConnection.php");

class UserMapper {

	// Referencia a la conexión PDO
	private $db;

	// Constructor
	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	// Guarda un usuario.
	public function save($user) {
		$stmt = $this->db->prepare("INSERT INTO users values (?,?,?,?,?,?,?)");
		$stmt->execute(array($user->getUsername(), $user->getPasswd(), $user->getTlf(), $user->getTipo(), $user->getCalle(), $user->getCiudad(), $user->getCodPostal()));
	}
	
	// Actualiza un usuario.
	public function update($user){
		$stmt = $this->db->prepare("UPDATE users set passwd=?, tlf=?, tipo=?, calle=?, ciudad=?, codPostal=? where username=?");
		$stmt->execute(array($user->getPasswd(), $user->getTlf(), $user->getTipo(), $user->getCalle(), $user->getCiudad(), $user->getCodPostal(), $user->getUsername()));
	}

	// Comprueba si un nombre de usuario ya existe.
	public function usernameExists($username) {
		$stmt = $this->db->prepare("SELECT count(username) FROM users where username=?");
		$stmt->execute(array($username));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}

	// Comprueba que un login sea válido.
	public function isValidUser($username, $passwd) {
		$stmt = $this->db->prepare("SELECT count(username) FROM users where username=? and passwd=?");
		$stmt->execute(array($username, $passwd));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}
	
	// Devuelve el tipo de un usuario a partir de su nombre,
	public function findType($username) {
		$stmt = $this->db->prepare("SELECT * FROM users where username=?");
		$stmt->execute(array($username));
		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		return $user["tipo"];
	}
	
	// Devuelve un usuario a partir de su nombre.
	public function findByUsername($username){
		$stmt = $this->db->prepare("SELECT * FROM users WHERE username=?");
		$stmt->execute(array($username));
		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		if($user != null) {
			return new User($user["username"],
							$user["passwd"],
							$user["tlf"],
							$user["tipo"],
							$user["calle"],
							$user["ciudad"],
							$user["codPostal"]);
		} else {
			return NULL;
		}
	}
	
	// Devuelve todos los usuarios.
	public function findAll() {
		$stmt = $this->db->query("SELECT * FROM users");
		$users_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$users = array();

		foreach ($users_db as $user) {
			array_push($users, new User($user["username"],
										$user["passwd"],
										$user["tlf"],
										$user["tipo"],
										$user["calle"],
										$user["ciudad"],
										$user["codPostal"]));
		}

		return $users;
	}

	// Elimina un usuario
	public function delete($user) {
		$stmt = $this->db->prepare("DELETE from users WHERE username=?");
		$stmt->execute(array($user->getUsername()));
	}
}