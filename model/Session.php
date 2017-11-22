<?php
require_once(__DIR__."/../core/ValidationException.php");

class Session {

  // String
  private $sesionid;

  // String
  private $username;

  // String
  private $tableid;

  // Date
  private $fechaInicio;

  // Date
  private $fechaFin;

  // Constructor
  public function __construct($sessionid=NULL, $username=NULL, $tableid=NULL, $fechaInicio=NULL, $fechaFin=NULL) {
    $this->sessionid = $sessionid;
    $this->username = $username;
    $this->tableid = $tableid;
    $this->fechaInicio = $fechaInicio;
    $this->fechaFin = $fechaFin;
  }

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
