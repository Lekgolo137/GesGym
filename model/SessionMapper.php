<?php
require_once(__DIR__."/../core/PDOConnection.php");

class SessionMapper {

  /**
  * Reference to the PDO connection
  * @var PDO
  */
  private $db;

  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }

  //Saves a Table into the database
  public function save($session) {
    $stmt = $this->db->prepare("INSERT INTO sessions values (?,?,?,?,?)");
    $stmt->execute(array($session->getSessionid(), $session->getUsername(), $session->getTableid(),date('Y-m-d H:i:s'),$session->getFechaFin()));
  }


  //Checks if a given sessionid is already in the database
  public function sessionidExists($sessionid) {
    $stmt = $this->db->prepare("SELECT count(sessionid) FROM sessions where sessionid=?");
    $stmt->execute(array($sessionid));

    if ($stmt->fetchColumn() > 0) {
      return true;
    }
  }


  //Retrieves all Sessions
  public function findAll() {
    $stmt = $this->db->query("SELECT * FROM sessions");
    $sessions_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sessions = array();

    foreach ($sessions_db as $session) {
      array_push($sessions, new Session($session["sessionid"],
										$session["username"],
										$session["tableid"],
										$session["fechaInicio"],
										$session["fechaFin"]));
    }

    return $sessions;
  }

  //Retrieves a session from the database given its id
  public function findById($sessionid){
    $stmt = $this->db->prepare("SELECT * FROM sessions WHERE sessionid=?");
    $stmt->execute(array($sessionid));
    $session = $stmt->fetch(PDO::FETCH_ASSOC);

    if($session != null) {
      return new Session(
        $session["sessionid"],
        $session["username"],
        $session["tableid"],
        $session["fechaInicio"],
        $session["fechaFin"]);
      } else {
        return NULL;
      }
    }

    //Deletes a Table into the database
    public function close(Session $session) {
      $stmt = $this->db->prepare("UPDATE sessions set fechaFin=? where sessionid=?");
      $stmt->execute(array(date('Y-m-d H:i:s') ,$session->getSessionid()));
    }

    //Deletes a Table into the database
		public function delete(Session $session) {
			$stmt = $this->db->prepare("DELETE from sessions WHERE sessionid=?");
			$stmt->execute(array($session->getSessionid()));
		}

  }
