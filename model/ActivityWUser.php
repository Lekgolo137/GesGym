<?php
// file: model/ActivityWUser.php


class ActivityWUser{

  //Integer
  private $usuario;

  //Integer
  private $actividad;

  //BIT
  private $conf;

  //Constructor
  public function __construct($usuario=NULL, $actividad=NULL, $conf=NULL){
    $this->usuario = $usuario;
    $this->actividad = $actividad;
    $this->conf = $conf;
  }

  //GETTERS

  public function getUsuario(){
    return $this->usuario;
  }

  public function getActividad(){
    return $this->actividad;
  }

  public function getConf(){
    return $this->conf;
  }

  //SETTERS

  public function setUsuario($usuario){
    $this->usuario = $usuario;
  }

  public function setActividad($actividad){
    $this->activdad = $actividad;
  }

  public function setConf($conf){
    $this->conf = $conf;
  }
}
