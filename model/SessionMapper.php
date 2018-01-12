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

  //Retrieves all Sessions
  public function findAll($user) {
    $stmt = $this->db->prepare("SELECT * FROM sessions WHERE usuario=? ORDER BY id DESC");
    $stmt->execute(array($user->getId()));
    $sessions_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sessions = array();

    foreach ($sessions_db as $session) {
      array_push($sessions, new Session($session["id"],
                    $session["comentarios"],
                    $session["fecha_inicio"],
                    $session["fecha_fin"],
                    $session["usuario"],
                    $session["tabla"]));
    }

    return $sessions;
  }

  //Saves a Table into the database
  public function save($session) {
    $stmt = $this->db->prepare("INSERT INTO sessions (fecha_inicio, usuario, tabla) VALUES (?,?,?)");
    $stmt->execute(array(date('Y-m-d H:i:s'),$session->getUserId() ,$session->getTableid()));
  }

  //update a session into the database
  public function close($session) {
    $stmt = $this->db->prepare("UPDATE sessions set fecha_fin=?, comentarios=? where id=?");
    $stmt->execute(array(date('Y-m-d H:i:s'), $session->getComents(), $session->getSessionid()));
  }

  //Deletes a Table into the database
  public function delete(Session $session) {
    $stmt = $this->db->prepare("DELETE from sessions WHERE id=?");
    $stmt->execute(array($session->getSessionid()));
  }




  //Checks if a given sessionid is already in the database
  public function sessionidExists($sessionid) {
    $stmt = $this->db->prepare("SELECT count(sessionid) FROM sessions where sessionid=?");
    $stmt->execute(array($sessionid));

    if ($stmt->fetchColumn() > 0) {
      return true;
    }
  }

  //Retrieves a session from the database given its id
  public function findById($sessionid){
    $stmt = $this->db->prepare("SELECT * FROM sessions WHERE id=?");
    $stmt->execute(array("$sessionid"));
    $session = $stmt->fetch(PDO::FETCH_ASSOC);

    if($session != null) {
      return new Session(
        $session["id"],
        $session["comentarios"],
        $session["fecha_inicio"],
        $session["fecha_fin"],
        $session["usuario"],
        $session["tabla"]);
      } else {
        return NULL;
      }
    }
  }
