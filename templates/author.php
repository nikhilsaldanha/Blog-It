<html>
  <head>
    <base href="/Blog-It/" />
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>
      <?php
        $user_result_set = $userDetails->fetch_assoc();
        if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $user_result_set['id']) {
          echo 'Me';
          $itsme = 1;
        }
        else {
          echo $user_result_set['name'];
         }
      ?>
    </title>


      <!-- <link rel="stylesheet" type="text/css" href="css/login_s.css"> -->
  </head>
  <body>
    <?php
      if($loggedIn) {
    ?>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <a href="index.php" class="navbar-brand">Blog It!</a>
        <ul class="nav navbar-nav navbar-right">
          <li>
            <form class="navbar-form" role="search" action="index.php" method="POST">
              <div class="form-group">
                <input type="text" name="tag-search" class="form-control" placeholder="Search Posts By Tag">
              </div>
              <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"></span>
              </button>
            </form>
          </li>
          <li><a href="new-post">Add a new Post</a></li>
          <li><a href="logout">Logout</a></li>
        </ul>
      </div>
    </nav>;
    <?php
      }
      else {
    ?>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <a href="index.php" class="navbar-brand">Blog It!</a>
        <ul class="nav navbar-nav navbar-right">
          <li>
            <form class="navbar-form" role="search" action="index.php" method="POST">
              <div class="form-group">
                <input type="text" name="tag-search" class="form-control" placeholder="Search Posts By Tag">
              </div>
              <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"></span>
              </button>
            </form>
          </li>
          <li><a href="new-post">Add a new Post</a></li>
          <li><a href="login">Login</a></li>
          <li><a href="signup">Signup</a></li>
        </ul>
      </div>
    </nav>;
    <?php
      }
    ?>
    <div class="container">
      <div class = "container">
      <h2 class="col-md-10"><?php echo $user_result_set['name'] ?></h2>
      <?php 
          $uid = $user_result_set['id'];
          if($isFollowing && !isset($itsme)){
            echo "
              <form>
                <button type=\"submit\" class=\"btn btn-default\">
                   Following
                </button>
              </form>
            ";
          }elseif($loggedIn && !$isFollowing && !isset($itsme)){
            echo "
              <form action=\"follow/$uid\" method=\"POST\">
                <button type=\"submit\" class=\"btn btn-default\" name=\"follow\" value=\"1\">
                   + Follow
                </button>
              </form>
            ";
          }elseif(isset($itsme) && $itsme == 1){
            echo "
              <form>
                <button type=\"submit\" class=\"btn btn-default\">
                   $fol_count Followers
                </button>
              </form>
            ";
          }


      ?>
    </div>
        <?php
          if($empty) {
        ?>
        <em>This user has yet to put up any posts</em><br>
        <?php
          }
          else {
            while($result_set=$postDetails->fetch_assoc()) {
              $title = $result_set['title'];
              $body = $result_set['body'];
              $author_id = $result_set['author_id'];
              $date = $result_set['date'];
              $id = $result_set['id'];
        ?>
        <div class="post">
          <div class="post-head">
            <div class="col-md-10">
              <a href="post/<?php echo $id ?>"><h3 class="post-title"><?php echo $title ?></h3></a>
            </div>
            <?php
              if($loggedIn) {
            ?>
            <div class="col-md-2">
              <form action="delete-post/<?php echo $id?>" method="POST">
                <button type="submit" class="btn btn-default" name="delete-post" value="1">
                  <span id="down" class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
                </button>
              </form>
            </div>
            <?php
              }
            ?>
            <span class="post-date"><?php echo $date ?></span>
              </div>
            </div>
            <hr>
            <?php
                }
              }
            ?>
    </div>
  </body>
</html>
