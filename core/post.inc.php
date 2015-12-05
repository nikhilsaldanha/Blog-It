<?php

  require_once 'connect.inc.php';

  class Post {
    private $mysqli;

    function __construct() {
      $db = Db::getInstance();
      $this->mysqli = $db->getConnection();
    }

    public function getPost($pid) {
      $query = "SELECT * FROM post WHERE id='$pid'";
      $result = $this->mysqli->query($query);
      if($result) {
        return $result;
      }
      else {
        return $this->mysqli->error;
      }
    }


    // index page
    public function getTopPosts() {
      $query = "SELECT * FROM post ORDER BY date DESC LIMIT 10";
      $result = $this->mysqli->query($query);
      if($result) {
        return $result;
      }
      else {
        return $this->mysqli->error;
      }
    }

    // profile page
    public function getTopPostsByUser($uid) {
      $query = "SELECT * FROM post WHERE author_id=$uid ORDER BY date DESC LIMIT 10";
      $result = $this->mysqli->query($query);
      if($result) {
        return $result;
      }
      else {
        return $this->mysqli->error;
      }
    }

    public function addPost($details) {
      $title = $this->mysqli->real_escape_string($details['title']);
      $body = $this->mysqli->real_escape_string($details['body']);
      $uid = $details['uid'];
      $query = "INSERT INTO post (id, title, body, author_id, date, upvote, downvote) VALUES (NULL, '$title', '$body', '$uid', NULL, 0, 0)";
      $result = $this->mysqli->query($query);

      if($result) {
        return $this->mysqli->insert_id;
      }
      else {
        return $this->mysqli->error;
      }
    }

    public function deletePost($post_id){
      $query = "DELETE FROM post WHERE id='$post_id'";
      $result = $this->mysqli->query($query);
      return $result;
    }

    public function upVote($pid){
     $query = " UPDATE post SET upvote=upvote+1 WHERE id='$pid'";
     $result = $this->mysqli->query($query);
     return $result;
   }

   public function downVote($pid){
     $query = " UPDATE post SET downvote=downvote+1 WHERE id='$pid'";
     $result = $this->mysqli->query($query);
     return $result;
   }

  }

?>
