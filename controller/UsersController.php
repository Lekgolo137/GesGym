<?php
//file: controller/UsersController.php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");
require_once(__DIR__."/../controller/BaseController.php");

class UsersController extends BaseController {

	// Se instancia al Mapper para poder interaccionar con la base de datos.
	private $userMapper;

	// Se añade la instanciación del Mapper al constructor.
	public function __construct() {
		parent::__construct();
		$this->userMapper = new UserMapper();
	}

	public function info()
	{
		$this->view->setLayout("welcome");
		$this->view->render("users", "info");
	}

	public function login() {
		// Cuando el usuario le da al botón de iniciar sesión...
		if (isset($_POST["username"])){
			// Se comprueba que el login sea válido.
			if ($this->userMapper->isValid($_POST["username"], $_POST["password"])) {
				// Si es válido se inicia" la sesión guardando el nombre de usuario en la variable de sesión currentuser.
				$_SESSION["currentuser"]=$_POST["username"];
				$_SESSION["currentusertype"]=$this->userMapper->findType($_POST["username"]);
				$_SESSION["currentuserid"]=$this->userMapper->findId($_POST["username"]);
				// Se redirige al usuario al menú principal.
				$this->view->redirect("users", "mainMenu");
			}else{
				// En caso de que el login no sea válido se muestra un mensaje de error al usuario.
				$errors = array();
				$errors["general"] = i18n("Incorrect login");
				$this->view->setVariable("errors", $errors);
			}
		}
		// Se elige la plantilla y renderiza la vista.
		$this->view->setLayout("welcome");
		$this->view->render("users", "login");
	}

	// No tiene una vista asociada.
	public function logout() {
		// Se comprueba que el usuario esté logeado.
		if (!isset($this->currentUser)) {
			throw new Exception(i18n("You must log in to access this feature."));
		}
		// Se cierra la sesión actual del usuario.
		session_destroy();
		// Se redirige al usuario a Login.
		$this->view->redirect("users", "login");
	}

	public function mainMenu(){
		// Se comprueba que el usuario esté logeado.
		if (!isset($this->currentUser)) {
			throw new Exception(i18n("You must log in to access this feature."));
		}
		// Se elige la plantilla y renderiza la vista.
		$this->view->setLayout("default");
		$this->view->render("users", "mainMenu");
	}

	public function profile(){
		// Se comprueba que el usuario esté logeado.
		if (!isset($this->currentUser)) {
			throw new Exception(i18n("You must log in to access this feature."));
		}
		// Se elige la plantilla y renderiza la vista.
		$this->view->setLayout("default");
		$this->view->render("users", "profile");
	}

	public function usersMenu(){
		// Se comprueba que el usuario esté logeado como administrador o entrenador.
		$type = $this->view->getVariable("currentusertype");
		if ($type == "deportista") {
			throw new Exception(i18n("You must be an administrator to access this feature."));
		}
		// Se elige la plantilla y renderiza la vista.
		$this->view->setLayout("default");
		$this->view->render("users", "usersMenu");
	}

