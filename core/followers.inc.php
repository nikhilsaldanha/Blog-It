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

	function followMe($uid){
		if(isset($_SESSION['user_id'])){
			$me = $_SESSION['user_id'];
		}else{
			return $this->mysqli->error;
		}
			$query = "INSERT INTO follower(id,uid,fid) VALUES (NULL,'$me','$uid')";
			$result = $this->mysqli->query($query);
			if($result){
				return true;
			}else{
				return $this->mysqli->error;
			}			
	}

	function isFollowing($uid){
		if(isset($_SESSION['user_id'])){
			$me = $_SESSION['user_id'];
		}else{
			return $this->mysqli->error;
		}
		$query = "SELECT * FROM follower WHERE fid='$me' AND uid='$uid'";

		$result = $this->mysqli->query($query);
		if($result){
			$row = $result->fetch_assoc();
			if($row['uid'] == $uid && $row['fid'] == $me){
				return true;
			}
		}else{
		return false;
			}
	}
}

?>