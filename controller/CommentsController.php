<?php
require_once(__DIR__."/../model/Comment.php");
require_once(__DIR__."/../model/Comment.php");
require_once(__DIR__."/../model/CommentMapper.php");
require_once(__DIR__."/../model/User.php");

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

class CommentsController extends BaseController {
  //Reference to the tableMapper to interact
  private $commentMapper;

  public function __construct() {
    parent::__construct();

    $this->commentMapper = new CommentMapper();
  }

  /***********************************************************************************/
  /***********************************************************************************/
  //Action to list tables
  public function index() {
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. This action requires login");
    }

    if (!isset($_REQUEST["id"])) {
      $comments = $comments = new Comment();
    }else{
      // obtain the data from the database
      $comments = $this->commentMapper->findBySessionId($_REQUEST['id']);
    }

    // put the array containing Table object to the view
    $this->view->setVariable("comments", $comments);

    // render the view (/view/tables/index.php)
    $this->view->render("comments", "index");
  }

  /*************************************************************************************/
  /***********************************************************************************/
  //Action to add a new Table
  public function add() {
    if (!isset($this->currentUser)) {
      throw new Exception("Not in session. This action requires login");
    }

    $comments = new Comment();

    if (isset($_POST["submit"])) { // reaching via HTTP Table...

      // populate the Table object with data form the form
      $comments->setCommentid($_POST["commentid"]);
      $comments->setContent($_POST["content"]);
      $comments->setUsername($_POST["username"]);
      $comments->setSessionid($_POST["sessionid"]);
      $comments->setTableid($_POST["tableid"]);


      try {

        // save the Table object into the database
        $this->commentMapper->save($comments);

        // POST-REDIRECT-GET
        // Everything OK, we will redirect the user to the list of tables
        // We want to see a message after redirection, so we establish
        // a "flash" message (which is simply a Session variable) to be
        // get in the view after redirection.
        $this->view->setFlash(sprintf(i18n("Table \"%s\" successfully added."),$comments->getCommentid()));

        $this->view->setVariable("comments", $comments);
        $this->view->redirect("sessions", "sessionsList");

      }catch(ValidationException $ex) {
        // Get the errors array inside the exepction...
        $errors = $ex->getErrors();
        // And put it to the view as "errors" variable
        $this->view->setVariable("errors", $errors);
      }
    }

    // Put the Table object visible to the view
    $this->view->setVariable("comments", $comments);

    // render the view (/view/tables/add.php)
	$this->view->setLayout("welcome");
    $this->view->render("comments", "add");

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
    $commentid = $_REQUEST["id"];
    $comments = $this->commentMapper->findById($commentid);

    // Does the table exist?
    if ($comments == NULL) {
      throw new Exception("no such table with id: ".$commentid);
    }


    // Delete the Table object from the database
    $this->commentMapper->delete($comments);

    // POST-REDIRECT-GET
    // Everything OK, we will redirect the user to the list of tables
    // We want to see a message after redirection, so we establish
    // a "flash" message (which is simply a Session variable) to be
    // get in the view after redirection.
    $this->view->setFlash(sprintf(i18n("Table \"%s\" successfully deleted."),$comments ->getCommentid()));

    // perform the redirection. More or less:
    // header("Location: index.php?controller=tables&action=index")
    // die();
    $this->view->setVariable("comments", $comments);
    $this->view->redirect("comments", "index");
  }

}