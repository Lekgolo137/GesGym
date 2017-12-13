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
	public function add($user) {
		$stmt = $this->db->prepare("INSERT INTO users (username, password, tipo, subtipo) VALUES (?,?,?,?)");
		$stmt->execute(array($user->getUsername(), $user->getPassword(), $user->getTipo(), $user->getSubtipo()));
	}
	
	// Actualiza un usuario.
	public function update($user){
		$stmt = $this->db->prepare("UPDATE users SET username=?, password=?, tipo=?, subtipo=? WHERE id=?");
		$stmt->execute(array($user->getUsername(), $user->getPassword(), $user->getTipo(), $user->getSubtipo(), $user->getId()));
	}

	// Comprueba si un nombre de usuario ya existe.
	public function exists($username) {
		$stmt = $this->db->prepare("SELECT count(username) FROM users WHERE username=?");
		$stmt->execute(array($username));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}

	// Comprueba que un login sea válido.
	public function isValid($username, $password) {
		$stmt = $this->db->prepare("SELECT count(username) FROM users WHERE username=? and password=?");
		$stmt->execute(array($username, $password));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}
	
	// Devuelve el tipo de un usuario a partir de su nombre,
	public function findType($username) {
		$stmt = $this->db->prepare("SELECT * FROM users WHERE username=?");
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
			return new User($user["id"],
							$user["username"],
							$user["password"],
							$user["tipo"],
							$user["subtipo"]);
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
			array_push($users, new User($user["id"],
										$user["username"],
										$user["password"],
										$user["tipo"],
										$user["subtipo"]));
		}

		return $users;
	}

	// Elimina un usuario
	public function delete($user) {
		$stmt = $this->db->prepare("DELETE FROM users WHERE id=?");
		$stmt->execute(array($user->getId()));
	}
}