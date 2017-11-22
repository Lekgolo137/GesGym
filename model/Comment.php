<?php
require_once(__DIR__."/../core/ValidationException.php");

class Comment {

	// String
	private $commentid;

	// String
	private $content;

	// String
	private $username;

	// Date
	private $sessionid;

	// String
	private $tableid;



	// Constructor
	public function __construct($commentid=NULL, $content=NULL, $username=NULL, $sessionid=NULL, $tableid=NULL) {
		$this->commentid = $commentid;
		$this->content = $content;
		$this->username = $username;
		$this->sessionid = $sessionid;
		$this->tableid = $tableid;
	}

	// GETTERS
	public function getCommentid() {
		return $this->commentid;
	}

	public function getContent() {
		return $this->content;
	}

	public function getUsername() {
		return $this->username;
	}

	public function getSessionid() {
		return $this->sessionid;
	}

	public function getTableid() {
		return $this->tableid;
	}

	// SETTERS
	public function setCommentid($commentid) {
		$this->commentid = $commentid;
	}

	public function setContent($content) {
		$this->content = $content;
	}

	public function setUsername($username) {
		$this->username = $username;
	}

	public function setSessionid($sessionid) {
		$this->sessionid = $sessionid;
	}

	public function setTableid($tableid) {
		$this->tableid = $tableid;
	}
}