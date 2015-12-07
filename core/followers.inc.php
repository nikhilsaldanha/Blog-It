<?php
require_once 'connect.inc.php';

class Follower{
	private $mysqli;

	function __construct(){
		$db= Db::getInstance();
		$this->mysqli=$db->getConnection();
	}

	//function to retrieve the followers of a user
	function getFollowersId($uid){
		$query = "SELECT * FROM followers WHERE follower='$uid'";
		$result = $this->mysqli->query($query);
		return $result;
	}

	function followMe($uid,$me){
			$query = "INSERT INTO followers(id,uid,fid) VALUES (NULL,'$uid','$me')";
			$result = $this->mysqli->query($query);
			if($result){
				return true;
			}else{
				return $this->mysqli->error;
			}			
	}

	function getCount(){
		if(isset($_SESSION['user_id'])){
			$me = $_SESSION['user_id'];
		}else{
			return $this->mysqli->error;
		}
		$query = "SELECT COUNT(DISTINCT(fid)) FROM followers WHERE uid='$me'";
		
		$result = $this->mysqli->query($query);
		if($result){
				return $result->fetch_array()[0];
			
		}else{
		return 0;
			}
	}	

	function isFollowing($uid){
		if(isset($_SESSION['user_id'])){
			$me = $_SESSION['user_id'];
		}else{
			return $this->mysqli->error;
		}
		$query = "SELECT * FROM followers WHERE fid='$me' AND uid='$uid'";
		
		$result = $this->mysqli->query($query);
		if($result->num_rows > 0){
				return true;
			
		}else{
		return 0;
			}
	}
}

?>