	public function add() {
		// Se comprueba que el usuario esté logeado como administrador o entrenador.
		$type = $this->view->getVariable("currentusertype");
		if ($type == "deportista") {
			throw new Exception(i18n("You must be an administrator to access this feature."));
		}
		// Se crea una variable usuario donde guardar los datos de un nuevo usuario.
		$user = new User();
		// Cuando el usuario le da al botón de crear nuevo usuario...
		if (isset($_POST["username"])){
			// Se guardan los datos introducidos por el usuario en la variable creada
			$user->setUsername($_POST["username"]);
			$user->setPassword($_POST["password"]);
			if ($type == "administrador") {
				$user->setTipo($_POST["tipo"]);
			}else{
				$user->setTipo("deportista");
			}
			if ($_POST["subtipo"] == "-"){
				$user->setSubtipo(null);
			}else{
				$user->setSubtipo($_POST["subtipo"]);
			}
			try{
				// Se comprueba que los datos introducidos sean válidos.
				$user->isValid();
				// Se comprueba si ya existe otro usuario con ese nombre.
				if (!$this->userMapper->exists($_POST["username"])){
					// Si no existe se guarda el nuevo usuario en la base de datos.
					$this->userMapper->add($user);
					// Se genera un mensaje de confirmación de la operación para el usuario.
					$this->view->setFlash(i18n("User successfully created."));
					// Se redirige al usuario de vuelta al menú.
					$this->view->redirect("users", "usersMenu");
				} else {
					// En caso de que el nombre de usuario ya exista se muestra un mensaje de error al usuario.
					$errors = array();
					$errors["username"] = i18n("That username already exists");
					$this->view->setVariable("errors", $errors);
				}
			}catch(ValidationException $ex) {
				// En caso de que los datos introducidos no sean válidos se captura el error y se muestra al usuario.
				$errors = $ex->getErrors();
				$this->view->setVariable("errors", $errors);
			}
		}
		// Se envía la variable a la vista, de esta forma en caso de que haya ocurrido un error
		// los campos que el usuario ya había rellenado aparecerán rellenos.
		$this->view->setVariable("user", $user);
		// Se elige la plantilla y renderiza la vista.
		$this->view->setLayout("welcome");
		$this->view->render("users", "add");

	}

	public function usersList(){
		// Se comprueba que el usuario esté logeado como administrador o entrenador.
		$type = $this->view->getVariable("currentusertype");
		if ($type == "deportista") {
			throw new Exception(i18n("You must be an administrator to access this feature."));
		}
		// Guarda todos los usuarios de la base de datos en una variable.
		$users = $this->userMapper->findAll();
		$this->view->setVariable("users", $users);
		// Se elige la plantilla y renderiza la vista.
		$this->view->setLayout("default");
		$this->view->render("users", "usersList");
	}

	public function sportsmansList(){
		// Se comprueba que el usuario esté logeado como entrenador.
		$type = $this->view->getVariable("currentusertype");
		if ($type != "entrenador") {
			throw new Exception(i18n("You must be an administrator to access this feature."));
		}
		// Coge de la base de datos el id del usuario actual.
		$username = $this->view->getVariable("currentusername");
		$user = $this->userMapper->findByUsername($username);
		$id = $user->getId();
		// Coge de la base de datos a todos los usuarios cuyo entrenador sea el usuario actual.
		$users = $this->userMapper->findSportsmans($id);
		// Guarda los datos en una variable visible para la vista.
		$this->view->setVariable("users", $users);
		// Se elige la plantilla y renderiza la vista.
		$this->view->setLayout("default");
		$this->view->render("users", "sportsmansList");
	}

	public function view(){
		// Se guarda el nombre de usuario seleccionado en una variable.
		$id = $_REQUEST["id"];
		// Se coge de la BD el usuario seleccionado.
		$user = $this->userMapper->findById($id);
		// Se comprueba que el usuario esté logeado como administrador (si se consulta un entrenador/admin)
		// o entrenador/admin (si se consulta un deportista).
		if ($user->getTipo() == "deportista"){
			$type = $this->view->getVariable("currentusertype");
			if ($type == "deportista") {
				throw new Exception(i18n("You must be an administrator to access this feature."));
			}
		}else{
			$type = $this->view->getVariable("currentusertype");
			if ($type != "administrador") {
				throw new Exception(i18n("You must be an administrator to access this feature."));
			}
		}
		// Se envia los datos del usuario seleccionado a la vista.
		$this->view->setVariable("user", $user);
		// Se cogen de la BD los datos adicionales necesarios en función del tipo de usuario y se envían a la vista.
		if ($user->getTipo() == "deportista"){
			// Se coge de la BD el entrenador del usuario seleccionado.
			$trainer = $this->userMapper->findById($user->getEntrenador());
			// Se coge de la BD las sesiones del usuario seleccionado.
			$sessions = $this->userMapper->findSessions($id);
			// Se coge de la BD las tablas del usuario seleccionado.
			$tables = $this->userMapper->findTables($id);
			// Se coge de la BD las actividades del usuario seleccionado.
			$activities = $this->userMapper->findActivities($id);
			// Se envían los datos adicionales a la vista.
			$this->view->setVariable("trainer", $trainer);
			$this->view->setVariable("sessions", $sessions);
			$this->view->setVariable("tables", $tables);
			$this->view->setVariable("activities", $activities);
		}
		if ($user->getTipo() == "entrenador"){
			// Se coge de la BD los deportistas del entrenador seleccionado.
			$sportsmans = $this->userMapper->findSportsmans($id);
			// Se coge de la BD las actividades del entrenador seleccionado.
			$trainer_activities = $this->userMapper->findTrainerActivities($id);
			// Se envían los datos adicionales a la vista.
			$this->view->setVariable("sportsmans", $sportsmans);
			$this->view->setVariable("trainer_activities", $trainer_activities);
		}
		// Se elige la plantilla y renderiza la vista.
		$this->view->setLayout("welcome");
		$this->view->render("users", "view");
	}

