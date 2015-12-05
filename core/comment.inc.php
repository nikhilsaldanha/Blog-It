<?php

  require_once 'connect.inc.php';

  class Comment {
    private $mysqli;

    function __construct() {
      $db = Db::getInstance();
      $this->mysqli = $db->getConnection();
    }

    public function getComments($post_id) {
      $query = "SELECT * FROM comment WHERE post_id='$post_id' ORDER BY date ASC";
      $result = $this->mysqli->query($query);
      return $result;
    }
    public function getCommentCount($post_id){
     $query = "SELECT COUNT(*) FROM comment WHERE post_id='$post_id'";
      $result = $this->mysqli->query($query);
      if($result) {
        return $result;
      }
      else {
        return $this->mysqli->error;
      }
    }


    public function putComment($details){
      $body = $this->mysqli->real_escape_string($details['body']);
      $id=$details['author_id'];
      $post_id=$details['post_id'];
      $query = "INSERT INTO comment (id, post_id, comment_body, author_id, date, upvote, downvote) VALUES (NULL, '$post_id','$body', $id,NULL,0,0)";
      $result = $this->mysqli->query($query);
      if($result){
        return $result;
      }
      else{
        return $this->mysqli->error;
      }
    }

    public function getMyComment($id){
      $query = "SELECT COUNT(*) FROM comment WHERE author_id='$id' ORDER BY date ASC";
      $result = $this->mysqli->query($query);
      return $result;
    }

    public function deleteComment($id){
      $query = "DELETE FROM comment WHERE id='$id'";
      $result = $this->mysqli->query($query);
      return $result;
    }

    public function upVote($id){
     $query = " UPDATE comment SET upvote=upvote+1 WHERE id='$id'";
     $result = $this->mysqli->query($query);
     echo $result;
     return $result;
   }

   public function downVote($id){
     $query = " UPDATE comment SET downvote=downvote+1 WHERE id='$id'";
     $result = $this->mysqli->query($query);
     return $result;
   }

  }

?>
