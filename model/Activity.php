<?php
// file: model/Activity.php


class Activity{

	//Integer
	private $id;

	//String
	private $nombre;

	//String
	private $descripcion;

	//String SET('lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo')
	private $dia;

	//String (TIME)
	private $hora_inicio;

	//String (TIME)
	private $hora_fin;

	//Integer
	private $plazas;

	//Integer (ID)
	private $entrenador;

	//Constructor
	public function __construct($id=NULL, $nombre=NULL, $descripcion=NULL, $dia=NULL, $hora_inicio=NULL, $hora_fin=NULL, $plazas=0, $entrenador=NULL) {
		$this->id=$id;
		$this->nombre=$nombre;
		$this->descripcion=$descripcion;
		$this->dia=$dia;
		$this->hora_inicio=$hora_inicio;
		$this->hora_fin=$hora_fin;
		$this->plazas=$plazas;
		$this->entrenador=$entrenador;
	}

	//GETTERS

	public function getId(){
		return $this->id;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function getDescripcion(){
		return $this->descripcion;
	}

	public function getDia(){
		return $this->dia;
	}

	public function getHoraInicio(){
		return $this->hora_inicio;
	}

	public function getHoraFin(){
		return $this->hora_fin;
	}

	public function getPlazas(){
		return $this->plazas;
	}

	public function getEntrenador(){
		return $this->entrenador;
	}

	//SETTERS

	public function setId($id){
		$this->id = $id;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}

	public function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}

	public function setDia($dia){
		$this->dia = $dia;
	}

	public function setHoraInicio($hora_inicio){
		$this->hora_inicio = $hora_inicio;
	}

	public function setHoraFin($hora_fin){
		$this->hora_fin = $hora_fin;
	}

	public function setPlazas($plazas){
		$this->plazas = $plazas;
	}

	public function setEntrenador($entrenador){
		$this->entrenador = $entrenador;
	}

	//Método Adicional

	public function addDia($dia){
		$this->dia .= ','.$dia;
	}
}
