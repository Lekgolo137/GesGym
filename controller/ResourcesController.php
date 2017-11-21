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
		if (isset($_POST["id"])){
			// Se guardan los datos introducidos por el usuario en la variable creada
			$resource->setId($_POST["id"]);
			$resource->setTipo($_POST["tipo"]);
			$resource->setLocation($_POST["location"]);
			$resource->setCanafo($_POST["canafo"]);
			// Se comprueba si ya existe otro recurso con ese ID.
			if (!$this->resourceMapper->idExists($_POST["id"])){
				// Si no existe se guarda el nuevo recurso en la base de datos.
				$this->resourceMapper->save($resource);
				// Se genera un mensaje de confirmación de la operación para el usuario.
				$this->view->setFlash(i18n("Resource successfully created."));
				// Se redirige al usuario de vuelta al menú.
				$this->view->redirect("resources", "resourcesMenu");
			} else {
				// En caso de que el ID ya exista se muestra un mensaje de error al usuario.
				$errors = array();
				$errors["id"] = i18n("That ID already exists");
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
		// Se envia la variable a la vista.
		$this->view->setVariable("resource", $resource);
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
		// Cuando el usuario le da al botón de crear nuevo recurso...
		if (isset($_POST["canafo"])){
			// Se guardan los datos introducidos por el usuario en la variable creada
			$resource->setTipo($_POST["tipo"]);
			$resource->setLocation($_POST["location"]);
			$resource->setCanafo($_POST["canafo"]);
			// See guardan los cambios en la base de datos.
			$this->resourceMapper->update($resource);
			// Se genera un mensaje de confirmación de la operación para el usuario.
			$this->view->setFlash(sprintf(i18n("Resource \"%s\" successfully modified."),$resource->getId()));
			// Se redirige al usuario de vuelta al menú.
			$this->view->redirect("resources", "resourcesList");
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
		$this->view->setFlash(sprintf(i18n("Resource \"%s\" successfully deleted."),$resource->getId()));
		// Se recarga la lista de usuarios mostrada.
		$this->view->redirect("resources", "resourcesList");
	}
}