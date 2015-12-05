<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>
      <?php
        $user_result_set = $userDetails->fetch_assoc();
        if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $user_result_set['id']) {
          echo 'Me';
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
            echo "<nav class=\"navbar navbar-default\">
              <div class=\"container-fluid\">
                <a href=\"index.php\" class=\"navbar-brand\">Blog It!</a>
                <ul class=\"nav navbar-nav navbar-right\">
                  <li>
                    <form class=\"navbar-form\" role=\"search\" action=\"/\" method=\"POST\">
                      <div class=\"form-group\">
                        <input type=\"text\" name=\"tag-search\" class=\"form-control\" placeholder=\"Search Posts By Tag\">
                      </div>
                      <button type=\"submit\" class=\"btn btn-default\">
                        <span class=\"glyphicon glyphicon-search\"></span>
                      </button>
                    </form>
                  </li>
                  <li><a href=\"new-post\">Add a new Post</a></li>
                  <li><a href=\"logout\">Logout</a></li>
                </ul>
              </div>
            </nav>";
      }
      else {
        echo "<nav class=\"navbar navbar-default\">
          <div class=\"container-fluid\">
            <a href=\"index.php\" class=\"navbar-brand\">Blog It!</a>
            <ul class=\"nav navbar-nav navbar-right\">
              <li>
                <form class=\"navbar-form\" role=\"search\" action=\"/\" method=\"POST\">
                  <div class=\"form-group\">
                    <input type=\"text\" name=\"tag-search\" class=\"form-control\" placeholder=\"Search Posts By Tag\">
                  </div>
                  <button type=\"submit\" class=\"btn btn-default\">
                    <span class=\"glyphicon glyphicon-search\"></span>
                  </button>
                </form>
              </li>
              <li><a href=\"new-post\">Add a new Post</a></li>
              <li><a href=\"login\">Login</a></li>
              <li><a href=\"signup\">Signup</a></li>
            </ul>
          </div>
        </nav>";
      }
      ?>
      <div class="container">

        <?php
        $auth = $user_result_set['name'];
        echo "<h2 class=\"author-name\">$auth</h2>";

        if($empty) {
          echo "<em>This user has yet to put up any posts</em><br>";
        }
        else {
          while($result_set=$postDetails->fetch_assoc()) {
            $title = $result_set['title'];
            $body = $result_set['body'];
            $author_id = $result_set['author_id'];
            $date = $result_set['date'];
            $id = $result_set['id'];

            echo "
            <div class=\"post\">
              <div class=\"post-head\">
                <div class=\"col-md-10\">
                  <a href=\"post/$id\"><h3 class=\"post-title\">$title</h3></a>
                </div>
                ";
                if($loggedIn) {
                  echo "<div class=\"col-md-2\">
                    <form action=\"delete-post/$id\" method=\"POST\">
                      <button type=\"submit\" class=\"btn btn-default\" name=\"delete-post\" value=\"1\">
                        <span id=\"down\" class=\"glyphicon glyphicon-remove-sign\" aria-hidden=\"true\"></span>
                      </button>
                    </form>
                  </div>";

                }
              echo "
              <span class=\"post-date\">$date</span>
              </div>
            </div><hr>";
          }
        }
      ?>
    </div>
  </body>
</html>
