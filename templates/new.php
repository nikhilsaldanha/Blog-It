<html>
  <head>
    <meta charset="utf-8">
    <title>New Post</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
  </head>
  <body>
    <?php
        // echo "<table class=\"navbar-right\"><tbody><tr><td></td></tr></tbody></table><hr><br>";
        // <a href="logout">Logout</a>
        echo "<nav class=\"navbar navbar-default\">
          <div class=\"container-fluid\">
            <a href=\"index.php\" class=\"navbar-brand\">Blog It!</a>
            <ul class=\"nav navbar-nav navbar-right\">
              <li><a href=\"logout\">Logout</a></li>
            </ul>
          </div>
        </nav>"
    ?>


    <div class="container col-md-offset-3 col-md-12">
      <form class="form-horizontal" action="new-post" method="POST">
        <div class="form-group" >
          <!-- <label for="title" class="col-sm-1 control-label"></label> -->
          <div class="col-md-6">
            <input type="text" name="title" class="form-control" id="title" placeholder="Title" required>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-6">
            <textarea class="form-control" id="body" name="body" rows="10" placeholder="Body" required></textarea>
            <!-- <input type="password" class="form-control" id="inputPassword3" placeholder="Password"> -->
          </div>
        </div>
        <div class="form-group">
          <!-- <label for="tags" class="col-sm-1 control-label"></label> -->
          <div class="col-md-6">
            <input type="text" name="tags" class="form-control" id="tags" placeholder="Tags delimited by spaces. Eg. Tag1 Tag2 Tag3">
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-10">
            <input type="submit" name="new-post" class="btn btn-primary" value="Submit New Post">
          </div>
        </div>
      </form>
    </div>
  </body>
</html>

<!-- <textarea id="post-body" name="body" cols="92" rows="15" data-min-length="200"></textarea>
<div id="tags-section">
  <label for="tags">Tags</label>
  <input id="tags" name="tags" type="text" size="60" value="">
</div>

<div id="form-submit">
  <input id="submit-button" type="submit" value="Post Your Blog">
</div> -->