	public function edit(){
		// Se guarda el nombre de usuario seleccionado en una variable.
		$id = $_REQUEST["id"];
		// Se coge de la BD el usuario seleccionado.
		$user = $this->userMapper->findById($id);
		// Se comprueba que el usuario esté logeado.
		if (!isset($this->currentUser)) {
			throw new Exception(i18n("You must log in to access this feature."));
		}
		// Cuando el usuario le da al botón de crear nuevo usuario...
		if (isset($_POST["username"])){
			// Se guardan los datos introducidos por el usuario en la variable creada
			$user->setUsername($_POST["username"]);
			if ($_POST["password"] != ""){
				$user->setPassword($_POST["password"]);
			}
			if (isset($_POST["tipo"])){
				$user->setTipo($_POST["tipo"]);
			}
			if ($_POST["subtipo"] == "-"){
				$user->setSubtipo(null);
			}else{
				$user->setSubtipo($_POST["subtipo"]);
			}
			if ($_POST["entrenador"] == "-"){
				$user->setEntrenador(null);
			}else{
				$user->setEntrenador($_POST["entrenador"]);
			}
			$this->userMapper->deleteTables($id);
			foreach ($_POST["tablas"] as $tabla_id) {
				$this->userMapper->addTable($id, $tabla_id);
			}
			try{
				// Se comprueba que los datos introducidos sean válidos.
				$user->isValid();
				// See guardan los cambios en la base de datos.
				$this->userMapper->update($user);
				// Se genera un mensaje de confirmación de la operación para el usuario.
				$this->view->setFlash(sprintf(i18n("User \"%s\" successfully modified."),$user->getUsername()));
				// En caso de que el usuario haya sido editado por su entrenador se redirige a este a Tus Deportistas.
				if($user->getEntrenador() == $this->view->getVariable("currentuserid")){
					$this->view->redirect("users", "sportsmansList");
				}else{
					// Sino se redirige al usuario de vuelta al perfil si se estaba editando a sí mismo.
					if($user->getUsername() == $this->view->getVariable("currentusername")){
						$this->view->redirect("users", "profile");
					}else{
						// O a la lista de usuarios si estaba editando a otro..
						$this->view->redirect("users", "usersList");
					}
				}
			}catch(ValidationException $ex) {
				// En caso de que los datos introducidos no sean válidos se captura el error y se muestra al usuario.
				$errors = $ex->getErrors();
				$this->view->setVariable("errors", $errors);
			}
		}
		// Se envía la variable a la vista, de esta forma en caso de que haya ocurrido un error
		// los campos que el usuario ya había rellenado aparecerán rellenos.
		$this->view->setVariable("user", $user);
		// Se cogen de la BD los datos adicionales necesarios en función del tipo de usuario y se envían a la vista.
		if ($user->getTipo() == "deportista"){
			// Se coge de la BD el entrenador del usuario seleccionado.
			$entrenador = $this->userMapper->findById($user->getEntrenador());
			// Se coge de la BD todos los entrenadores.
			$trainers = $this->userMapper->findAllTrainers();
			// Se coge de la BD las tablas del usuario seleccionado.
			$tablas = $this->userMapper->findTables($id);
			// Se coge de la BD las tablas del usuario seleccionado.
			$tables = $this->userMapper->findAllTables();
			// Se envían los datos adicionales a la vista.
			$this->view->setVariable("entrenador", $entrenador);
			$this->view->setVariable("trainers", $trainers);
			$this->view->setVariable("tablas", $tablas);
			$this->view->setVariable("tables", $tables);
		}
		// Se elige la plantilla y renderiza la vista.
		$this->view->setLayout("welcome");
		$this->view->render("users", "edit");
	}

