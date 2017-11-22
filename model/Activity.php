<?php
// file: model/Actity.php


class Activity{
	
	//String
	private $activityid;
	
	//Integer
	private $plazas;
	
	//Constructor
	public function __construct($activityid=NULL, $plazas=NULL) {
		$this->activityid=$activityid;
		$this->plazas=$plazas;
	}
	
	//GETTERS
	
	public function getActivityID(){
		return $this->activityid;
	}
	
	public function getPlazas(){
		return $this->plazas;
	}
	
	//SETTERS
	
	public function setActivityID($activityid){
		$this-> activityid = $activityid;
	}
	
	public function setPlazas($plazas){
		$this-> plazas = $plazas;
	}
}