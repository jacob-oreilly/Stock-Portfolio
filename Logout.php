<?php
  session_start();
  unset($_SESSION["username"]);
  unest($_SESSION["password"]);

  echo 'successfully logged out';
  header('REfresh: 2; URL = Login.php');

?>
