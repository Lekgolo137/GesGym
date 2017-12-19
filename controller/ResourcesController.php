<?php
//file: controller/ResourcesController.php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../model/Resource.php");
require_once(__DIR__."/../model/ResourceMapper.php");
require_once(__DIR__."/../controller/BaseController.php");

class ResourcesController extends BaseController {

	// Se instancia al Mapper para poder interaccionar con la base de datos.
	private $resourceMapper;
	
	// Se añade la instanciación del Mapper al constructor.
	public function __construct() {
		parent::__construct();
		$this->resourceMapper = new ResourceMapper();
	}
	
	// Gestionar recursos
	public function resourcesMenu(){
		// Se comprueba que el usuario sea un administrador.
		$type = $this->view->getVariable("currentusertype");
		if ($type != "administrador") {
			throw new Exception(i18n("You must be an administrator to access this feature."));
		}
		// Se elige la plantilla y renderiza la vista.
		$this->view->setLayout("default");
		$this->view->render("resources", "resourcesMenu");
	}
	
	public function add() {
		// Se comprueba que el usuario sea un administrador.
		$type = $this->view->getVariable("currentusertype");
		if ($type != "administrador") {
			throw new Exception(i18n("You must be an administrator to access this feature."));
		}
		// Se crea una variable recurso donde guardar los datos de un nuevo recurso.
		$resource = new Resource();
		// Cuando el usuario le da al botón de crear nuevo recurso...
		if (isset($_POST["nombre"])){
			// Se guardan los datos introducidos por el usuario en la variable creada
			$resource->setNombre($_POST["nombre"]);
			$resource->setAforo($_POST["aforo"]);
			$resource->setDescripcion($_POST["descripcion"]);
			// Se comprueba que el nombre no esté vacío.
			if ($resource->getNombre() != ""){
				// En caso de que el campo aforo no se haya rellenado se pone a 0.
				if ($resource->getAforo() == null) $resource->setAforo(0);
				// Se guarda el nuevo recurso en la base de datos.
				$this->resourceMapper->add($resource);
				// Se genera un mensaje de confirmación de la operación para el usuario.
				$this->view->setFlash(i18n("Resource successfully created."));
				// Se redirige al usuario de vuelta al menú.
				$this->view->redirect("resources", "resourcesMenu");
			}else{
				// En caso de que el nombre esté vacío se muestra un mensaje de error al usuario.
				$errors = array();
				$errors["nombre"] = i18n("The name can't be empty.");
				$this->view->setVariable("errors", $errors);
			}
		}
		// Se envía la variable a la vista, de esta forma en caso de que haya ocurrido un
		// error los campos que el usuario ya había rellenado aparecerán rellenos.
		$this->view->setVariable("resource", $resource);
		// Se elige la plantilla y renderiza la vista.
		$this->view->setLayout("welcome");
		$this->view->render("resources", "add");
	}
	
	public function resourcesList(){
		// Se comprueba que el usuario sea un administrador.
		$type = $this->view->getVariable("currentusertype");
		if ($type != "administrador") {
			throw new Exception(i18n("You must be an administrator to access this feature."));
		}
		// Guarda todos los recursos de la base de datos en una variable.
		$resources = $this->resourceMapper->findAll();
		$this->view->setVariable("resources", $resources);
		// Se elige la plantilla y renderiza la vista.
		$this->view->setLayout("default");
		$this->view->render("resources", "resourcesList");
	}
		
	public function view(){
		// Se comprueba que el usuario sea un administrador.
		$type = $this->view->getVariable("currentusertype");
		if ($type != "administrador") {
			throw new Exception(i18n("You must be an administrator to access this feature."));
		}
		// Se guarda el id del recurso seleccionado en una variable.
		$id = $_REQUEST["id"];
		// Se coge de la BD el usuario seleccionado.
		$resource = $this->resourceMapper->findById($id);
		// Se coge de la BD las actividades que usan ese recurso.
		$activities = $this->resourceMapper->findActivities($id);
		// Se envian las variables a la vista.
		$this->view->setVariable("resource", $resource);
		$this->view->setVariable("activities", $activities);
		// Se elige la plantilla y renderiza la vista.
		$this->view->setLayout("welcome");
		$this->view->render("resources", "view");
	}
	
	public function edit(){
		// Se comprueba que el usuario sea un administrador.
		$type = $this->view->getVariable("currentusertype");
		if ($type != "administrador") {
			throw new Exception(i18n("You must be an administrator to access this feature."));
		}
		// Se guarda el id del recurso seleccionado en una variable.
		$id = $_REQUEST["id"];
		// Se coge de la BD el recurso seleccionado.
		$resource = $this->resourceMapper->findById($id);
		// Cuando el usuario le da al botón de guardar cambios...
		if (isset($_POST["nombre"])){
			// Se guardan los datos introducidos por el usuario en la variable creada
			$resource->setNombre($_POST["nombre"]);
			$resource->setAforo($_POST["aforo"]);
			$resource->setDescripcion($_POST["descripcion"]);
			// Se comprueba que el nombre no esté vacío.
			if ($resource->getNombre() != ""){
				// En caso de que el campo aforo no se haya rellenado se pone a 0.
				if ($resource->getAforo() == null) $resource->setAforo(0);
				// Se guarda el nuevo recurso en la base de datos.
				$this->resourceMapper->update($resource);
				// Se genera un mensaje de confirmación de la operación para el usuario.
				$this->view->setFlash(sprintf(i18n("Resource \"%s\" successfully modified."),$resource->getNombre()));
				// Se redirige al usuario de vuelta al menú.
				$this->view->redirect("resources", "resourcesList");
			}else{
				// En caso de que el nombre esté vacío se muestra un mensaje de error al usuario.
				$errors = array();
				$errors["nombre"] = i18n("The name can't be empty.");
				$this->view->setVariable("errors", $errors);
			}
		}
		// Se envía la variable a la vista, de esta forma en caso de que haya ocurrido un error
		// los campos que el usuario ya había rellenado aparecerán rellenos.
		$this->view->setVariable("resource", $resource);
		// Se elige la plantilla y renderiza la vista.
		$this->view->setLayout("welcome");
		$this->view->render("resources", "edit");
	}
	
	public function delete(){
		// Se comprueba que el usuario sea un administrador.
		$type = $this->view->getVariable("currentusertype");
		if ($type != "administrador") {
			throw new Exception(i18n("You must be an administrator to access this feature."));
		}
		// Se guarda el id del recurso seleccionado
		$id = $_REQUEST["id"];
		// Se coge de la BD el usuario seleccionado.
		$resource = $this->resourceMapper->findById($id);
		// Se borra al usuario seleccionado.
		$this->resourceMapper->delete($resource);
		// Se muestra un mensaje de confirmación.
		$this->view->setFlash(sprintf(i18n("Resource \"%s\" successfully deleted."),$resource->getNombre()));
		// Se recarga la lista de usuarios mostrada.
		$this->view->redirect("resources", "resourcesList");
	}

}