<html>
  <head>
    <base href="/Blog-It/" />
    <title>404 Not Found</title>
    <!-- <link rel="stylesheet" type="text/css" href="css/login_s.css"> -->
  </head>
  <body>
    <?php

      if($loggedIn) {
        echo "<table class=\"navbar\"><tbody><tr><td><a href=\"logout\">Logout</a></td></tr></tbody></table><hr><br>";
      }
      else {
        echo "<table class=\"navbar\"><tbody><tr><td><a href=\"login\">Login</a></td><td>|</td><td><a href=\"signup\">Signup</a></td></tr></tbody></table><hr>";
      }
    ?>
    <h1>404 Not Found</h1>
    This page doesn't exist.<br>You must be lost.
    Try finding your way from <a href="/">here<a>
  </body>
</html>
