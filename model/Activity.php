<?php
// file: model/Actity.php


class Activity{
	
	//Integer
	private $id;
	
	//String
	private $nombre;
	
	//String
	private $descripcion;
	
	//String SET ('lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo')
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
	public function __construct($id=NULL, $nombre=NULL, $descripcion=NULL, $dia=NULL, $hora_inicio=NULL, $hora_fin=NULL, $plazas=NULL, $entrenador=NULL) {
		$this->id=$id;
		$this->nombre=$nombre;
		$this->descripcion=$descripcion;
		$this->dia=$dia;
		$this->hora_inicio=$hora_inicio;
		$this->hora_fin=$hora_fin;
		$this->plazas=$plazas;
		$this->entrenador=$entrenador;
	}
	
	// FALTAN GETTERS Y SETTERS DE TODOS LOS ATRIBUTOS MENOS ID Y NOMBRE
	
	//GETTERS
	
	public function getId(){
		return $this->id;
	}
	
	public function getNombre(){
		return $this->nombre;
	}
	
	//SETTERS
	
	public function setId($id){
		$this->id = $id;
	}
	
	public function setNombre($nombre){
		$this->nombre = $nombre;
	}
}