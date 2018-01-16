<?php
require_once(__DIR__."/../core/ValidationException.php");

class Session {

  private $id;
  private $comentarios;
  private $fechaInicio;
  private $fechaFin;
  private $usuario;
  private $tabla;

  // Constructor
  public function __construct($id=NULL, $comentarios=NULL, $fechaInicio=NULL, $fechaFin=NULL, $usuario=NULL, $tabla=NULL) {
    $this->id = $id;
    $this->comentarios = $comentarios;
    $this->fechaInicio = $fechaInicio;
    $this->fechaFin = $fechaFin;
    $this->usuario = $usuario;
    $this->tabla = $tabla;
  }

  // GETTERS Y SETTERS TODAVIA NO CAMBIADOS

  // GETTERS
  public function getSessionId() {
    return $this->id;
  }

  public function getComents() {
    return $this->comentarios;
  }

  public function getFechaInicio() {
    return $this->fechaInicio;
  }

  public function getFechaFin() {
    return $this->fechaFin;
  }

  public function getUserId() {
    return $this->usuario;
  }

  public function getTableId() {
    return $this->tabla;
  }

  // SETTERS
  public function setSessionId($id) {
    $this->id = $id;
  }

  public function setComents($comentarios) {
    $this->comentarios = $comentarios;
  }

  public function setFechaInicio($fechaInicio) {
    $this->fechaInicio = $fechaInicio;
  }

  public function setFechaFin($fechaFin) {
    $this->fechaFin = $fechaFin;
  }

  public function setUserId($usuario) {
    $this->usuario = $usuario;
  }

  public function setTableId($tabla) {
    $this->tabla = $tabla;
  }

}
