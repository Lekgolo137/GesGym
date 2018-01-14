<?php
//file: controller/ExercisesController.php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../model/Exercise.php");
require_once(__DIR__."/../model/ExerciseMapper.php");
require_once(__DIR__."/../controller/BaseController.php");


class ExercisesController extends BaseController {

	// Se instancia al Mapper para poder interaccionar con la base de datos.
	private $exerciseMapper;
	
	// Se añade la instanciación del Mapper al constructor.
	public function __construct() {
		parent::__construct();
		$this->exerciseMapper = new exerciseMapper();
	}

	public function exercisesMenu(){
		$type = $this->view->getVariable("currentusertype");
		if ($type != "entrenador") {
			throw new Exception(i18n("You must be an manager to access this feature."));
		}
		// Se elige la plantilla y renderiza la vista.
		$this->view->setLayout("default");
		$this->view->render("exercises", "exercisesMenu");
	}
	
	public function add() {
		$type = $this->view->getVariable("currentusertype");
		if ($type != "entrenador") {
			throw new Exception(i18n("You must be an manager to access this feature."));
		}

		// Se crea una variable ejercicio donde guardar los datos de un nuevo ejercicio
		$exer = new Exercise();
		// Cuando el usuario le da al botón de crear nuevo ejercicio...
		if (isset($_POST["nombre"])){
			// Se guardan los datos introducidos por el usuario en la variable creada
			$exer->setExerName($_POST["nombre"]);
			$exer->setExerTipo($_POST["tipo"]);
			$exer->setDescripcion($_POST["descripcion"]);
			$exer->setUrl($_POST["url"]);

			$this->exerciseMapper->save($exer);
			// Se genera un mensaje de confirmación de la operación para el usuario.
			$this->view->setFlash(i18n("Exercise successfully created."));
			// Se redirige al usuario de vuelta al menú.
			$this->view->redirect("exercises", "exercisesMenu");
		}
		// Se envía la variable a la vista, de esta forma en caso de que haya ocurrido un error
		// los campos que el usuario ya había rellenado aparecerán rellenos.
		$this->view->setVariable("exer", $exer);
		// Se elige la plantilla y renderiza la vista.
		$this->view->setLayout("welcome");
		$this->view->render("exercises", "add");
	}
	
	public function exercisesList(){
		$type = $this->view->getVariable("currentusertype");
		if ($type != "entrenador") {
			throw new Exception(i18n("You must be an manager to access this feature."));
		}
		// Guarda todos los usuarios de la base de datos en una variable.
		$exercises = $this->exerciseMapper->findAll();
		$this->view->setVariable("exercises", $exercises);
		// Se elige la plantilla y renderiza la vista.
		$this->view->setLayout("default");
		$this->view->render("exercises", "exercisesList");
	}
	
	public function view(){
		$type = $this->view->getVariable("currentusertype");
		if ($type != "entrenador") {
			throw new Exception(i18n("You must be an manager to access this feature."));
		}
		// Se guarda el identificador del ejercicio seleccionado en una variable.
		$exerciseId = $_REQUEST["id"];

		// Se coge de la BD el ejercicio seleccionado.
		$exercise = $this->exerciseMapper->findByExerId($exerciseId);
		// Se envia la variable a la vista.
		$this->view->setVariable("exercise", $exercise);
		
		// Se coge de la BD las tablas del ejercicio seleccionado.
		$tables = $this->exerciseMapper->findTables($exerciseId);
		$this->view->setVariable("tables", $tables);
		
		// Se elige la plantilla y renderiza la vista.
		$this->view->setLayout("welcome");
		$this->view->render("exercises", "view");
	}
	
	public function edit(){
		$type = $this->view->getVariable("currentusertype");
		if ($type != "entrenador") {
			throw new Exception(i18n("You must be an manager to access this feature."));
		}
		// Se guarda el nombre del ejercicio seleccionado en una variable.
		$exerciseId = $_REQUEST["id"];
		// Se coge de la BD el usuario seleccionado.
		$exercise = $this->exerciseMapper->findByExerId($exerciseId);
		if (isset($_POST["nombre"])){
			// Se guardan los datos introducidos por el usuario en la variable creada
			$exercise->setExerName($_POST["nombre"]);
			$exercise->setExerTipo($_POST["tipo"]);
			$exercise->setDescripcion($_POST["descripcion"]);
			$exercise->setUrl($_POST["url"]);
			// Se guardan los cambios en la base de datos.
			$this->exerciseMapper->update($exercise);
			// Se genera un mensaje de confirmación de la operación para el usuario.
			$this->view->setFlash(sprintf(i18n("Exercise \"%s\" successfully modified."),$exercise->getExerciseId()));
			// Se redirige al usuario de vuelta al menú.
			$this->view->redirect("exercises", "exercisesList");
		}
		// Se envía la variable a la vista, de esta forma en caso de que haya ocurrido un error
		// los campos que el usuario ya había rellenado aparecerán rellenos.
		$this->view->setVariable("exercise", $exercise);
		// Se elige la plantilla y renderiza la vista.
		$this->view->setLayout("welcome");
		$this->view->render("exercises", "edit");
	}
	
	public function delete(){
		$type = $this->view->getVariable("currentusertype");
		if ($type != "entrenador") {
			throw new Exception(i18n("You must be an manager to access this feature."));
		}
		// Se guarda el identificador del ejercicio seleccionado
		$exerciseId = $_REQUEST["id"];
		// Se coge de la BD el ejercicio seleccionado.
		$exer = $this->exerciseMapper->findByExerId($exerciseId);
		// Se borra el ejercicio seleccionado.
		$this->exerciseMapper->delete($exer);
		// Se muestra un mensaje de confirmación.
		$this->view->setFlash(sprintf(i18n("Exercise \"%s\" successfully deleted."),$exer->getExerciseId()));
		// Se recarga la lista de usuarios mostrada.
		$this->view->redirect("exercises", "exercisesList");
	}
}
