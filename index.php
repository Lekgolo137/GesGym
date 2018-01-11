<?php
// file: index.php prueba estupida

// Controlador por defecto si ninguno es pasado por la URL
define("DEFAULT_CONTROLLER", "users");
define("DEFAULT_CONTROLLER_LOGGED", "users");

// Acción por defecto si ninguna es pasada por la URL
define("DEFAULT_ACTION", "login");
define("DEFAULT_ACTION_LOGGED", "mainMenu");

// Carga el controlador y acción que son pasados por la URL.
function run() {
	try {
		// Inicia una sesión.
		session_start();
		// Comprueba que se haya pasado un controlador, sino pone el por defecto.
		if (!isset($_GET["controller"])) {
			if (isset($_SESSION["currentuser"])) {
				$_GET["controller"] = DEFAULT_CONTROLLER_LOGGED;
			}else{
				$_GET["controller"] = DEFAULT_CONTROLLER;
			}
		}
		// Comprueba que se haya pasado una acción, sino pone la por defecto.
		if (!isset($_GET["action"])) {
			if (isset($_SESSION["currentuser"])) {
				$_GET["action"] = DEFAULT_ACTION_LOGGED;
			}else{
				$_GET["action"] = DEFAULT_ACTION;
			}
		}
		// Instancia el controlador.
		$controller = loadController($_GET["controller"]);
		// Llama a la función correspondiente.
		$actionName = $_GET["action"];
		$controller->$actionName();
	} catch(Exception $ex) {
		// En caso de que haya alguna excepción/error, este es el punto final de captura.
		die(i18n("An error has ocurred.<br>").$ex->getMessage());
	}
}

// Carga un controlador a partir de su nombre pasado como parámetro.
function loadController($controllerName) {
	$controllerClassName = getControllerClassName($controllerName);

	require_once(__DIR__."/controller/".$controllerClassName.".php");
	return new $controllerClassName();
}

// Obtiene el nombre de la clase del controlador mediante concatenación.
function getControllerClassName($controllerName) {
	return strToUpper(substr($controllerName, 0, 1)).substr($controllerName, 1)."Controller";
}

// Se ejecuta el método run.
run();

?>
