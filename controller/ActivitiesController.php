<?php
//file: controller/ActivitiesController.php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Activity.php");
require_once(__DIR__."/../model/ActivityMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

/**
 * Clase ActivitiesController
 *
 * @author SirGarner <borjaswimmer@gmail.com>
 */
 class ActivitiesController extends BaseController{
	 

	// Se instancia al Mapper para poder interaccionar con la base de datos
	private $activityMapper;
	
	// Constructor
	public function __construct() {
		parent::__construct();
		
		$this->activityMapper = new ActivityMapper();
	}
	
	// Devuelve una lista de las actividades
	public function activitiesList(){
		
		//Guarda las actividades en una variable
		$activities = $this->activityMapper->findAll();
		$this->view->setVariable("activities", $activities);
		
		//Se elige la plantilla y renderiza la vista
		$this->view->setLayout("default");
		$this->view->render("activities", "activitiesList");
	}
	
	// Guarda una actividad nueva en la base de datos.
	public function add() {
		
		//Se crea una variable actividad donde guardar los datos de una nueva actividad
		$activity = new Activity();
		//Cuando el usuario le da al boton de crear una actividad...
		if (isset($_POST["activityid"])) {
		
			//Se guardan los datos introducidos por el usuario en la variable creada
			$activity->setActivityID($_POST["activityid"]);
			$activity->setPlazas($_POST["plazas"]);
			
			//Se comprueba si ya existe la actividad en la base de datos
			if (!$this->activityMapper->actividadIDExists($_POST["activityid"])) {
				
				//Si no existe se guarda la nueva actividad en la base de datos.
				$this->activityMapper->save($activity);
				
				//Se genera un mensaje de confirmacion de la actividad.
				$this->view->setFlash(i18n("Activity successfully created."));
				
				//Se redirige al usuario de vuelta a la lista de actividades
				$this->view->redirect("activities", "activitiesMenu");
			} else {
				//En caso de que la actividad ya existiera se muestra un mensaje de error.
				$errors = array();
				$errors["activityid"] = i18n("That activity ID already exists");
				$this->view->setVariable("errors", $errors);
			}
			
		}
		
		// Se manda la variable a la vista de nuevo.
		$this->view->setVariable("activity", $activity);

		// Se elige la plantilla y se renderiza la vista.
		$this->view->setLayout("welcome");
		$this->view->render("activities", "add");
		
	}
	
	// Muestra la actividad
	public function view(){
		$activityid = $_REQUEST["activityid"];
		//Se coge de la base de datos la actividad seleccionada
		$activity = $this->activityMapper->findByActivityid($activityid);
		$users = $this->activityMapper->findUsers($activityid);
		//Se envia la variable a la vista
		$this->view->setVariable("activity", $activity);
		$this->view->setVariable("users", $users);
		//Se elige la plantilla y se renderiza la vista
		$this->view->setLayout("welcome");
		$this->view->render("activities", "view");
	}
	
	// Modifica la actividad
	public function edit(){
		// Se comprueba que el usuario no sea un cliente.
		$type = $this->view->getVariable("currentusertype");
		if ($type == "cliente") {
			throw new Exception(i18n("You must be an administrator to access this feature."));
		}
		// Se guarda la id de la actividad seleccionada en una variable.
		$activityid = $_REQUEST["activityid"];
		// Se guarda la actividad seleccionada en una variable desde la base de datos.
		$activity = $this->activityMapper->findByActivityid($activityid);
		// Se cogen los usuarios asignados a la actividad.
		$users = $this->activityMapper->findUsers($activityid);
		// Cuando el usuario le da al boton de modificar la actividad...
		if (isset($_POST["plazas"])){
			//Se guardan los datos introducidos por el usuario
			$activity->setPlazas($_POST["plazas"]);
			//Se guardan los cambios en la base de datos
			$this->activityMapper->update($activity);
			//Se genera un mensaje de confirmación de la operación para el usuario.
			$this->view->setFlash(sprintf(i18n("Activity \"%s\" successfully modified."),$activity->getActivityID()));
			//Se redirige al usuario a la lista de actividades
			$this->view->redirect("activities","activitiesList");
		}
		// Cuando el usuario le da al boton de añadir usuario...
		if (isset($_POST["user"])){
			// Se guarda el nombre de usuario en una variable.
			$username = $_POST["user"];
			// Se envía la variable a la vista.
			$this->view->setVariable("user", $username);
			// Se comprueba que el usuario exista.
			if($this->activityMapper->userExists($username)){
				// Se comprueba que ese usario no esté ya en esa actividad.
				if (!$this->activityMapper->userExistAct($activityid, $username)){
					// Si no lo está, se guarda la fecha en una variable.
					$date = $_POST["date"];
					// Se envía la variable a la vista.
					$this->view->setVariable("date", $date);
					// Se añade la relación entre el usuario y la actividad en la base de datos.
					$this->activityMapper->addUser($username, $activityid, $date);
					//Se genera un mensaje de confirmación de la operación para el usuario.
					$this->view->setFlash(i18n("User successfully added to the activity."));
					//Se redirige al usuario a la lista de actividades
					$this->view->redirectToReferer();
				} else {
					// Si lo está, se muestra un mensaje de error.
					$errors = array();
					$errors["username"] = i18n("That user is already asigned to the activity");
					$this->view->setVariable("errors", $errors);
				}
			}else{
				// Si no existe, se muestra un mensaje de error.
				$errors = array();
				$errors["username"] = i18n("That user doesn't exist.");
				$this->view->setVariable("errors", $errors);
			}
		}
		// Se envia la variable a la vista
		$this->view->setVariable("activity", $activity);
		$this->view->setVariable("users", $users);
		// Se elige la plantilla y se renderiza la vista
		$this->view->setLayout("welcome");
		$this->view->render("activities","edit");
	}
	
	// Borra una actividad
	public function delete(){
		$type = $this->view->getVariable("currentusertype");
		if ($type != "administrador") {
			throw new Exception(i18n("You must be an administrator to access this feature."));
		}
		//Se guarda la actividad seleccionada
		$activityid = $_REQUEST["activityid"];
		//Se coge de la base de datos la actividad
		$activity = $this->activityMapper->findByActivityid($activityid);
		//Se borra la actividad
		$this->activityMapper->delete($activity);
		//Se muestra un mensaje de confirmacion
		$this->view->setFlash(sprintf(i18n("Activity \"%s\" successfully deleted."),$activity->getActivityID()));
		//Se redirecciona al usuario a la lista de actividades
		$this->view->redirect("activities", "activitiesList");
	}
	
	//Vista por defecto de actividades
	public function activitiesMenu() {
		
		//Se elige la plantilla y se renderiza la vista
		$this->view->setLayout("default");
		$this->view->render("activities", "activitiesMenu");
	}
 }