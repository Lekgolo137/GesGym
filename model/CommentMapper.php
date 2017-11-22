<?php
require_once(__DIR__."/../core/PDOConnection.php");

class CommentMapper {

  /**
  * Reference to the PDO connection
  * @var PDO
  */
  private $db;

  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }

  //Saves a Table into the database
  public function save($comment) {
    $stmt = $this->db->prepare("INSERT INTO comments values (?,?,?,?,?)");
    $stmt->execute(array($comment->getCommentid(), $comment->getContent(), $comment->getUsername(), $comment->getSessionid(), $comment->getTableid()));
  }


  //Checks if a given sessionid is already in the database
  public function commentidExists($commentid) {
    $stmt = $this->db->prepare("SELECT count(commentid) FROM comments where commentid=?");
    $stmt->execute(array($commentid));

    if ($stmt->fetchColumn() > 0) {
      return true;
    }
  }


  //Retrieves all Sessions
  public function findAll() {
    $stmt = $this->db->query("SELECT * FROM comments");
    $comments_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $comments = array();

    foreach ($comments_db as $comment) {
      array_push($comments, new Comment($comment["commentid"],$comment["content"],$comment["username"],$comment["sessionid"],$comment["tableid"]));
    }

    return $comments;
  }

  //Retrieves a session from the database given its id
  public function findById($commentid){
    $stmt = $this->db->prepare("SELECT * FROM comments WHERE commentid=?");
    $stmt->execute(array($commentid));
    $comment = $stmt->fetch(PDO::FETCH_ASSOC);

    if($comment != null) {
      return new Comment(
        $comment["commentid"],
        $comment["content"],
        $comment["username"],
        $comment["sessionid"],
        $comment["tableid"]);
      } else {
        return NULL;
      }
    }

    public function findBySessionId($sessionid){
      $stmt = $this->db->prepare("SELECT * FROM comments WHERE sessionid=?");
      $stmt->execute(array($sessionid));
      $comments_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $comments = array();

      foreach ($comments_db as $comment) {
        array_push($comments, new Comment($comment["commentid"],$comment["content"],
                  $comment["username"],$comment["sessionid"],$comment["tableid"]));
      }

      return $comments;
      }

    //Deletes a Table into the database
    public function close(Session $session) {
      $stmt = $this->db->prepare("UPDATE sessions set fechaFin=? where sessionid=?");
      $stmt->execute(array(date('Y-m-d H:i:s') ,$session->getSessionid()));
    }

    //Deletes a Table into the database
		public function delete(Comment $comment) {
			$stmt = $this->db->prepare("DELETE from comments WHERE commentid=?");
			$stmt->execute(array($comment->getCommentid()));
		}

  }
