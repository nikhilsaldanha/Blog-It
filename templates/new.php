<html>
  <head>
    <base href="/Blog-It/" />
    <meta charset="utf-8">
    <title>New Post</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
  </head>
  <body>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <a href="index.php" class="navbar-brand">Blog It!</a>
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="logout">Logout</a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="container col-md-offset-3 col-md-12">
      <form class="form-horizontal" action="new-post" method="POST">
        <div class="form-group" >
          <div class="col-md-6">
            <input type="text" name="title" class="form-control" id="title" placeholder="Title" required>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-6">
            <textarea class="form-control" id="body" name="body" rows="10" placeholder="Body" required></textarea>
          </div>
        </div>
        <div class="form-group">
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
