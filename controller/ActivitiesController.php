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

	// Devuelve una lista de las actividades V
	public function activitiesList(){

		//Guarda las actividades en una variable
		$activities = $this->activityMapper->findAll();
		$this->view->setVariable("activities", $activities);

		//Se elige la plantilla y renderiza la vista
		$this->view->setLayout("default");
		$this->view->render("activities", "activitiesList");
	}

  // Devuelve la lista de usuarios inscritos o preinscritos en una actividad concreta V
  public function activitiesWUserList(){

    // Se guarda la id de la actividad seleccionada en una variable.
    $id = $_REQUEST["id"];

    //Guarda las actividades con usuario en una variables
    $users = $this->activityMapper->listActiUser($id);
    $this->view->setVariable("users", $users);

    //Se elige la plantilla y renderiza la Vista
    $this->view->setLayout("default");
    $this->view->render("activities", "activitiesWUserList");
  }

  // Deportista se preinscribe en la actividades
  public function preDepor(){

      //Se guarda la id del deportista en una variables
      $user = $_REQUEST["userid"];
      //Se guarda la id de la actividad en una variables
      $id = $_REQUEST["id"];

      if(!$this->activityMapper->userExistAct($id,$user)){

        //Guardamos el usuario en la actividad
        $this->activityMapper->addUser($user,$id);

      } else {

        //En caso de que el usuario ya estuviera dentro de la actividad
        $errors = array();
        $errors["usuario"] = i18n("User is already in the activity.");
        $this->view->setVariable("errors", $errors);

    }

      //Redirigimos al usuario a la vista de las actividadIDExists
      $this->view->redirect("activities","activitiesList");
  }

  // Confirma a un usuario en un actividad
  public function confUsuario(){

    //Se guarda la id del usuario en una variables
    $usuario = $_REQUEST["user"];
    //Se guarda la id de la actividad en una variables
    $id = $_REQUEST["id"];
    if(!$this->activityMapper->userIsConf($id,$usuario)){

      //llamamos a la funcion del modelo
      $this->activityMapper->confUser($id,$usuario);

      //Se genera un mensaje de confirmacion del usuario
      $this->view->setFlash(i18n("User confirmed."));

    } else {
      $this->view->setFlash(i18n("User already confirmed."));
    }
    $users = $this->activityMapper->listActiUser($id);
    $this->view->setVariable("users", $users);
    //Se redirige al usuario a la vista de la lista de usuarios de la actividad.
    $this->view->redirect("activities","activitiesWUserList");
  }

	// Guarda una actividad nueva en la base de datos.
	public function add() {

    //Enviamos un array con los entrenadores a la vista
    $entrenadores = $this->activityMapper->findTrainers();
    $this->view->setVariable("entrenadores", $entrenadores);
    $recursos = $this->activityMapper->recurs();
    $this->view->setVariable("recursos", $recursos);
		//Se crea una variable actividad donde guardar los datos de una nueva actividad
		$activity = new Activity();

		//Cuando el usuario le da al boton de crear una actividad...
		if (isset($_POST["nombre"])) {

			//Se guardan los datos introducidos por el usuario en la variable creada
			$activity->setNombre($_POST["nombre"]);
      $activity->setDescripcion($_POST["descripcion"]);
      $dias='';
      foreach ($_POST["days"] as $day) $dias = $dias.$day.',';
      rtrim($dias,',');
      str_replace(' ','',$dias);
      $activity->setDia($dias);
      $activity->setHoraInicio($_POST["hora_inicio"]);
      $activity->setHoraFin($_POST["hora_fin"]);
      $activity->setPlazas($_POST["plazas"]);
      $activity->setEntrenador($_POST["entrenador"]);

  				$id = $this->activityMapper->save($activity);

          foreach ($_POST["recursos"] as $recurso){
            $this->activityMapper->addRecActi($recurso, $id);
          }
  				//Se genera un mensaje de confirmacion de la actividad.
  				$this->view->setFlash(i18n("Activity successfully created."));

  				//Se redirige al usuario de vuelta a la lista de actividades
  				$this->view->redirect("activities", "activitiesMenu");

		}

		// Se manda la variable a la vista de nuevo.
		$this->view->setVariable("activity", $activity);

		// Se elige la plantilla y se renderiza la vista.
		$this->view->setLayout("welcome");
		$this->view->render("activities", "add");

	}

	// Muestra la actividad V
	public function view(){
		// Se guarda el id de la actividad seleccionada en una variable.
		$id = $_REQUEST["id"];
		//Se coge de la BD la actividad seleccionada
		$activity = $this->activityMapper->findById($id);
    $recursos = $this->activityMapper->actiRecursos($id);
		// Se coge de la BD los usuarios que están inscritos en esa actividad.
		$users = $this->activityMapper->findUsers($id);

    foreach($users as $user){
        $deportistas = $this->activityMapper->nameUser($user->getUsuario());
    }

    $entrenador = $this->activityMapper->nameUser($activity->getEntrenador());
		//Se envian las variables a la vista
		$this->view->setVariable("activity", $activity);
		$this->view->setVariable("users", $users);
    $this->view->setVariable("entrenador", $entrenador);
    $this->view->setVariable("deportistas", $deportistas);
    $this->view->setVariable("recursos", $recursos);
		//Se elige la plantilla y se renderiza la vista
		$this->view->setLayout("welcome");
		$this->view->render("activities", "view");
	}

	// Modifica la actividad
	public function edit(){  // Los deportistas y los entrenadores ya no tienen acceso a esta funcionalidad

		// Se guarda la id de la actividad seleccionada en una variable.
		$id = $_REQUEST["id"];
    $entrenadores = $this->activityMapper->findTrainers();
    $this->view->setVariable("entrenadores", $entrenadores);
		// Se guarda la actividad seleccionada en una variable desde la base de datos.
		$activity = $this->activityMapper->findById($id);
    $recursos = $this->activityMapper->recurActi($id);

    $this->view->setVariable("recursos", $recursos);
		// Cuando el usuario le da al boton de modificar la actividad...
		if (!empty($_POST["nombre"])){

			//Se guardan los datos introducidos por el usuario
      $activity->setNombre($_POST["nombre"]);
      $activity->setDescripcion($_POST["descripcion"]);
      $activity->setDia($_POST["dia"]);
      $activity->setHoraInicio($_POST["hora_inicio"]);
      $activity->setHoraFin($_POST["hora_fin"]);
      $activity->setPlazas($_POST["plazas"]);
			$activity->setEntrenador($_POST["entrenador"]);
			//Se guardan los cambios en la base de datos
			$this->activityMapper->update($activity);
			//Se genera un mensaje de confirmación de la operación para el usuario.
			$this->view->setFlash(sprintf(i18n("Activity \"%s\" successfully modified."),$activity->getNombre()));
			//Se redirige al usuario a la lista de actividades
			$this->view->redirect("activities","activitiesList");

		}

		// Se envia la variable a la vista
		$this->view->setVariable("activity", $activity);

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
		$activityid = $_REQUEST["id"];
		//Se coge de la base de datos la actividad
		$activity = $this->activityMapper->findById($activityid);
		//Se borra la actividad
		$this->activityMapper->delete($activity);
		//Se muestra un mensaje de confirmacion
		$this->view->setFlash(sprintf(i18n("Activity \"%s\" successfully deleted."),$activity->getId()));
		//Se redirecciona al usuario a la lista de actividades
		$this->view->redirect("activities", "activitiesList");
	}

	//Vista por defecto de actividades
	public function activitiesMenu() {

		//Se elige la plantilla y se renderiza la vista
		$this->view->setLayout("default");
		$this->view->render("activities", "activitiesMenu");
	}

  //Vista de las actividades del usuarios
  public function myActivities() {

    $id = $this->view->getVariable("currentuserid");
    $type = $this->view->getVariable("currentusertype");

    if($type == "entrenador"){
    $activities = $this->activityMapper->actiTrainer($id);
  } else{
    $activities = $this->activityMapper->actiDepor($id);
  }
    $this->view->setVariable("activities", $activities);

    $this->view->setLayout("default");
    $this->view->render("activities", "activitiesOwn");

  }

  //Lista de recursos asignados a la actividades
  public function listResources() {

    $id = $_REQUEST["id"];

    $recursos = $this->activityMapper->actiRecursos($id);

    $this->view->setVariable("recursos", $recursos);
    $this->view->setVariable("actividad", $id);

    $this->view->setLayout("default");
    $this->view->render("activities", "resourcesList");
  }

  //Borra recurso de actividades
  public function deleteResource() {

    $id = $_REQUEST["id"];

    $recurso = $_REQUEST["recurso"];

    $this->activityMapper->actiRecurDel($id,$recurso);

    $recursos = $this->activityMapper->actiRecursos($id);

    $this->view->setVariable("recursos", $recursos);
    $this->view->setVariable("actividad", $id);

    $this->view->setLayout("default");
    $this->view->render("activities", "resourcesList");
  }

  //Lista recursos que no estan en una actividad
  public function addResource() {

    $id = $_REQUEST["id"];


    $resources = $this->activityMapper->recurActi($id);

    $this->view->setVariable("resources", $resources);
    $this->view->setVariable("actividad", $id);

    $this->view->setLayout("default");
    $this->view->render("activities", "addResource");
  }

  //Añade recursos a una actividades
  public function recurIntegre() {

    $id = $_REQUEST["id"];
    $resource = $_REQUEST["resource"];

    $this->activityMapper->addRecActi($id, $resource);

    $resources = $this->activityMapper->recurActi($id);

    $this->view->setVariable("resources", $resources);
    $this->view->setVariable("actividad", $id);

    $this->view->setLayout("default");
    $this->view->render("activities", "addResource");
  }
 }