	public function editProfile(){
		// Se comprueba que el usuario esté logeado.
		if (!isset($this->currentUser)) {
			throw new Exception(i18n("You must log in to access this feature."));
		}
		// Se guarda el nombre de usuario seleccionado en una variable.
		$username = $this->view->getVariable("currentusername");
		// Se coge de la BD el usuario seleccionado.
		$user = $this->userMapper->findByUsername($username);
		// Cuando el usuario le da al botón de crear nuevo usuario...
		if (isset($_POST["password"])){
			// Se guardan los datos introducidos por el usuario en la variable creada
			$user->setPassword($_POST["password"]);
			try{
				// Se comprueba que los datos introducidos sean válidos.
				$user->isValid();
				// See guardan los cambios en la base de datos.
				$this->userMapper->update($user);
				// Se genera un mensaje de confirmación de la operación para el usuario.
				$this->view->setFlash(i18n("Profile successfully modified."));
				// Se redirige al usuario de vuelta al menú.
				$this->view->redirect("users", "profile");
			}catch(ValidationException $ex) {
				// En caso de que los datos introducidos no sean válidos se captura el error y se muestra al usuario.
				$errors = $ex->getErrors();
				$this->view->setVariable("errors", $errors);
			}
		}
		// Se envía la variable a la vista, de esta forma en caso de que haya ocurrido un error
		// los campos que el usuario ya había rellenado aparecerán rellenos.
		$this->view->setVariable("user", $user);
		// Se elige la plantilla y renderiza la vista.
		$this->view->setLayout("welcome");
		$this->view->render("users", "editProfile");
	}

	// No tiene una vista asociada.
	public function delete(){
		// Se guarda el nombre de usuario seleccionado en una variable.
		$id = $_REQUEST["id"];
		// Se coge de la BD el usuario seleccionado.
		$user = $this->userMapper->findById($id);
		// Se comprueba que el usuario esté logeado como administrador (si se consulta un entrenador/admin)
		// o entrenador/admin (si se consulta un deportista).
		if ($user->getTipo() == "deportista"){
			$type = $this->view->getVariable("currentusertype");
			if ($type == "deportista") {
				throw new Exception(i18n("You must be an administrator or trainer to access this feature."));
			}
		}else{
			$type = $this->view->getVariable("currentusertype");
			if ($type != "administrador") {
				throw new Exception(i18n("You must be an administrator to access this feature."));
			}
		}
		// Se borra al usuario seleccionado.
		$this->userMapper->delete($user);
		// Se muestra un mensaje de confirmación.
		$this->view->setFlash(sprintf(i18n("User \"%s\" successfully deleted."),$user->getUsername()));
		// Se recarga la lista de usuarios mostrada.
		$this->view->redirect("users", "usersList");
	}

	public function schedule(){
		// Se comprueba que el usuario esté logeado.
		if (!isset($this->currentUser)) {
			throw new Exception(i18n("You must log in to access this feature."));
		}
		if (isset($_POST["day"])){
			$day = $_POST["day"];
		}else{
			$day = "lunes";
		}
		$activities = $this->userMapper->findActivitiesDay($day);
		$resources = $this->userMapper->findResources($activities);
		// Se envían las variables a la vista.
		$this->view->setVariable("day", $day);
		$this->view->setVariable("activities", $activities);
		$this->view->setVariable("resources", $resources);
		// Se elige la plantilla y renderiza la vista.
		$this->view->setLayout("default");
		$this->view->render("users", "schedule");
	}

}
