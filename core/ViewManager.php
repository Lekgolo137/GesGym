<?php
// file: core/ViewManager.php

/*
* Clase que hace de interfaz entre el controlador y la vista.
*
* Es un singleton por lo que debe instanciarse con getInstance()
*
* Usos principales:
*
* 1. Guardar variables del controlador y hacerlas visibles a la vista.
*
* 2. Renderizar las vistas.
*
* 3. Sistema de plantillas basado en fragmentos mediante buffer. Los contenidos de las vistas se guardan en DEFAULT_FRAGMENT,
*    que luego es cargado desde la plantilla (layout). También se pueden crear otros fragmentos para organizar el código (css, js, etc).
*/
class ViewManager {

	// Variables
	const DEFAULT_FRAGMENT = "__default__";
	private $fragmentContents = array();
	private $variables = array();
	private $currentFragment = self::DEFAULT_FRAGMENT;
	private $layout = "default";

	// Constructor
	private function __construct() {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		ob_start();
	}
	
	/* FRAGMENTOS */

	// Guarda el contenido del buffer en $currentFragment y borra el buffer.
	private function saveCurrentFragment() {
		$this->fragmentContents[$this->currentFragment].=ob_get_contents();
		ob_clean();
	}

	// Cambia el fragmento sobre el que se trabaja, guardando primero lo que hay en el actual.
	public function moveToFragment($name) {
		$this->saveCurrentFragment();
		$this->currentFragment = $name;
	}

	// Equivalente a la función anterior pero cambia directamente al fragmento por defecto sin necesidad de pasarlo como parámetro.
	public function moveToDefaultFragment(){
		$this->moveToFragment(self::DEFAULT_FRAGMENT);
	}

	// Devuelve los elementos acumulados en un fragmento específico (si no existe se devuelve una cadena vacía).
	public function getFragment($fragment, $default="") {
		if (!isset($this->fragmentContents[$fragment])) {
			return $default;
		}
		return $this->fragmentContents[$fragment];
	}

	/* VARIABLES */

	// Crea una variable o la modifica si ya existe.
	public function setVariable($varname, $value, $flash=false) {
		$this->variables[$varname] = $value;
		// Una variable flash se guarda en la sesión.
		if ($flash==true) {
			if(!isset($_SESSION["viewmanager__flasharray__"])) {
				$_SESSION["viewmanager__flasharray__"][ $varname]=$value;
				print_r($_SESSION["viewmanager__flasharray__"]);
			}else{
				$_SESSION["viewmanager__flasharray__"][$varname]=$value;
			}
		}
	}

	// Devuelve una variable.
	public function getVariable($varname, $default=NULL) {
		if (!isset($this->variables[$varname])) {
			// Si la variable es flash, esta se borra tras devolverla.
			if (isset($_SESSION["viewmanager__flasharray__"]) && isset($_SESSION["viewmanager__flasharray__"][$varname])){
				$toret=$_SESSION["viewmanager__flasharray__"][$varname];
				unset($_SESSION["viewmanager__flasharray__"][$varname]);
				return $toret;
			}
			return $default;
		}
		return $this->variables[$varname];
	}

	// Establece un mensaje flash.
	public function setFlash($flashMessage) {
		$this->setVariable("__flashmessage__", $flashMessage, true);

	}

	// Devuelve el mensaje flash que haya guardado actualmente.
	public function popFlash() {
		return $this->getVariable("__flashmessage__", "");
	}


	/* RENDERIZADO */

	// Establece la plantilla a utilizar.
	public function setLayout($layout) {
		$this->layout = $layout;
	}

	// Renderiza una vista en función del controlador y acción pasados.
	public function render($controller, $viewname) {
		include(__DIR__."/../view/$controller/$viewname.php");
		$this->renderLayout();
	}

	// Redirige a una vista en función del controlador y acción pasados.
	public function redirect($controller, $action, $queryString=NULL) {
		header("Location: index.php?controller=$controller&action=$action".(isset($queryString)?"&$queryString":""));
		die();
	}

	// Recarga la vista.
	public function redirectToReferer($queryString=NULL) {
		header("Location: ".$_SERVER["HTTP_REFERER"].(isset($queryString)?"&$queryString":""));
		die();
	}

	// Renderiza la plantilla cuyo nombre este guardado en $layout.
	private function renderLayout() {
		$this->moveToFragment("layout");

		include(__DIR__."/../view/layouts/".$this->layout.".php");

		ob_flush();
	}

	// Singleton
	private static $viewmanager_singleton = NULL;
	
	// Instanciación del singleton
	public static function getInstance() {
		if (self::$viewmanager_singleton == null) {
			self::$viewmanager_singleton = new ViewManager();
		}
		return self::$viewmanager_singleton;
	}

}

// Fuerza la instanciación del primer ViewManager.
ViewManager::getInstance();