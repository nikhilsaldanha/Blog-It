<html>
  <head>
    <base href="/Blog-It/" />
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="css/login_s.css"> -->
  </head>
  <body class="container col-md-offset-4">
    <form class="form-horizontal" id="login" action="login" method="POST">
      <h1>Log In</h1>
      <!-- <fieldset id="inputs"> -->
      <div class="form-group">
        <div class="col-md-5">
          <input class="form-control" id="username" name="username" type="text" placeholder="Username/Email" autofocus required>
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-5">
          <input class="form-control" id="password" name="password" type="password" placeholder="Password" autofocus required>
        </div>
      </div>
      <input class="btn btn-primary" type="submit" name="submit" id="submit" value="Login">
    </form>
    <?php
      if(isset($new_redirect) && $new_redirect) {
        echo '<div class="err">You must login to continue</div>';
      }
      if(isset($err) && $err['incorrect']) {
        echo '<div class="err">Login Failed.<br>Username/Password is incorrect.</div>';
      }
      elseif(isset($err) && $err['absent']) {
        echo '<div class="err">You must supply both username and password</div>';
      }
    ?>
    <!-- <form id="login" action="login" method="POST"> -->
   <!-- <h1>Log In</h1> -->
