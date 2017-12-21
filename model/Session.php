<?php
require_once(__DIR__."/../core/ValidationException.php");

class Session {

  private $id;
  private $comentarios;
  private $fecha_inicio;
  private $fecha_fin;
  private $usuario;
  private $tabla;

  // Constructor
  public function __construct($id=NULL, $comentarios=NULL, $fecha_inicio=NULL, $fecha_fin=NULL, $usuario=NULL, $tabla=NULL) {
    $this->id = $id;
    $this->comentarios = $comentarios;
    $this->fecha_inicio = $fecha_inicio;
    $this->fecha_fin = $fecha_fin;
    $this->usuario = $usuario;
    $this->tabla = $tabla;
  }
  
  // GETTERS Y SETTERS TODAVIA NO CAMBIADOS

  // GETTERS
  public function getSessionid() {
    return $this->sessionid;
  }

  public function getUsername() {
    return $this->username;
  }

  public function getTableid() {
    return $this->tableid;
  }

  public function getFechaInicio() {
    return $this->fechaInicio;
  }

  public function getFechaFin() {
    return $this->fechaFin;
  }

  // SETTERS
  public function setSessionid($sessionid) {
    $this->sessionid = $sessionid;
  }

  public function setUsername($username) {
    $this->username = $username;
  }

  public function setTableid($tableid) {
    $this->tableid = $tableid;
  }

  public function setFechaInicio($fechaInicio) {
    $this->fechaInicio = $fechaInicio;
  }

  public function setFechaFin($fechaFin) {
    $this->fechaFin = $fechaFin;
  }
}
