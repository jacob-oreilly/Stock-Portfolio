<?php
  ob_start();
  session_start();
?>

<html lang = "en">
  <head>
    <title>Stock Portfolio</title>
    <link href = "css/bootstrap.min.css" rel = "stylesheet">
  </head>

  <body>
    <h2>Login</h2>
    <div class = "container form-login">
      <?php
        $msg = '';

        if(isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {

          if($_POST['username'] == 'username' &&
            $_POST['password'] == 'password') {
              $_SESSION['valid'] = true;
              $_SESSION['timeout'] = time();
              $_SESSION['username'] = 'username';

              echo 'correct login info';
            }
            else {
              $msg = 'Incorrect login credentials';
            }
        }
      ?>
    </div>
    <div class = "container">

      <form class = "form-login" role = "form" action= "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
        method = "post">
        <h4 class = "form-login-header"><?php echo $msg; ?></h4>
        <input type = "text" class = "form-control"
               name = "username" placeholder = "username = username"
               required autofocus></br>
            <input type = "password" class = "form-control"
               name = "password" placeholder = "password = password" required>
            <button class = "btn btn-lg btn-primary btn-block" type = "submit"
               name = "login">Login</button>
      </form>
      Logout <a href = "logout.php" title = "Logout">
    </div>
  </body>
</html>
