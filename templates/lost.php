<html>
  <head>
    <base href="/Blog-It/" />
    <title>404 Not Found</title>
    <!-- <link rel="stylesheet" type="text/css" href="css/login_s.css"> -->
  </head>
  <body>
    <?php
      if($loggedIn) {
    ?>
    <table class="navbar">
      <tbody>
        <tr>
          <td>
            <a href="logout">Logout</a>
          </td>
        </tr>
      </tbody>
    </table>
    <hr><br>
    <?php
      }
      else {
    ?>
    <table class="navbar">
      <tbody>
        <tr>
          <td>
            <a href="login">Login</a>
          </td>
          <td>|</td>
          <td>
            <a href="signup">Signup</a>
          </td>
        </tr>
      </tbody>
    </table>
    <hr>
    <?php
      }
    ?>
    <h1>404 Not Found</h1>
    This page doesn't exist.<br>You must be lost.
    Try finding your way from <a href="index.php">here<a>
  </body>
</html>
