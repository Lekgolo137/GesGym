<?php
//file: controller/BaseController.php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../model/User.php");

class BaseController {

	// Instancia del view manager.
	protected $view;

	// Instancia del usuario actual.
	protected $currentUser;

	public function __construct() {

		// Genera la instancia del view manager y la guarda en $view.
		$this->view = ViewManager::getInstance();

		// Se inica una sesión en caso de que no se haya hecho ya.
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		// Si el usuario está logeado se guarda su nombre y tipo en $currentUser.
		if(isset($_SESSION["currentuser"])) {
			$this->currentUser = new User();
			$this->currentUser->setUsername($_SESSION["currentuser"]);
			$this->currentUser->setTipo($_SESSION["currentusertype"]);
			
			// Se ponen los datos del usuario en $view, ya que algunas vistas los utilizan.
			$this->view->setVariable("currentusername", $this->currentUser->getUsername());
			$this->view->setVariable("currentusertype", $this->currentUser->getTipo());
		}
	}
}