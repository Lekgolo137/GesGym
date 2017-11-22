<?php
require_once(__DIR__."/../model/Comment.php");
require_once(__DIR__."/../model/Table.php");
require_once(__DIR__."/../model/TableMapper.php");
require_once(__DIR__."/../model/User.php");

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

class TablesController extends BaseController {
  //Reference to the tableMapper to interact
  private $tableMapper;

  public function __construct() {
    parent::__construct();

    $this->tableMapper = new TableMapper();
  }

  
  	// Gestionar recursos
	public function tablesMenu(){
		// Se comprueba que el usuario sea un administrador.
		$type = $this->view->getVariable("currentusertype");
		if ($type == "cliente") {
			throw new Exception(i18n("You must can't access this feature."));
		}
		// Se elige la plantilla y renderiza la vista.
		$this->view->setLayout("default");
		$this->view->render("tables", "tablesMenu");
	}
  
  /***********************************************************************************/
  /***********************************************************************************/
  //Action to list tables
  public function tablesList() {
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. This action requires login");
    }
    if ($this->view->getVariable("currentusertype") != "administrador") {
      throw new Exception("This action requires login privileges");
    }


    // obtain the data from the database
    $tables = $this->tableMapper->findAll();

    // put the array containing Table object to the view
    $this->view->setVariable("tables", $tables);

    // render the view (/view/tables/index.php)
	$this->view->setLayout("default");
    $this->view->render("tables", "tablesList");
  }

  /*************************************************************************************/
  /***********************************************************************************/
  //Action to add a new Table
  public function add() {
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. This action requires login");
    }

    $tables = new Table();

    if (isset($_POST["submit"])) { // reaching via HTTP Table...

      // populate the Table object with data form the form
      $tables->setTableid($_POST["tableid"]);
      $tables->setTabletipo($_POST["tabletipo"]);

      try {
        // validate Table object
        $tables->checkIsValidForRegister(); // if it fails, ValidationException

        // save the Table object into the database
        $this->tableMapper->save($tables);

        // POST-REDIRECT-GET
        // Everything OK, we will redirect the user to the list of tables
        // We want to see a message after redirection, so we establish
        // a "flash" message (which is simply a Session variable) to be
        // get in the view after redirection.
        $this->view->setFlash(sprintf(i18n("Table \"%s\" successfully added."),$tables ->getTableid()));

        $this->view->redirect("tables", "tablesMenu");

      }catch(ValidationException $ex) {
        // Get the errors array inside the exepction...
        $errors = $ex->getErrors();
        // And put it to the view as "errors" variable
        $this->view->setVariable("errors", $errors);
      }
    }

    // Put the Table object visible to the view
    $this->view->setVariable("tables", $tables);

    // render the view (/view/tables/add.php)
	$this->view->setLayout("welcome");
    $this->view->render("tables", "add");

  }

  /*********************************************************************************/
  /***********************************************************************************/
  //Action to edit a table
  public function edit() {
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. This action requires login");
    }

    if (!isset($_REQUEST["id"])) {
      throw new Exception("A table id is mandatory");
    }


    // Get the Table object from the database
    $tablesid = $_REQUEST["id"];
    $tables = $this->tableMapper->findById($tablesid);

    // Does the table exist?
    if ($tables == NULL) {
      throw new Exception("no such table with id: ".$tablesid);
    }

    if (isset($_POST["submit"])) { // reaching via HTTP Table...

      // populate the Table object with data form the form
      $tables->setTableid($_POST["tableid"]);
      $tables->setTabletipo($_POST["tabletipo"]);

      try {
        // validate Table object
        $tables->checkIsValidForRegister(); // if it fails, ValidationException

        // update the Table object in the database
        $this->tableMapper->update($tables, $tablesid);

        // POST-REDIRECT-GET
        // Everything OK, we will redirect the user to the list of tables
        // We want to see a message after redirection, so we establish
        // a "flash" message (which is simply a Session variable) to be
        // get in the view after redirection.
        $this->view->setFlash(sprintf(i18n("Table \"%s\" successfully updated."),$tables ->getTableid()));

        // perform the redirection. More or less:
        // header("Location: index.php?controller=tables&action=index")
        // die();
        $this->view->redirect("tables", "index");

      }catch(ValidationException $ex) {
        // Get the errors array inside the exepction...
        $errors = $ex->getErrors();
        // And put it to the view as "errors" variable
        $this->view->setVariable("errors", $errors);
      }
    }

    // Put the Table object visible to the view
    $this->view->setVariable("tables", $tables);

    // render the view (/view/tables/add.php)
    $this->view->render("tables", "edit");
  }

  /*********************************************************************************/
  /***********************************************************************************/
  //Action to delete a table
  public function delete() {
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. This action requires login");
    }

    if (!isset($_POST["id"])) {
      throw new Exception("id is mandatory");
    }

    // Get the Table object from the database
    $tablesid = $_REQUEST["id"];
    $tables = $this->tableMapper->findById($tablesid);

    // Does the table exist?
    if ($tables == NULL) {
      throw new Exception("no such table with id: ".$tablesid);
    }


    // Delete the Table object from the database
    $this->tableMapper->delete($tables);

    // POST-REDIRECT-GET
    // Everything OK, we will redirect the user to the list of tables
    // We want to see a message after redirection, so we establish
    // a "flash" message (which is simply a Session variable) to be
    // get in the view after redirection.
    $this->view->setFlash(sprintf(i18n("Table \"%s\" successfully deleted."),$tables ->getTableid()));

    // perform the redirection. More or less:
    // header("Location: index.php?controller=tables&action=index")
    // die();
    $this->view->redirect("tables", "index");
  }

}