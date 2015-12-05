<html>
  <head>
    <meta charset="utf-8">
    <title>Signup</title>
    <!-- <link rel="stylesheet" type="text/css" href="css/signup_s.css"> -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
  </head>
  <body class="container col-md-offset-4">

    <form class="form-horizontal" action="signup" method="POST">
      <h1>Signup</h1>

      <div class="form-group">
        <div class="col-md-5">
          <input class="form-control" name="name" type="text" placeholder="Name" autofocus required>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-5">
          <input class="form-control" name="username" type="text" placeholder="Username" autofocus required>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-5">
          <input class="form-control" name="email" type="email" placeholder="Email" autofocus required>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-5">
          <input class="form-control" name="passwd" type="password" placeholder="Password" autofocus required>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-5">
          <input class="form-control" name="con_passwd" type="password" placeholder="Confirm Password" autofocus required>
        </div>
      </div>

      <input class="btn btn-primary" type="submit" name="signup" id="submit" value="Login">

      <div class="error">
        <?php
          if(isset($err) && $err['mismatch']) {
            echo "<span class=\"error\">The passwords do not match!</span>";
          }
          elseif(isset($err) && $err['duplicate']) {
            echo "<span class=\"error\">That username already exists!</span>";
          }
         ?>
      </div>

    </form>
  </body>
</html>
