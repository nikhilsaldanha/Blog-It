<?php
define("HOST",$_SERVER['HTTP_HOST']);
define("USERNAME","root");
define("PASSWORD","");
define("DB_NAME","blog");
define("POST_TABLE","post");
define("COMMENT","comment");
define("USERS","user");
define("TAGS","tag");

class Db {
	private $_connection;
	private static $_instance;
	private $_host = HOST;
	private $_username = USERNAME;
	private $_password = PASSWORD;
	private $_database = DB_NAME;

	//creates singleton instance
	public static function getInstance() {
		if(!self::$_instance) {
			self::$_instance = new self;
		}
		return self::$_instance;
	}

	//constructor
	function __construct() {
		$this->_connection = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);

		//error
		if(mysqli_connect_error()) {
			trigger_error("Failed to connect to MySQL: ".mysql_connect_error(), E_USER_ERROR);
		}
	}

	// Magic method clone is empty to prevent duplication of connection
	private function __clone() { }

	// Get mysqli connection
	public function getConnection() {
		return $this->_connection;
	}
}
?>
