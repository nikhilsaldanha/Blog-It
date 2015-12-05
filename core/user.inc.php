<?php
require_once 'connect.inc.php';

class User{
	private $mysqli;
	// private $password;
 // 	private $username,$email,$id,$name;
	function __construct() {
		$db = Db::getInstance();
		$this->mysqli = $db->getConnection();
	}

	private function getPasswordByName($username){
		$query = "SELECT id,password FROM user where username='$username'";
		// $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";

		$result = $this->mysqli->query($query);
		return $result;
	}

	private function getPasswordByMail($email){
		$query = "SELECT id,password FROM user WHERE email='$email'";
		return $this->mysqli->query($query);
	}

	public function isLoggedIn() {

		// session_start();

	  if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
	    return true;
	  }
	  return false;
	}
	// private function setusername($name){
	// 	$this->username=$name;
	// }
	// private function setemail($mailid){
	// 	$this->email=$mailid;
	// }
	//
	// private function setpassword($pass){
	// 	$this->password = $pass;
	// }
	// private function setname($_name){
	// 	$this->name=$_name;
	// }

	public function login($uname,$passwd)
	{
		$uname = $this->mysqli->real_escape_string($uname);
		if($this->validEmail($uname)) {
			$result = $this->getPasswordByMail($uname);
		}
		else {
			$result = $this->getPasswordByName($uname);
		}

		if(!$result->num_rows) {
			return 0;
		}
    else{
			$result_set = $result->fetch_assoc();
			$hash = $result_set['password'];
			if(password_verify($passwd,$hash)) {
				session_start();
	      $user_id = $result_set['id'];
	      $result->free();
	      $_SESSION['user_id'] = $user_id;
				return 1;
			}
			else {
				return 0;
			}
    }
	}

	public function adduser($user_details){
		$name = $this->mysqli->real_escape_string($user_details['name']);
		$username = $this->mysqli->real_escape_string($user_details['username']);
		$password = $this->mysqli->real_escape_string($user_details['password']);
		$email = $this->mysqli->real_escape_string($user_details['email']);

		$password = password_hash($password, PASSWORD_DEFAULT);

		$query = "INSERT INTO user (id, username, email, password, name) VALUES (NULL, '$username', '$email', '$password', '$name')";
		$result = $this->mysqli->query($query);
		if($result) {
			return 1;
		}
		else{
			return $this->mysqli->error;
		}
	}

	public function validEmail($email) {
		return preg_match('/^[a-z0-9_.]+@[a-z]+\.[a-z]+\.?[a-z]+?$/i',$email);
	}

	public function getUser($uid) {
		$uid = $this->mysqli->real_escape_string($uid);
		$query = "SELECT * FROM user WHERE id='$uid'";
		$result = $this->mysqli->query($query);
		if($result) {
			return $result;
		}
		else {
			return $this->mysqli->error;
		}
	}

	function getName($uid){
		$query = "SELECT name FROM user WHERE id='$uid'";
		$result = $this->mysqli->query($query);
		if($result) {
			return $result;
		}
		else {
			return $this->mysqli->error;
		}
	}
	// function getemail(){
	// 	return $this->email;
	// }
	// function getid(){
	// 	return $this->id;
	// }
	// function getusername(){
	// 	return $this->username;
	// }
}
?>
