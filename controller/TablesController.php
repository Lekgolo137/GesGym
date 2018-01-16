<?php
require_once(__DIR__."/../model/Table.php");
require_once(__DIR__."/../model/TableMapper.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Exercise.php");
require_once(__DIR__."/../model/ExerciseMapper.php");


require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

class TablesController extends BaseController {
  //Reference to the tableMapper to interact
  private $tableMapper;

  public function __construct() {
    parent::__construct();

    $this->tableMapper = new TableMapper();
  }


  // Gestionar tablas
  public function tablesMenu(){
    // Se comprueba que el usuario sea un entrenador.
    if ($this->view->getVariable("currentusertype") == "administrador") {
      throw new Exception(i18n("You can't access this feature."));
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
    if ($this->view->getVariable("currentusertype") != "entrenador") {
      throw new Exception("This action requires privileges");
    }

    // obtain the data from the database
    $tables = $this->tableMapper->findAll();

    // put the array containing Table object to the view
    $this->view->setVariable("tables", $tables);

    // obtain the data from the database
    $tablesProp = $this->tableMapper->findProp($this->currentUser);
    // put the array containing Table object to the view
    $this->view->setVariable("tablesProp", $tablesProp);

    // render the view (/view/tables/index.php)
    $this->view->setLayout("default");
    $this->view->render("tables", "tablesList");
  }

  /***********************************************************************************/
  /***********************************************************************************/
  //Action to list tables
  public function tablesListProp() {
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. This action requires login");
    }
    if ($this->view->getVariable("currentusertype") != "deportista") {
      throw new Exception("This action requires privileges");
    }

    // obtain the data from the database
    $tables = $this->tableMapper->findProp($this->currentUser);

    // put the array containing Table object to the view
    $this->view->setVariable("tables", $tables);

    // render the view (/view/tables/index.php)
    $this->view->setLayout("default");
    $this->view->render("tables", "tablesList");
  }

  /***********************************************************************************/
  /***********************************************************************************/
  //Action to list public tables
  public function tablesListPublic() {
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. This action requires login");
    }

    // obtain the data from the database
    $tables = $this->tableMapper->findAllPublic();

    // put the array containing Table object to the view
    $this->view->setVariable("tables", $tables);

    // render the view (/view/tables/index.php)
    $this->view->setLayout("default");
    $this->view->render("tables", "tablesList");
  }

  /*********************************************************************************/
  /***********************************************************************************/
  //Action to view a table
  public function view() {
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

    // Put the Table object visible to the view
    $this->view->setVariable("tables", $tables);

    $this->exerciseMapper = new ExerciseMapper();
    $exercises = $this->exerciseMapper->findCheck($_REQUEST["id"]);
    $this->view->setVariable("exercises", $exercises);

    // render the view (/view/tables/add.php)
    $this->view->setLayout("welcome");
    $this->view->render("tables", "view");
  }

  /*********************************************************************************/
  /***********************************************************************************/
  //Action to view a table
  public function choose() {
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

    // Put the Table object visible to the view
    $this->view->setVariable("tables", $tables);

    $this->exerciseMapper = new ExerciseMapper();
    $exercises = $this->exerciseMapper->findCheck($_REQUEST["id"]);
    $this->view->setVariable("exercises", $exercises);

    // render the view (/view/tables/add.php)
    $this->view->setLayout("welcome");
    $this->view->render("tables", "choose");
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
      $tables->setTableNombre($_POST["tableNombre"]);
      $tables->setTableTipo($_POST["tableTipo"]);
      $tables->setTableDescripcion($_POST["tableDescripcion"]);
      $exers = $_POST['exers'];

      try {
        // validate Table object
        $tables->checkIsValidForRegister(); // if it fails, ValidationException

        // save the Table object into the database
        $this->tableMapper->save($tables, $exers);

        // POST-REDIRECT-GET
        // Everything OK, we will redirect the user to the list of tables
        // We want to see a message after redirection, so we establish
        // a "flash" message (which is simply a Session variable) to be
        // get in the view after redirection.
        $this->view->setFlash(sprintf(i18n("Table \"%s\" successfully added."),$tables ->getTableNombre()));

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

    $this->exerciseMapper = new ExerciseMapper();
    $exercises = $this->exerciseMapper->findAll();
    $this->view->setVariable("exercises", $exercises);

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
      $tables->setTableNombre($_POST["tableNombre"]);
      $tables->setTableTipo($_POST["tableTipo"]);
      $tables->setTableDescripcion($_POST["tableDescripcion"]);
      $exers = $_POST['exers'];

      try {
        // validate Table object
        $tables->checkIsValidForRegister(); // if it fails, ValidationException

        // update the Table object in the database
        $this->tableMapper->update($tables, $tablesid, $exers);

        // POST-REDIRECT-GET
        // Everything OK, we will redirect the user to the list of tables
        // We want to see a message after redirection, so we establish
        // a "flash" message (which is simply a Session variable) to be
        // get in the view after redirection.
        $this->view->setFlash(sprintf(i18n("Table \"%s\" successfully updated."),$tables ->getTableNombre()));

        // perform the redirection. More or less:
        // header("Location: index.php?controller=tables&action=index")
        // die();
        $this->view->redirect("tables", "tablesList");

      }catch(ValidationException $ex) {
        // Get the errors array inside the exepction...
        $errors = $ex->getErrors();
        // And put it to the view as "errors" variable
        $this->view->setVariable("errors", $errors);
      }
    }

    // Put the Table object visible to the view
    $this->view->setVariable("tables", $tables);

    $this->exerciseMapper = new ExerciseMapper();
    $exercises = $this->exerciseMapper->findAll();
    $this->view->setVariable("exercises", $exercises);
    $exercisesCheck = $this->exerciseMapper->findCheck($_REQUEST["id"]);
    $this->view->setVariable("exercisesCheck", $exercisesCheck);

    // render the view (/view/tables/add.php)
    $this->view->setLayout("welcome");
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
    $this->view->setFlash(sprintf(i18n("Table \"%s\" successfully deleted."),$tables ->getTableNombre()));

    // perform the redirection. More or less:
    // header("Location: index.php?controller=tables&action=index")
    // die();
    $this->view->redirect("tables", "tablesList");
  }

  /*********************************************************************************/
  /***********************************************************************************/
  //Action to link a table to a user
  public function linkUser() {
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

    // Link the Table to User
    $this->tableMapper->linkTableUser($this->currentUser, $tables);

    // POST-REDIRECT-GET
    // Everything OK, we will redirect the user to the list of tables
    // We want to see a message after redirection, so we establish
    // a "flash" message (which is simply a Session variable) to be
    // get in the view after redirection.
    $this->view->setFlash(sprintf(i18n("Table \"%s\" successfully choosen."),$tables ->getTableNombre()));

    // perform the redirection. More or less:
    // header("Location: index.php?controller=tables&action=index")
    // die();
    $this->view->redirect("tables", "tablesListPublic");
  }

  public function TEST() {
    // perform the redirection.
    $this->view->redirect("tables", "tablesListPublic");
  }

}
