<?php
require_once(__DIR__."/../model/Session.php");
require_once(__DIR__."/../model/SessionMapper.php");
require_once(__DIR__."/../model/Table.php");
require_once(__DIR__."/../model/TableMapper.php");
require_once(__DIR__."/../model/User.php");

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

class SessionsController extends BaseController {

	private $sessionMapper;

	public function __construct() {
		parent::__construct();

		$this->sessionMapper = new SessionMapper();
	}

	// Gestionar tablas
	public function sessionsMenu(){
		// Se comprueba que el usuario sea un entrenador.
		$type = $this->view->getVariable("currentusertype");
		if ($type == "administrador") {
			throw new Exception(i18n("You can't access this feature."));
		}
		// Se elige la plantilla y renderiza la vista.
		$this->view->setLayout("default");
		$this->view->render("sessions", "sessionsMenu");
	}

	public function sessionslist() {
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. This action requires login");
		}

		// obtain the data from the database
		$sessions = $this->sessionMapper->findAll($this->currentUser);

		// put the array containing Session object to the view
		$this->view->setVariable("sessions", $sessions);
		
		// Se cogen las tablas de la bd y se pasan a la vista.
		$tables = $this->sessionMapper->findTables();
		$this->view->setVariable("tables", $tables);
		
		// render the view (/view/session/index.php)
		$this->view->setLayout("default");
		$this->view->render("sessions", "sessionsList");
	}

	public function add() {
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. This action requires login");
		}
		$sessions = new Session();
		if (isset($_POST["submit"])) { // reaching via HTTP Table...
			// populate the Session object with data form the form
			$sessions->setUserId($this->currentUser->getId());
			$sessions->setTableId($_POST["tableid"]);
			$sessions->setFechaInicio(date('Y-m-d H:i:s'));
			try {
				// save the Session object into the database
				$this->sessionMapper->save($sessions);
				// POST-REDIRECT-GET
				// Everything OK, we will redirect the user to the list of tables
				// We want to see a message after redirection, so we establish
				// a "flash" message (which is simply a Session variable) to be
				// get in the view after redirection.
				$this->view->setFlash(sprintf(i18n("Session successfully iniciated.")));
				$this->view->redirect("sessions", "sessionsList");
			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}
		// Put the Session object visible to the view
		$this->view->setVariable("sessions", $sessions);

		$this->tableMapper = new TableMapper();
		$tables = $this->tableMapper->findProp2($this->view->getVariable("currentuserid"));
		$this->view->setVariable("tables", $tables);
		// render the view (/view/session/add.php)
		$this->view->setLayout("welcome");
		$this->view->render("sessions", "add");
	}

	public function close() {
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. This action requires login");
		}
		$sessions = new Session();

		if (isset($_POST["submit"])) { // reaching via HTTP Table...
			// populate the Session object with data form the form
			$sessions->setSessionId($_POST["id"]);
			$sessions->setComents($_POST["comentarios"]);
			$sessions->setFechaFin(date('Y-m-d H:i:s'));
			try {
				// save the Session object into the database
				$this->sessionMapper->close($sessions);
				// POST-REDIRECT-GET
				// Everything OK, we will redirect the user to the list of tables
				// We want to see a message after redirection, so we establish
				// a "flash" message (which is simply a Session variable) to be
				// get in the view after redirection.
				$this->view->setFlash(sprintf(i18n("Session successfully closed.")));
				$this->view->redirect("sessions", "sessionsList");
			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}
		// Put the Session object visible to the view
		$sessions->setSessionId($_REQUEST["id"]);
		$this->view->setVariable("sessions", $sessions);
		// render the view (/view/session/add.php)
		$this->view->setLayout("welcome");
		$this->view->render("sessions", "edit");
	}

}