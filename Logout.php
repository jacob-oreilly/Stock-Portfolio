<html>
<body>
<?php
  ob_start();
  session_start();
  
  unset($_SESSION["username"]);
  unset($_SESSION["password"]);

  header('Location: Login.php');

?>
</body>
</html>