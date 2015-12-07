<?php

  require_once 'connect.inc.php';

  class Tag {
    private $mysqli;

    function __construct() {
      $db = Db::getInstance();
      $this->mysqli = $db->getConnection();
    }

    public function addTags($pid, $tags) {
      foreach($tags as $tag) {

        // $tag = $this->mysqli->real_escape_string($tag);
        $query = "INSERT INTO tag (id, post_id, tag) VALUES (NULL, '$pid', '$tag')";
        $result = $this->mysqli->query($query);
      }
      if($result) {
        return $result;
      }
      else {
        echo $this->mysqli->error;
      }
    }

    public function getPostIdByTag($tag) {
      $tag = $this->mysqli->real_escape_string($tag);
      $query = "SELECT post_id FROM tag WHERE tag='$tag'";
      $result = $this->mysqli->query($query);
      return $result;
    }

    public function getTagsByPostId($post_id) {
      $query = "SELECT tag FROM tag WHERE post_id='$post_id'";
      $result = $this->mysqli->query($query);
      return $result;
    }
  }
?>
