<?php 
session_start();

require 'conf.php';

if(isset($_COOKIE['id']) && isset($_COOKIE['key'])){
  $id = $_COOKIE['id'];
  $key = $_COOKIE['key'];

  // check if the ID matches the username (key)
  $usernamefromcookieid = query("SELECT * FROM login WHERE id='$id'");
  if($key === hash('sha256', $usernamefromcookieid['username'])){
    $_SESSION['login'] = true;
  }
}

if(isset($_POST['submit'])){
  $username = $_POST['username'];
  $password = $_POST['password'];
  $dbdata = query("SELECT * FROM login WHERE username='$username'");
  if($username !== $dbdata['username']){
    $error = true;
    } else {
    $dbpw = $dbdata['password'];
    if($password === $dbpw){
      $_SESSION['login'] = true;
      if(isset($_POST['remember'])){
        setcookie('id', $dbdata['id'], time()+3600*24*7);
        setcookie('key', hash('sha256', $dbdata['username']), time()+3600*24*7);
      }
    } else {$error = true;}
  }
}

if(isset($_SESSION['login'])){
  if($_SESSION['login']){header("location: index.php");}
}

?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Login</title>

    <!-- Bootstrap Script -->
    <link href="<?=$bootstrap_min_css?>" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="<?=$signin_css?>" rel="stylesheet">
    <link rel="icon" type="image/png" href="<?=$favicon?>">
  </head>
  <body>
    <!-- Enter the content here -->
     <div class="container">

      <form class="form-signin" method="post" action="">
      <h2>Login to panel</h2>
      <?php if(isset($_POST['submit'])){ if($error): ?>
        <p style="color: red;">An error has been occured.</p>
      <?php endif; } ?>
        <label for="inputEmail" class="sr-only">Username</label>
        <input name="username" type="text" id="inputEmail" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input name="remember" type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <input name="submit" value="Login" class="btn btn-lg btn-primary btn-block" type="submit">
      </form>

    </div> <!-- /container -->

    <!-- Bootstrap Body Script  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>